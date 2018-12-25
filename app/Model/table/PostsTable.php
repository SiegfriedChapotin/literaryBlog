<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 17:08
 */

namespace Literary\Model\table;

use LiteraryCore\Table\AbstractTable;
use Literary\Model\entity\Posts;
use Literary\Controller\PostController;
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
        return PostController::class;
    }

    function listPost(){
        return $this->query('SELECT * FROM book WHERE is_status=1 ORDER BY book.date DESC LIMIT 5');
    }
    function NewPostWrite()
    {
        if (Request::exist('TitleDashboard') && Request::exist('TextDashboard')) {

            return $this->create(['title'=>Request::get('TitleDashboard'), 'text'=>Request::get('TextDashboard'),'is_status'=>Request::get('is_status')]);
        }

    }
    function modifPostWrite()
    {
        if (Request::exist('TitleDashboard') && Request::exist('TextDashboard')&& Request::exist('is_status')) {

            $this->update(Query::exist('id'),['title'=>Request::get('TitleDashboard'), 'text'=>Request::get('TextDashboard'),'is_status'=>Request::get('is_status')]);
            return header('Location: index.php?p=posts_admin&id='. Query::get('id'));
        }

    }
}