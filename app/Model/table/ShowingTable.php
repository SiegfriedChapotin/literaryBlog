<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 14/11/2018
 * Time: 14:46
 */

namespace Literary\Model\table;


use LiteraryCore\Table\AbstractTable;
use Literary\Model\entity\Showing;


class ShowingTable extends AbstractTable

{
    protected function getTableName()
    {
        return 'showing';
    }

    protected function getClassName()
    {
        return Showing::class;
    }

    public function findShowing($id)
    {

        return $this->find($id);
    }


    function listShowingPubli()
    {
        return $this->query('SELECT * FROM showing WHERE classify = 1 ORDER BY showing.id DESC ');

    }

    function listShowingDraft()
    {
        return $this->query('SELECT * FROM showing WHERE classify = 0 ORDER BY showing.id DESC ');
    }

    function NewShowingWrite($post)
    {
        $this->flush($post);
    }

    function ShowingUpdate($post)
    {
        $this->flush($post);

    }
}