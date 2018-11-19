<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:46
 */

namespace Literary\Model;

use Literary\App;
use \LiteraryCore\Request\Query;



class TableHeading{


    public static function headings(){
        $database=App::getInstance()->getDb();
        $heading=$database->query("SELECT * FROM  heading");
        return $heading;
    }

    public static function heading(){
        $database=App::getInstance()->getDb();
        $heading=$database->prepare("SELECT * FROM  heading WHERE id=?",[Query::get('id')]);
        return $heading;
    }
}