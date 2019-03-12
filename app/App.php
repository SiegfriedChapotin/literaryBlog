<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 11/02/2019
 * Time: 19:03
 */

namespace Literary;


use LiteraryCore\Database\MysqlDatabase;
use LiteraryCore\Config\Config;
use LiteraryCore\Service\FlashBag\FlashBagService;


/**
 * Class App
 * Gestion des fonctions propres à notre application
 */
class App
{
    /**
     * @var object
     */
    private $db_instance;
    /**
     * @var object
     */
    private static $_instance;


    /**
     * Récupére l'instance
     * @return object
     */


    public static function getInstance(): App
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
    public static function load()
    {
        session_start();
        FlashBagService::init();
    }

    /**
     * Factory qui initialise la connexion à la base de données
     * @return object
     */
    public function getDb()
    {
        $config = Config::getInstance(ROOT . '/config/Config.php');
        if (is_null($this->db_instance)) {
            $this->db_instance = new MysqlDatabase($config->get('db_name'), $config->get('db_user'), $config->get('db_pass'), $config->get('db_host'));
        }
        return $this->db_instance;
    }
}