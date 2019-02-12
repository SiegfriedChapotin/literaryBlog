<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 11/02/2019
 * Time: 18:18
 */

namespace LiteraryCore\Database;

use \PDO;


/**
* Se connecte à la base de donnée grâce au système PDO
* @package app
*/

class MysqlDatabase extends Database{



    private $db_name;
    private $db_user;
    private $db_host;
    private $db_pass;


    /**
     * @var object PDO
     */
    private $db;

    /**
     * MysqlDatabase constructor.
     * @param $db_name
     * @param $db_user
     * @param $db_host
     * @param $db_pass
     */
    public function __construct($db_name, $db_user, $db_pass, $db_host)
    {
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_host = $db_host;
        $this->db_pass = $db_pass;
    }

    /**
     * Initialisation d'une instance de PDO qui sera stockée dans l'attribut prévu s'il n'existe pas encore et le retourne
     * @access private
     * @return object PDO
     */
    private function getPDO()
    {
        if ($this->db === null) {

            $db = new PDO("mysql:dbname=" . $this->db_name . ";host=" . $this->db_host . ';charset=utf8', $this->db_user, $this->db_pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db = $db;
        }

        return $this->db;

    }

    /**
     * Fait une requête SQL qu'elle reçoit en paramètre
     *
     * @access public
     * @param string $statement requête SQL
     * @param string $className classe de retour pour la récupération des données
     * @param bool $oneResult (optional) indique si on souhaite récupérer un élément et on fait un fetch ou plusieurs et on fait un fetchAll
     * @return object $className objet retourné selon celui passé en paramètre
     */
    public function query(string $statement, string $className = null, bool $oneResult = false, bool $noFetch = false)
    {
        $results = $this->getPDO()->query($statement);
        if ($noFetch) {
            return null;
        }
        if ($className === null) {
            $results->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $results->setFetchMode(PDO::FETCH_CLASS, $className);
        }

        if ($oneResult) {
            $datas = $results->fetch();
        } else {
            $datas = $results->fetchAll();
        }

        return $datas;
    }

    /**
     * Fait un requête SQL préparée qu'elle reçoit en paramètre
     *
     * @access public
     * @param string $statement requête SQL
     * @param array $parameters paramètre à ajouter dans la requête SQL
     * @param string $className classe de retour pour la récupération des données
     * @param bool $oneResult (optional) indique si on souhaite récupérer un élément et on fait un fetch ou plusieurs et on fait un fetchAll
     * @return object $className objet retourné selon celui passé en paramètre
     */
    public function prepare(string $statement, array $parameters, string $className = null, bool $oneResult = false, bool $noFetch = false)
    {
        $prep = $this->getPDO()->prepare($statement);

        if (!$noFetch) {
            $prep->execute($parameters);

            if ($className === null) {
                $prep->setFetchMode(PDO::FETCH_OBJ);
            } else {
                $prep->setFetchMode(PDO::FETCH_CLASS, $className);
            }

            if ($oneResult) {
                $datas = $prep->fetch();
            } else {
                $datas = $prep->fetchAll();
            }

            return $datas;
        } else {
            return $prep->execute($parameters);
        }
    }

}