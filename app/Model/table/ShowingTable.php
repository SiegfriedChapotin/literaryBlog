<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:46
 */

namespace Literary\Model\table;


use LiteraryCore\Table\AbstractTable;
use Literary\Model\entity\Showing;
use LiteraryCore\Request\Query;
use LiteraryCore\Request\Request;

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

    public function findShowing()
    {

        return $this->find(Query::get('id'));
    }


    function listShowingPubli()
    {
        return $this->query('SELECT * FROM showing WHERE classify = 1 ORDER BY showing.id DESC ');

    }

    function listShowingDraft()
    {
        return $this->query('SELECT * FROM showing WHERE classify = 0 ORDER BY showing.id DESC ');
    }

    function NewShowingWrite()
    {
        if (Request::exist('TitleDashboard') && Request::exist('TextDashboard')) {
            $post = (new Showing())->setText(Request::get('TextDashboard'))->setTitle(Request::get('TitleDashboard'))->setClassify(Request::get('is_status'));
            $this->flush($post);

            return header('Location:index.php?p=publication_Office');
        }

    }

    function ShowingUpdate()
    {
        $post = (new Showing())->setId(intval(Query::get('id')))->setText(Request::get('TextDashboard'))->setTitle(Request::get('TitleDashboard'))->setClassify(Request::get('is_status'));
        $this->flush($post);

    }
}