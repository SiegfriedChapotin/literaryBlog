<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:46
 */

namespace Literary\Model\table;


use Literary\Model\entity\Introduction;
use LiteraryCore\Table\AbstractTable;
use LiteraryCore\Request\Query;

class ShowingTable extends AbstractTable

{
    protected  function getTableName()
    {
        return 'showing';
    }

    protected  function getClassName()
    {
        return Introduction::class;
    }

    public function findShowing(){

        return $this->find(Query::get('id'));
    }
}