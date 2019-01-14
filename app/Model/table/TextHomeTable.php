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

 class TextHomeTable extends AbstractTable
{


    protected  function getTableName()
    {
        return 'texthome';
    }

    protected  function getClassName()
    {
        return Introduction::class;
    }



}