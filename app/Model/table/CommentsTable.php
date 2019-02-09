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

        return $this->query('SELECT * FROM comment WHERE classify = 0 ORDER BY comment.date DESC LIMIT ' .$int);
    }

    function listReport($int)
    {
        return $this->query('SELECT * FROM comment WHERE classify = 1 ORDER BY comment.date DESC LIMIT ' . $int);
    }

    function commentWrite()
    {
        if (Request::exist('pseudo') && Request::exist('comment')) {
            $comment=(new Comment())->setComment(Request::get('comment'))->setPseudo(Request::get('pseudo'))->setIdChapter(Query::get('id'));
            $this->flush($comment);



        }
    }









    function deleteComment(int $id)
    {

        return $this->delete($id);

    }
}


