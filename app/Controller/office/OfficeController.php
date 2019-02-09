<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:14
 */

namespace Literary\Controller\office;


use Literary\Model\table\MailTable;
use Literary\Model\table\ShowingTable;
use LiteraryCore\Controller\AbstractController;
use Literary\Model\table\TextHomeTable;
use Literary\Model\table\PostsTable;
use Literary\Model\table\HeadingTable;
use Literary\Model\table\RgpdTable;
use LiteraryCore\Service\flashBag\FlashBagService;
use LiteraryCore\Request\Request;
use Literary\Model\table\CommentsTable;


class OfficeController extends AbstractController
{


    public function __postConstruct()
    {
        $this->twig->addGlobal('chapitresall', (new PostsTable())->all());
        $this->twig->addGlobal('texthome', (new TextHomeTable())->all());
        $this->twig->addGlobal('headings', (new HeadingTable())->all());
        $this->twig->addGlobal('showingsP', (new ShowingTable())->listShowingPubli());
        $this->twig->addGlobal('showingsD', (new ShowingTable())->listShowingDraft());
        $this->twig->addGlobal('rgpd', (new RgpdTable())->all());
    }

    public function admin()
    {
        //number of posts displayed on the desktop
        $nb=6;

        if (Request::exist('delete')) {

            (new CommentsTable())->delete();
            FlashBagService::addFlashMessage('danger', 'La publication a été supprimée');
            $this->redirect('admin');
            return;
        }

        if (Request::exist('classify')) {
            (new CommentsTable())->classify(0);
            FlashBagService::addFlashMessage('primary', 'La publication a été modifiée');
            $this->redirect('admin');
            return;
        }


        $this->render('posts/Author/dashboard.html.twig',
            [
                'chapitres' => (new PostsTable())->listPostWrite($nb),
                'comment' => (new CommentsTable())->listComment($nb),
                'mail' => (new MailTable())->listMail($nb),
                'commentreport' => (new CommentsTable())->listreport($nb)
            ]);
    }


}

