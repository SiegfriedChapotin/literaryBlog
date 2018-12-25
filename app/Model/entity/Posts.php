<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:46
 */

namespace Literary\Model\entity;


class Posts
{
    private $id;
    private $title;
    private $text;
    private $date;
    private $isStatus;


    /**
     * Posts constructor.
     *
     */
    public function __construct(array $array = [])
    {
        if (!empty($array)) {

            $this->id = $array["id"];
            $this->title = $array ["title"];
            $this->text = $array ["text"];
            $this->datet = $array["date"];
            $this->isStatus = $array ["is_status"];
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
     * @return stringd
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

    /**
     * @return
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param  $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return integer
     */
    public function getisStatus()
    {
        return $this->isStatus;
    }

    /**
     * @param integer $isStatus
     */
    public function setIsStatus($isStatus): int
    {
        $this->isStatus = $isStatus;
    }

}