<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:46
 */

namespace Literary\Model\entity;


class Comment
{
    private $id;
    private $idChapter;
    private $pseudo;
    private $comment;
    private $isReported;
    private $date;


    /**
     * Comment constructor.
     *
     */
    public function __construct(array $array = [])
    {
        if (!empty($array)) {

            $this->id = $array["id"];
            $this->idChapter = $array ["id_chapter"];
            $this->pseudo = $array ["pseudo"];
            $this->comment = $array["comment"];
            $this->isReported = $array ["is_reported"];
            $this->date = $array ["date"];
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
     * @return integer
     */
    public function getIdChapter()
    {
        return $this->idChapter;
    }

    /**
     * @param integer $idChapter
     */
    public function setIdChapter($idChapter): int
    {
        $this->idChapter = $idChapter;
    }

    /**
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     */
    public function setPseudo($pseudo): string
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment): string
    {
        $this->comment = $comment;
    }

    /**
     * @return integer
     */
    public function getisReported()
    {
        return $this->isReported;
    }

    /**
     * @param integer $isReported
     */
    public function setIsReported($isReported): int
    {
        $this->isReported = $isReported;
    }

    /**
     * @return
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }


}