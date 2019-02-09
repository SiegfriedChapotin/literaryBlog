<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:14
 */

namespace Literary\Controller;


use Literary\Model\entity\Introduction;
use Literary\Controller\office\OfficeController;
use Literary\Model\table\HeadingTable;
use Literary\Model\table\ShowingTable;

use LiteraryCore\Request\Query;
use LiteraryCore\Request\Request;
use LiteraryCore\Service\flashBag\FlashBagService;

class HeadingController extends OfficeController {


    public function show() {

        $this->render ('posts/showheading.html.twig', ['heading'=>(new HeadingTable())->findShowing()]);

    }



    public function showHeadingHome()
{
    if (Request::exist('postModify')) {

        (new HeadingTable())->HeadingUpdate();
        FlashBagService::addFlashMessage('primary', 'La publication a été modifiée');
        $this->redirect('heading_admin&id='.Query::get('id'));
        return;
    }

    $this->render('posts/Author/modification/textHeadingModif.html.twig',
        [
            'heading_admin' => (new HeadingTable())->find(Query::get('id')),
        ]);
}
}


