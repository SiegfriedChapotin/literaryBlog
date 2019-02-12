<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 11/02/2019
 * Time: 22:31
 */

namespace Literary\Controller\page;

use Literary\Controller\BlogController;
use LiteraryCore\Controller\AbstractController;
use LiteraryCore\Service\flashBag\FlashBagService;
use Literary\Model\table\PostsTable;
use Literary\Model\table\TextHomeTable;
use LiteraryCore\Request\Request;
use LiteraryCore\Request\Query;
use Literary\Model\entity\Introduction;


class HomeController extends AbstractController
{
    use BlogController;

    public function homepage()
    {
        $this->render('posts/home.html.twig', ['chapitres' => (new PostsTable())->listPost('5')]);
    }

    public function showTextHome()
    {
        if (Request::exist('postModify')) {
            $post = (new Introduction())->setId(intval(Query::get('id')))->setText(Request::get('TextDashboard'))->setTitle(Request::get('TitleDashboard'));

            (new TextHomeTable())->TextHomeUpdate($post);
            FlashBagService::addFlashMessage('primary', 'La publication a été modifiée');
            $this->redirect('texthome_admin&id=' . Query::get('id'));
            return;
        }
        $this->render('admin/Modification/textHomeModif.html.twig', ['texthome_admin' => (new TextHomeTable())->TextHome()]);
    }
}