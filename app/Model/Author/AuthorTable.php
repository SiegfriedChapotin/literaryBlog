<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:46
 */

namespace Literary\Model\Author;



use LiteraryCore\Table\AbstractTable;
use Literary\Controller\Author\Admin;



class AuthorTable extends AbstractTable
{
    protected  function getTableName()
    {
        return 'author';
    }

    protected  function getClassName()
    {
        return Admin::class;
    }
    /**
     * Permet au User de se connecter
     * @param string $username
     * @param string $password
     * @return bool Selon si le User peut se connecter ou non
     **/
    public function login() {

    }





    /**
    * Texte accueil

        public static function login(){
        $database=App::getInstance()->getDb();
        $author=$database->query("SELECT * FROM  author");
        return $author;
    }

   public function find()
   {
       return parent::find(); // TODO: Change the autogenerated stub
   }
*/
}