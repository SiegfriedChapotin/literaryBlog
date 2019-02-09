<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:46
 */

namespace Literary\Model\entity;

use LiteraryCore\Entity\AbstractEntity;

class Comment extends AbstractEntity
{

    private $idChapter;
    private $pseudo;
    private $comment;
    private $classify;



    public static function relationWithDb()
    {
        return [
            'idChapter' => 'id_Chapter',
            'pseudo' => 'pseudo',
            'comment' => 'comment',

        ];
    }

    /**
     * @return mixed
     */
    public function getIdChapter()
    {
        return $this->idChapter;
    }

    /**
     * @param mixed $idChapter
     */
    public function setIdChapter($idChapter)
    {
        $this->idChapter = $idChapter;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
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
     * @param mixed $isReported
     */
    public function setClassify($classify)
    {
        $this->classify = $classify;
        return $this;
    }




}