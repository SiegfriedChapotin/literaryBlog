<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 12/02/2019
 * Time: 03:12
 */

namespace Literary\Controller\office;


use Literary\Controller\BlogTrait;
use LiteraryCore\Controller\AbstractController;
use LiteraryCore\Request\Request;
use Literary\Model\table\PostsTable;
use Literary\Model\table\CommentsTable;
use Literary\Model\table\MailTable;
use LiteraryCore\Service\flashBag\FlashBagService;

class OfficeAdminController extends AbstractController
{
    use BlogTrait;

    public function admin()
    {
        if (Request::exist('commentdel')) {

            (new CommentsTable())->delete();
            FlashBagService::addFlashMessage('danger', 'Le commentaire a été supprimé');
            $this->redirect('admin');
            return;
        }

        if (Request::exist('commentreport')) {
            (new CommentsTable())->classify(0);
            FlashBagService::addFlashMessage('success', 'Le status du commentaire a été modifié');
            $this->redirect('admin');
            return;
        }

        $this->render('admin/dashboard.html.twig',
            [
                'chapitres' => (new PostsTable())->listPostWrite('6'),
                'comment' => (new CommentsTable())->listComment(6),
                'mail' => (new MailTable())->listMail(6),
                'commentreport' => (new CommentsTable())->listreport(6)
            ]);
    }
}