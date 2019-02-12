<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 14/11/2018
 * Time: 14:46
 */

namespace Literary\Model\table;


use LiteraryCore\Table\AbstractTable;
use Literary\Model\entity\Introduction;


class RgpdTable extends AbstractTable
{


    protected function getTableName()
    {
        return 'rgpd';
    }

    protected function getClassName()
    {
        return Introduction::class;
    }

    function RgpdUpdate($post)
    {
        $this->flush($post);
    }

    function RgpdHome()
    {
        return $this->all();
    }
}
