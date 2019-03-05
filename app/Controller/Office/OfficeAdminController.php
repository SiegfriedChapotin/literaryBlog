<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 12/02/2019
 * Time: 03:12
 */

namespace Literary\Controller\Office;


use Literary\Controller\BlogTrait;
use LiteraryCore\Controller\AbstractController;
use LiteraryCore\Request\Request;
use Literary\Model\Table\PostsTable;
use Literary\Model\Table\CommentsTable;
use Literary\Model\Table\MailTable;
use LiteraryCore\Service\FlashBag\FlashBagService;

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

        $int=6;

        $this->render('admin/dashboard.html.twig',
            [
                'chapitres' => (new PostsTable())->listPostWriteAdmin($int),
                'comment' => (new CommentsTable())->listCommentAdmin($int),
                'mail' => (new MailTable())->listMailAdmin($int),
                'commentreport' => (new CommentsTable())->listreportAdmin($int)
            ]);
    }
}