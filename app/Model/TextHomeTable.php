<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:46
 */

namespace Literary\Model;




use Literary\Controller\Texthome;
use LiteraryCore\Table\AbstractTable;
use LiteraryCore\Request\Query;
Use LiteraryCore\Request\Request;

 class TextHomeTable extends AbstractTable
{


    protected  function getTableName()
    {
        return 'texthome';
    }

    protected  function getClassName()
    {
        return Texthome::class;
    }


}