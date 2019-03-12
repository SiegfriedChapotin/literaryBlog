<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 14/11/2018
 * Time: 14:46
 */

namespace Literary\Model\Entity;

use LiteraryCore\Entity\AbstractEntity;

class Mail extends AbstractEntity
{

    private $name;
    private $email;
    private $text;
    private $title;
    protected $classify;


    public static function relationWithDb()
    {
        return [
            'name' => 'name',
            'email' => 'email',
            'text' => 'text',
            'title' => 'title',
        ];
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClassify()
    {
        return $this->classify;
    }

    /**
     * @param mixed $classify
     */
    public function setClassify($classify)
    {
        $this->classify = $classify;
        return $this;
    }

}