<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 08/11/2018
 * Time: 04:26
 */

namespace LiteraryCore;


use \PDO;

require_once ROOT.'/config/Config.php';

/**
 * Se connecte à la base de donnée grâce au système PDO
 * @package app
 */
class Database
{

    /**
     * @var object PDO
     */
    private $db;

    /**
     * Initialisation d'une instance de PDO qui sera stockée dans l'attribut prévu s'il n'existe pas encore et le retourne
     *
     * @access private
     * @param none
     * @return object PDO
     */
    private function getPDO($db_name='alaskabook', $db_user = 'root', $db_pass = '', $db_host = 'localhost')
    {
        if ($this->db === null) {
            $db = new PDO('mysql:dbname='.$db_name.';host='.$db_host.';charset=utf8', $db_user, $db_pass);
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
    public function query(string $statement, string $className = null, bool $oneResult = false)
    {
        $results = $this->getPDO()->query($statement);

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

    /**
     * Récupère l'ID du dernier élément envoyé à la DB
     *
     * @return string ID du dernier élément
     **/
    public function lastInsertId(string $tableName)
    {
        return $this->db->lastInsertId($tableName);
    }
}