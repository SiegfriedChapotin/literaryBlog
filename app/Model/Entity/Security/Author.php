<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 25/12/2018
 * Time: 23:03
 */

namespace Literary\Model\Entity\Security;

use LiteraryCore\Entity\AbstractEntity;

class Author extends AbstractEntity
{

     private $username;
     private $password;

    public static function relationWithDb()
    {
        return [
            'username' => 'username',
            'password' => 'password',

        ];
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;

    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;

    }




}