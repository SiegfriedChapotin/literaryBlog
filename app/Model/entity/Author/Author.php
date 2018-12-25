<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:46
 */

namespace Literary\Model\entity\Author;


class Author
{
    private $id;
    private $username;
    private $password;

    /**
     * Author constructor.
     * @param $id
     * @param $username
     * @param $password
     */
    public function __construct(array $array = [])
    {
        if (!empty($array)) {

            $this->id = $array["id"];
            $this->username = $array ["username"];
            $this->password = $array ["password"];
        };
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     * @return Author
     */
    public function setId($id) :int
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return Author
     */
    public function setUsername($username) :string
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     * @return Author
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }


}