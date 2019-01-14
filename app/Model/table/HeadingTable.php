<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:46
 */

namespace Literary\Model\table;


use LiteraryCore\Table\AbstractTable;
use Literary\Model\entity\Introduction;

use LiteraryCore\Request\Query;


class HeadingTable extends AbstractTable

{



    protected  function getTableName()
    {
        return 'heading';
    }

    protected  function getClassName()
    {
        return Introduction::class;
    }



    public function findShowing(){

              return $this->find(Query::get('id'));
        }

}