<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 25/12/2018
 * Time: 23:03
 */

namespace Literary\Model\entity\Security;


class User
{
    private $username;
    private $password;

    /**
     * User constructor.
     * @param $username
     * @param $password
     */
    public function __construct(array $array=[])
    {
        $this->username = $array["username"];
        $this->password = $array["password"];
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
    public function setUsername($username): string
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