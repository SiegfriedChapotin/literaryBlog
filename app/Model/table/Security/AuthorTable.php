<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:46
 */

namespace Literary\Model\table\Security;



use LiteraryCore\Table\AbstractTable;
use Literary\Model\entity\Security\Author;




class AuthorTable extends AbstractTable
{
    protected  function getTableName()
    {
        return 'author';
    }

    protected  function getClassName()
    {
        return Author::class;
    }


    public function login(string $username) {
        return $this->query('SELECT * FROM '.$this->getTableName().' WHERE username = ?', array($username),true);

    }

}