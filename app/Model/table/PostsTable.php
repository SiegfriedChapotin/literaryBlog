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
        return Posts::class;
    }


    /**
     * @return object
     */
    function listPostAll( )
    {
        return $this->query('SELECT * FROM book WHERE classify=1 ORDER BY book.chapter');
    }


    function listPostWrite(string $int)
    {
        return $this->query('SELECT * FROM book WHERE classify=0 ORDER BY book.date DESC LIMIT ' . $int);
    }

    function listPost(string $int)
    {
        return $this->query('SELECT * FROM book WHERE classify=1 ORDER BY book.chapter DESC LIMIT ' . $int);
    }
    function findPost()
    {
        return $this->find(Query::get('id'));
    }


    function NewPostWrite()
    {
        if (Request::exist('TitleDashboard') && Request::exist('TextDashboard')) {
            $post=(new Posts())->setText(Request::get('TextDashboard'))->setTitle(Request::get('TitleDashboard'))->setClassify(Request::get('is_status'))->setChapter(Request::get('ChapDashboard'));
            $this->flush($post);

            return header('Location:index.php?p=publication_Office');
        }
    }

    function PostUpdate()
    {
            $post=(new Posts())->setId(intval(Query::get('id')))->setText(Request::get('TextDashboard'))->setTitle(Request::get('TitleDashboard'))->setClassify(Request::get('is_status'))->setChapter(Request::get('ChapDashboard'));
            $this->flush($post);

            return header('Location:index.php?p=posts_admin&id='.Query::get('id'));
    }
}