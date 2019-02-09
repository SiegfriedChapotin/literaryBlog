<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:14
 */

namespace Literary\Controller;


use Literary\Controller\office\OfficeController;
use Literary\Model\table\RgpdTable;


use LiteraryCore\Request\Request;
use LiteraryCore\Request\Query;
use LiteraryCore\Service\flashBag\FlashBagService;

class RgpdController extends OfficeController {


    public function show() {

        $this->render ('posts/showRgpd.html.twig', ['rgpd'=>(new RgpdTable())->all()]);
    }


    public function showRgpdHome()
    {
        if (Request::exist('postModify')) {

            (new RgpdTable())->RgpdUpdate();
            FlashBagService::addFlashMessage('primary', 'La publication a été modifiée');
            $this->redirect('rgpd_admin&id='.Query::get('id'));
            return;
        }
        $this->render('posts/Author/modification/textRgpdModif.html.twig',
            [
                'rgpd_admin' => (new RgpdTable())->RgpdHome(),
            ]);
    }

}

