<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:46
 */

namespace Literary\Model;


use LiteraryCore\Table\AbstractTable;
use Literary\Controller\Heading;

class HeadingTable extends AbstractTable

{
    protected  function getTableName()
    {
        return 'heading';
    }

    protected  function getClassName()
    {
        return Heading::class;
    }

}