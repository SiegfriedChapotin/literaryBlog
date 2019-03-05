<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 11/02/2019
 * Time: 22:39
 */

namespace Literary\Model\Entity;

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