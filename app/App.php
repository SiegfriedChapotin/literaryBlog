<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 24/10/2018
 * Time: 17:34
 */

namespace Literary;



use LiteraryCore\Database;
use LiteraryCore\Config;




/**
 * Class App
 * Gestion des fonctions propres à notre application
 */
class App
{
    /**
     * @var string
     */
    public $title = 'Jean Forteroche';
    /**
     * @var object
     */
    private $db_instance;
    /**
     * @var object
     */
    private static $_instance;




    protected function __construct()
    {
        $this->load();

    }

    /**
     * Récupére l'instance
     * @return object
     */


    public static function getInstance() :App
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    /**
     * Débute la session, require et charge l'autoloader
     * @return [type] [description]
     */
    protected function load()
    {
        session_start();
    }


    /**
     * Factory qui initialise la connexion à la base de données
     * @return object
     */
    public function getDb()
    {
        $config = Config::getInstance(ROOT . '/config/Config.php');
        if (is_null($this->db_instance)) {
            $this->db_instance = new Database($config->get('db_name'), $config->get('db_user'), $config->get('db_pass'), $config->get('db_host'));
        }
        return $this->db_instance;
    }


    public function forbidden(){
        header('HTTP/1.0 403 Forbidden');
        die ('Accés interdit');


}
    public function notfound(){
        header('HTTP/1.0 404 Not Found');
        die ('page introuvable');

    }
}


