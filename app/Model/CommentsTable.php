<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 27/11/2018
 * Time: 16:23
 */

namespace Literary\Model;

use LiteraryCore\Table\AbstractTable;
use Literary\Controller\Comment;
use LiteraryCore\Request\Query;
use LiteraryCore\Request\Request;

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

    function findCommentChapter(){
        return $this->query('SELECT * FROM comment WHERE id_chapter = ? ORDER BY comment.date DESC ',[Query::get('id')] );
    }

    function listComment(){

        return $this->query('SELECT * FROM comment ORDER BY comment.date DESC LIMIT 6');
    }

    function commentWrite()
    {
        if (Request::exist('pseudo') && Request::exist('comment')) {

            return $this->create(['pseudo'=>Request::get('pseudo'), 'comment'=>Request::get('comment'),'id_chapter'=>Query::get('id')]);
        }else{
            return $this->find($id=Query::get('id'));
        }

    }
    function report(){

    }
}