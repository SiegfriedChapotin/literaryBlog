<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:14
 */

namespace Literary\Controller;


use LiteraryCore\Controller\AbstractController;
use Literary\Model\ShowingTable;
use LiteraryCore\Request\Query;




class Showing extends AbstractController {


    public function show() {
        $this->render ('posts/showheading.html.twig',[
            'showing'=>(new ShowingTable())->find($id=Query::get('id')),
            'showings' => (new ShowingTable())->all()
        ]);

    }


}


