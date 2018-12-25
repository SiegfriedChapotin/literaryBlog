<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:46
 */

namespace Literary\Model\entity;


class Introduction
{

    private $id;
    private $title;
    private $text;


    /**
     * Showing or TextHome or Heading constructor.
     *
     */
    public function __construct(array $array = [])
    {
        if (!empty($array)) {

            $this->id = $array["id"];
            $this->title = $array ["title"];
            $this->text = $array["text"];

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
     */
    public function setId($id): int
    {
        $this->id = $id;
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
    public function setTitle($title): string
    {
        $this->title = $title;
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
    public function setText($text): string
    {
        $this->text = $text;
    }

}