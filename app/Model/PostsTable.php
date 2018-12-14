<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 17:08
 */

namespace Literary\Model;

use LiteraryCore\Table\AbstractTable;
use Literary\Controller\Post;
use LiteraryCore\Request\Query;
use LiteraryCore\Request\Request;

class PostsTable extends AbstractTable



{

    protected  function getTableName()
    {
        return 'book';
    }

    protected  function getClassName()
    {
        return Post::class;
    }

    function listPost(){
        return $this->query('SELECT * FROM book ORDER BY book.date DESC LIMIT 5');
    }
    function NewPostWrite()
    {
        if (Request::exist('TitleDashboard') && Request::exist('TextDashboard')) {

            return $this->create(['title'=>Request::get('TitleDashboard'), 'text'=>Request::get('TextDashboard')]);
        }else{
            return $this->find($id=Query::get('id'));
        }

    }
    function ModifPostWrite()
    {
        if (Request::exist('TitleDashboard') && Request::exist('TextDashboard')) {

            return $this->update(Query::get('id'),['title'=>Request::get('TitleDashboard'), 'text'=>Request::get('TextDashboard')]);
        }else{
            return $this->find($id=Query::get('id'));
        }

    }
}