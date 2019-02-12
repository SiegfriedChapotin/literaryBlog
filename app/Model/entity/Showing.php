<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 14/11/2018
 * Time: 14:46
 */

namespace Literary\Model\entity;

use LiteraryCore\Entity\AbstractEntity;

class Showing extends AbstractEntity
{
    private $title;
    private $text;
    private $classify;



    public static function relationWithDb()
    {
        return [
            'title' => 'title',
            'text' => 'text',
            'classify' => 'classify',
        ];
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