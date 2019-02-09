<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:46
 */

namespace Literary\Model\entity;

use LiteraryCore\Entity\AbstractEntity;

class Introduction extends AbstractEntity
{


    private $title;
    private $text;

    public static function relationWithDb()
    {
        return [
            'title' => 'title',
            'text' => 'text',

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




}