<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 27/11/2018
 * Time: 16:27
 */

namespace Literary\Controller\page;

use Literary\Controller\BlogController;
use LiteraryCore\Controller\AbstractController;
use Literary\Model\table\CommentsTable;
use LiteraryCore\Request\Query;
use LiteraryCore\Request\Request;
use LiteraryCore\Service\flashBag\FlashBagService;

class CommentController extends AbstractController
{
    use BlogController;

    public function commentOffice()
    {
        if (Request::exist('delete')) {
            (new CommentsTable())->delete();
            FlashBagService::addFlashMessage('danger', 'Le commentaire a été supprimé');
            $this->redirect('comment_Office');
            return;
        }
        if (Request::exist('classify')) {
            (new CommentsTable())->classify(0);
            FlashBagService::addFlashMessage('success', 'Le commentaire a été archivé');
            $this->redirect('comment_Office');
            return;
        }
        $this->render('admin/Office/officeComment.html.twig',
            [
                'commentoffice' => (new CommentsTable())->listComment(10),
                'commentreport' => (new CommentsTable())->listReport(10)

            ]);
    }

}