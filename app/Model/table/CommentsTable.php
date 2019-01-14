<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 27/11/2018
 * Time: 16:23
 */

namespace Literary\Model\table;

use LiteraryCore\Table\AbstractTable;

use LiteraryCore\Request\Query;
use LiteraryCore\Request\Request;

use Literary\Model\entity\Comment;

class CommentsTable extends AbstractTable
{


    protected function getTableName()
    {
        return 'comment';
    }

    protected function getClassName()
    {
        return Comment::class;
    }

    function findCommentChapter()
    {
        return $this->query('SELECT * FROM comment WHERE id_chapter = ? ORDER BY comment.date DESC ', [Query::get('id')]);

    }

    function listComment($int)
    {

        return $this->query('SELECT * FROM comment ORDER BY comment.date DESC LIMIT ' .$int);
    }


    function commentWrite()
    {
        if (Request::exist('pseudo') && Request::exist('comment')) {

            $this->create(['pseudo' => Request::get('pseudo'), 'comment' => Request::get('comment'), 'id_chapter' => Query::get('id')]);
            return header('Location: index.php?p=post_show&id=' . Query::get('id'));

        }
    }

    function listReport($int)
    {
        return $this->query('SELECT * FROM comment WHERE is_reported = 1 ORDER BY comment.date DESC LIMIT '.$int);
    }

    function report()
    {
        if (Request::exist('commentid')) {

            $key= intval(Request::get('commentid'));
            $this->update($key, ['is_reported' => true]);

            return header('Location: index.php?p=post_show&id='. Query::get('id'));
        }
    }
}


