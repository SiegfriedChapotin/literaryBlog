<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 14/11/2018
 * Time: 17:08
 */

namespace Literary\Model\table;

use LiteraryCore\Table\AbstractTable;
use Literary\Model\entity\Posts;


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

    function listPostWrite()
    {
        return $this->query('SELECT * FROM book WHERE classify=0 ORDER BY book.date DESC');
    }

    function listPost()
    {
        return $this->query('SELECT * FROM book WHERE classify=1 ORDER BY book.chapter DESC');
    }

    function findPost($id)

    {
        return $this->find($id);
    }

    function NewPostWrite($post)
    {
         $this->flush($post);
    }

    function PostUpdate($post)
    {
            $this->flush($post);
    }
}