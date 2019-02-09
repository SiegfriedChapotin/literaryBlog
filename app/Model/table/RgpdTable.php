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

use LiteraryCore\Request\Request;
use LiteraryCore\Request\Query;

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

    function RgpdUpdate()
    {
        $post = (new Introduction())->setId(intval(Query::get('id')))->setText(Request::get('TextDashboard'))->setTitle(Request::get('TitleDashboard'));
        $this->flush($post);

    }

    function RgpdHome()
    {

       return $this->all();
}}
