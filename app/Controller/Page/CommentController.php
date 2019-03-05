<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 27/11/2018
 * Time: 16:27
 */

namespace Literary\Controller\Page;

use Literary\Controller\BlogTrait;
use LiteraryCore\Controller\AbstractController;
use Literary\Model\Table\CommentsTable;
use LiteraryCore\Request\Request;
use LiteraryCore\Service\FlashBag\FlashBagService;

class CommentController extends AbstractController
{
    use BlogTrait;

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
                'commentoffice' => (new CommentsTable())->listComment(),
                'commentreport' => (new CommentsTable())->listReport()

            ]);
    }

}