<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:46
 */

namespace Literary\Model\Author;

use Literary\App;




class TableAuthor
{

    /**
    * Texte accueil
    **/
    public static function login(){
        $database=App::getInstance()->getDb();
        $author=$database->query("SELECT * FROM  author");
        return $author;
    }

}