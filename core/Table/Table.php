<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 19/11/2018
 * Time: 09:53
 */

namespace LiteraryCore\Table;

use LiteraryCore\Database;
use Literary\App;


/**
 * Classe mère de tous les appels à la bd
 */
abstract class Table
{
    /** @var string $table Nom de la Table en ligne */
    protected $table;

    /** @var string $class Nom de la Classe */
    protected $class;

    /** @var Object \Core\Database $db Instance de la DB */
    protected $db;

    /**
     * Initialise le nom de la table
     *
     * @param none
     * @return none
     */
    public function __construct(Database $db) {

        $this->db = $db;
        if (is_null($this->table)) {
            $parts = explode('\\', get_class($this));
            $class_name = end($parts);
            $this->table = strtolower(str_replace('Table', '', $class_name)) . 's';
        }

    }

    /**
     * Appelle tous les éléments du modèle passé en paramètre
     *
     * @return array Tableau avec tous les éléments à renvoyer
     */
    public static function all() {
        $database=App::getInstance()->getDb();
        return $database->query("SELECT * FROM texthome");
    }

    /**
     * Récupère un élément selon la table
     *
     * @param string $id ID de l'élément à récupérer
     * @return object Objet du type de la table appelée
     */
    public function find(string $id) {
        return $this->query('SELECT * FROM ' . $this->table . ' WHERE id=?', array($id), true);
    }

    /**
     * Lance la méthode query ou prepare de Database selon les paramètres qu'elle reçoit
     *
     * @param string $statement Ligne de code SQL qui gère la requête
     * @param array $attributes = [] Tableau des données pour récupérer l'Entity
     * @param bool $onlyOne = false Indique si on souhaite un ou plusieurs éléments
     * @return object PDOStatement

    public function query(string $statement, array $attributes = [], bool $onlyOne = false) {
        if (empty($attributes)) {
            return $this->db->query($statement, $this->entity, $onlyOne);
        } else {
            return $this->db->prepare($statement, $attributes, $this->entity, $onlyOne);
        }

    }
*/
    /**
     * Modifie ou ajoute un élément Table dans la DB
     *
     * @param string $statement Ligne de code SQL qui gère la requête
     * @param array $attributes Tableau des données pour modifier l'Entity
     * @return bool Retourne true si c'est réussi

    public function update(string $statement, array $attributes)
    {
        foreach ($attributes as $attribute) {
            if ($attributes === '') {
                return false;
            }
        }

        return $this->db->prepare($statement, $attributes, $this->entity, true, true);
    }
**/
    /**
     * Supprimer un élément de la BD
     *
     * @param string $id ID de l'élément à supprimer
     **/
    public function delete(string $id)
    {
        return $this->db->prepare('DELETE FROM `' . $this->table . '` WHERE id=?', [$id], $this->table, true, true);
    }
}