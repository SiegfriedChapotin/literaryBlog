<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 27/11/2018
 * Time: 16:23
 */

namespace Literary\Model\Table;

use LiteraryCore\Table\AbstractTable;

use LiteraryCore\Request\Query;
use LiteraryCore\Request\Request;

use Literary\Model\Entity\Comment;

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

    function findCommentChapter($id)
    {
        return $this->query('SELECT * FROM comment WHERE id_chapter = ? ORDER BY comment.date DESC ', $id);
    }

    function listComment()
    {
        return $this->query('SELECT * FROM comment WHERE classify = 0 ORDER BY comment.date DESC ');
    }

    function listReport()
    {
        return $this->query('SELECT * FROM comment WHERE classify = 1 ORDER BY comment.date DESC ');
    }

    function listCommentAdmin($nbComments)
    {
        return $this->query('SELECT * FROM comment WHERE classify = 0 ORDER BY comment.date DESC LIMIT ' . $nbComments);
    }

    function listReportAdmin($nbComments)
    {
        return $this->query('SELECT * FROM comment WHERE classify = 1 ORDER BY comment.date DESC  LIMIT ' . $nbComments);
    }

    function commentWrite($post)
    {
        $this->flush($post);
    }

}


