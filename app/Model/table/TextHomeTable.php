<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 11/02/2019
 * Time: 22:37
 */

namespace Literary\Model\table;

use LiteraryCore\Table\AbstractTable;
use Literary\Model\entity\Introduction;


class TextHomeTable extends AbstractTable
{
    protected function getTableName()
    {
        return 'texthome';
    }

    protected function getClassName()
    {
        return Introduction::class;
    }

    function TextHomeUpdate($post)
    {
        $this->flush($post);
    }

    function TextHome()
    {
        return $this->all();
    }
}