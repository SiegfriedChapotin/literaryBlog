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
use Literary\Model\table\PostsTable;

use Literary\Model\table\TextHomeTable;
use LiteraryCore\Request\Request;
use LiteraryCore\Request\Query;
use LiteraryCore\Service\flashBag\FlashBagService;

class HomeController extends OfficeController {


    public function homepage() {
        $this->render('posts/home.html.twig',[
            'chapitres'=>(new PostsTable())->listPost('5'),

        ]);
    }


    public function showTextHome()
    {
        if (Request::exist('postModify')) {

            (new TextHomeTable())->TextHomeUpdate();
            FlashBagService::addFlashMessage('primary', 'La publication a été modifiée');
            $this->redirect('texthome_admin&id='.Query::get('id'));
            return;
        }
        $this->render('posts/Author/modification/textHomeModif.html.twig',
            [
                'texthome_admin' => (new TextHomeTable())->TextHome(),
            ]);

    }


}

