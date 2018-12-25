<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:14
 */

namespace Literary\Controller;


use LiteraryCore\Controller\AbstractController;
use Literary\Model\table\HeadingTable;
use LiteraryCore\Request\Query;



class HeadingController extends AbstractController {


    public function show() {
        $this->render ('posts/showheading.html.twig',['heading'=>(new HeadingTable())->find($id=Query::get('id'))]);

    }


}


