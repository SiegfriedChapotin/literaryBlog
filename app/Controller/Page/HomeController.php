<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 11/02/2019
 * Time: 22:31
 */

namespace Literary\Controller\Page;

use Literary\Controller\BlogTrait;
use LiteraryCore\Controller\AbstractController;
use LiteraryCore\Service\FlashBag\FlashBagService;
use Literary\Model\Table\PostsTable;
use Literary\Model\Table\TextHomeTable;
use LiteraryCore\Request\Request;
use LiteraryCore\Request\Query;
use Literary\Model\Entity\Introduction;
use LiteraryCore\Service\ReCaptChaValidator;


class HomeController extends AbstractController
{
    use BlogTrait;

    public function homepage()
    {
        $int=5;
        $this->render('posts/home.html.twig', ['chapitres' => (new PostsTable())->listPostHome($int)]);
    }

    public function showTextHome()
    {
        if ((Request::exist('postModify'))&& (ReCaptChaValidator::validateReCaptChat())) {
            $post = (new Introduction())->setId(intval(Query::get('id')))->setText(Request::get('TextDashboard'))->setTitle(Request::get('TitleDashboard'));

            (new TextHomeTable())->TextHomeUpdate($post);
            FlashBagService::addFlashMessage('primary', 'La publication a été modifiée');
            $this->redirect('texthome_admin&id=' . Query::get('id'));
            return;
        }
        $this->render('admin/Modification/textHomeModif.html.twig', ['texthome_admin' => (new TextHomeTable())->TextHome()]);
    }
}