<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 25/12/2018
 * Time: 23:05
 */

namespace Literary\Model\table\Security;

use Literary\Model\entity\Security\User;
use LiteraryCore\Table\AbstractTable;


use LiteraryCore\Request\Query;
use LiteraryCore\Request\Request;

class UserTable extends AbstractTable
{


    protected function getTableName()
    {
        return 'author';
    }

    protected function getClassName()
    {
        return User::class;
    }

    public function login(string $username) {
        return $this->query('SELECT * FROM author WHERE username = ?', array($username),true);

    }
}

