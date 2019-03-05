<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 14/11/2018
 * Time: 14:46
 */

namespace Literary\Model\Table;


use LiteraryCore\Table\AbstractTable;
use Literary\Model\Entity\Introduction;


class HeadingTable extends AbstractTable

{


    protected function getTableName()
    {
        return 'heading';
    }

    protected function getClassName()
    {
        return Introduction::class;
    }

    public function findShowing($id)
    {
        return $this->find($id);
    }

    function HeadingUpdate($post)
    {
        $this->flush($post);
    }
}