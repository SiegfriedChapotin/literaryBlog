<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 23/01/2019
 * Time: 16:25
 */

namespace LiteraryCore\Entity;


abstract class AbstractEntity
{
    protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return AbstractEntity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;

    }


    public abstract static function relationWithDb();
}