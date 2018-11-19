<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 17:08
 */

namespace Literary\Model;

use Literary\App;
use \LiteraryCore\Request\Query;

class TablePosts



{
    public static function chapitres(){
    $database = App::getInstance()->getDb();
    $chapitres = $database->query("SELECT * FROM  book  ORDER BY book.date DESC LIMIT 5");
    return $chapitres;
    }

    public static function chapitresall(){
        $database = App::getInstance()->getDb();
        $chapitres = $database->query("SELECT * FROM  book  ORDER BY book.date DESC");
        return $chapitres;
    }

    public static function chapitre(){
        $database=App::getInstance()->getDb();
        $chapitre=$database->prepare("SELECT * FROM  book WHERE id=?",[Query::get('id')]);
        return $chapitre;
    }
}