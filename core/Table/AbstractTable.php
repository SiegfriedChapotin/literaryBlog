<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 19/11/2018
 * Time: 09:53
 */

namespace LiteraryCore\Table;


use Literary\App;

/**
 * Classe mère de tous les appels à la bd
 */
abstract class AbstractTable
{
    protected abstract function getTableName();

    protected abstract function getClassName();

    private function getDb()
    {

        return App::getInstance()->getDb();
    }

    /**
     * Appelle tous les éléments du modèle passé en paramètre
     * @return array Tableau avec tous les éléments à renvoyer
     */
    public function all()
    {
        return $this->query('SELECT * FROM ' . $this->getTableName());
    }

    /**
     * Récupère un élément selon la table
     * @param string $id ID de l'élément à récupérer
     * @return object Objet du type de la table appelée
     */
    public function find($id)
    {

        return $this->query('SELECT * FROM ' . $this->getTableName() . ' WHERE id= :id', ['id' => $id]);
    }

    /**
     * Lance la méthode query ou prepare de MysqlDatabase selon les paramètres qu'elle reçoit
     * @param string $statement Ligne de code SQL qui gère la requête
     * @param bool $onlyOne = false Indique si on souhaite un ou plusieurs éléments
     * @return object PDOStatement
     */

    public function query(string $statement, array $attributes = [])
    {
        if (empty($attributes)) {
            return $this->getDb()->query($statement, $this->getTableName());
        } else {
            return $this->getDb()->prepare($statement, $attributes, $this->getTableName());
        }

    }

    function create($fields)
    {
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $value) {
            $sql_parts[] = "$key = ?";
            $attributes[] = $value;
        }
        $sql_part = implode(', ', $sql_parts);
        $this->getDb()->prepare("INSERT INTO {$this->getTableName()} SET " . $sql_part, $attributes, null, false, true);

    }

    /**
     * Modifie ou ajoute un élément AbstractTable dans la DB     *
     * @param string $statement Ligne de code SQL qui gère la requête
     * @param array $attributes Tableau des données pour modifier l'Entity
     * @return bool Retourne true si c'est réussi
     *
     **/
    public function update($id, $fields)
    {
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $value) {
            $sql_parts[] = "$key = ?";
            $attributes[] = $value;
        }
        $attributes[] = $id;
        $sql_part = implode(', ', $sql_parts);
        $this->getDb()->prepare("UPDATE {$this->getTableName()} SET " . $sql_part . "WHERE id = ?", $attributes, true);
    }
    /**
     * Supprimer un élément de la BD
     *
     * @param string $id ID de l'élément à supprimer
     *
     * public function delete(string $id)
     * {
     * return $this->db->prepare('DELETE FROM `' . $this->table . 'WHERE id=?', [$id], $this->table, true, true);
     * }
     **/
}