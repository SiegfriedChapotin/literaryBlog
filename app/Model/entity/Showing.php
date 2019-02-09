<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
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
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }


    /**
     * @return integer
     */
    public function getClassify()
    {
        return $this->classify;
    }

    /**
     * @param integer $classify
     */
    public function setClassify($classify)
    {
        $this->classify = $classify;
        return $this;
    }

}