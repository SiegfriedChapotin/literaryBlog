<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 11/02/2019
 * Time: 20:53
 */

namespace LiteraryCore\Table;

use Literary\App;

use LiteraryCore\Exception\HttpException\NotFoundHttpException;
use LiteraryCore\Entity\AbstractEntity;
use LiteraryCore\Request\Request;

use PDO;

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


        return $this->query('SELECT * FROM ' . $this->getTableName() . ' WHERE id= :id', ['id' => $id], true);

    }

    /**
     * Lance la méthode query ou prepare de MysqlDatabase selon les paramètres qu'elle reçoit
     * @param string $statement Ligne de code SQL qui gère la requête
     * @param bool $onlyOne = false Indique si on souhaite un ou plusieurs éléments
     * @return object PDOStatement
     */

    public function query(string $statement, array $attributes = [], bool $oneResult = false)
    {
        if (empty($attributes)) {
            return $this->getDb()->query($statement, $this->getClassName(), $oneResult);
        } else {
            return $this->getDb()->prepare($statement, $attributes, $this->getClassName(), $oneResult);
        }

    }

    /**
     * triage create/update
     * @param AbstractEntity $object
     */

    public function flush(AbstractEntity $object)

    {
        $id = $object->getId();

        if (empty($id)) {

            $this->create($object);
        } else {
            $this->update($object);
        }
    }

    protected function create(AbstractEntity $object)
    {
        if (get_class($object) !== $this->getClassName()) {

            throw new NotFoundHttpException();

        }

        // INSERT INTO Post (id, title, content) VALUES (:id, :title, :content)

        $sql = 'INSERT INTO ' . $this->getTableName() . ' ';
        $data = [];
        $columnNames = [];


        $relationWithDb = $this->getClassName()::relationWithDb();

        foreach ($relationWithDb as $parameterName => $columnName) {
            $data[':' . $columnName] = $this->getValue($object, $parameterName);
            $columnNames[] = $columnName;

        }

        // rajout des noms des colonnes
        $sql .= '(' . implode(',', $columnNames) . ')';

        //rajout des elements à remplacer par les valeurs
        $sql .= ' VALUES (:' . implode(', :', $columnNames) . ')';


        // je peux envoyer ça au prepare et execute de PDO
        //
        $this->getDb()->prepare($sql, $data, null, false, true);
    }

    protected function update(AbstractEntity $object)
    {

        if (get_class($object) !== $this->getClassName()) {
            throw new NotFoundHttpException();
        }

        // UPDATE book SET (id, title, content)

        $sql = 'UPDATE ' . $this->getTableName() . ' SET ';
        $data = [];
        $columnNames = [];


        $relationWithDb = $this->getClassName()::relationWithDb();


        foreach ($relationWithDb as $parameterName => $columnName) {
            $data[':' . $columnName] = $this->getValue($object, $parameterName);
            $columnNames[] = $columnName;
        }


        // rajout des noms des colonnes
        $addComa = false;

        foreach ($columnNames as $columnName) {

            if ($addComa === true) {
                $sql .= ", ";
            }
            $sql .= $columnName . ' = :' . $columnName . ' ';
            $addComa = true;
        }

        //rajout des elements à remplacer par les valeurs
        $sql .= ' WHERE id = :id ';


        // je peux envoyer ça au prepare et execute de PDO
        $data['id'] = $object->getId();
        $this->getDb()->prepare($sql, $data, null, false, true);
    }

    protected function getValue(AbstractEntity $object, string $parameterName)
    {
        $methodName = '$' . ucfirst($parameterName);

        if (method_exists($object, $methodName)) {
            return $object->$methodName();
        }

        $methodName = 'get' . ucfirst($parameterName);

        if (method_exists($object, $methodName)) {
            return $object->$methodName();
        }

        $methodName = 'is' . ucfirst($parameterName);

        if (method_exists($object, $methodName)) {
            return $object->$methodName();
        }

        throw new NotFoundHttpException();
    }

    function classify(int $nb)
    {
        $id = intval((Request::get('classify')));
        $this->getDb()->prepare("UPDATE {$this->getTableName()} SET classify = ?  WHERE id = " . $id, [$nb], null, false, true);
    }

    function control($id)
    {
        $count = $this->getDb()->prepare("SELECT COUNT(*) AS nbr FROM " . $this->getTableName() . "  WHERE numero=?" . $id);

        $count->execute(array($id));
        $req = $count->fetch(PDO::FETCH_ASSOC);

        if ($req['nbr'] == 0) {
            throw new NotFoundHttpException();
        }

    }


    public function delete()
    {
        $id = Request::get('delete');
        return $this->getDb()->prepare("DELETE FROM {$this->getTableName()} WHERE id = ?", [$id], null, false, true);
    }

    public function getPost($offset, $nb)
    {
        $result = $this->getDb()->prepare("SELECT * FROM {$this->getTableName()} LIMIT :offset, :nb", [':offset' => $offset, ':nb' => $nb]);
        return (!empty($result)) ? $result : null;
    }

    public function countPosts()
    {
        $result = $this->getDb()->query("SELECT COUNT(id) FROM {$this->getTableName()}", PDO::FETCH_NUM);

        return $result [0];
    }
}
