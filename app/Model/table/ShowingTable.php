<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:46
 */

namespace Literary\Model\table;


use LiteraryCore\Table\AbstractTable;
use Literary\Controller\Showing;

class ShowingTable extends AbstractTable

{
    protected  function getTableName()
    {
        return 'showing';
    }

    protected  function getClassName()
    {
        return Showing::class;
    }

}