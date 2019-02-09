<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:16
 */

namespace Literary\Controller;


use Literary\Model\table\CommentsTable;
use Literary\Controller\office\OfficeController;
use Literary\Model\table\PostsTable;
use Literary\Model\table\ShowingTable;
use LiteraryCore\Request\Request;
use LiteraryCore\Request\Query;
use LiteraryCore\Service\flashBag\FlashBagService;
use Literary\Model\entity\Posts;

class PostController extends OfficeController
{


    public function list()
    {
        $this->render('posts/book.html.twig',['chapitreall' => (new PostsTable())->listPostAll()]);
    }

    public function show()
    {
        if (Request::exist('classify')) {
            (new CommentsTable())->classify(1);
            FlashBagService::addFlashMessage('success', 'Vous nous avez signalé un commentaire, nous vérifierons la conformité de ce dernier rapidement. Merci');
            $this->redirect('post_show&id=' . Query::get('id'));
            return;
        }

        if (Request::exist('Valider')) {
            (new CommentsTable())->commentWrite();
            FlashBagService::addFlashMessage('info', 'Votre message est bien arrivé. Merci');
            $this->redirect('post_show&id=' . Query::get('id'));
            return;
        }

        $this->render('posts/show.html.twig',
            ['chapitre' => (new PostsTable())->findPost(),
                'comments' => (new CommentsTable())->findCommentChapter(),
                'commentwrite' => (new CommentsTable())->commentWrite(),

            ]);
    }

    public function publicationOffice()
    {
        if (Request::exist('delete')) {
            (new PostsTable())->delete();
            FlashBagService::addFlashMessage('danger', 'La publication a été supprimée');
            $this->redirect('publication_Office');
            return;
        }

        if (Request::exist('classify')) {
            (new PostsTable())->classify(1);
            FlashBagService::addFlashMessage('success', 'La publication est lisible sur votre site');
            $this->redirect('publication_Office');
            return;
        }

        if (Request::exist('postModify')) {
            $this->redirect('posts_admin&id= ' . (Request::get('postModify')));
            return;
        }

        $this->render('posts/Author/office/officePublication.html.twig',
            [
                'publicationoffice' => (new PostsTable())->listPostWrite(10),
                'publicationclass' => (new PostsTable())->listPostAll()
            ]);
    }

    public function showPostsHome()
    {
        if (Request::exist('delete')) {
            (new PostsTable())->delete();
            FlashBagService::addFlashMessage('danger', 'La publication a été supprimée');
            $this->redirect('publication_Office');
            return;
        }

        if (Request::exist('postModify')) {

            $position = (new Posts())->setClassify(Request::get('is_status'));
            (new PostsTable())->PostUpdate();

            if ($position->getClassify() == '1') {
                FlashBagService::addFlashMessage('success', 'La publication est lisible sur votre site');
                $this->redirect('posts_admin&id= ' . (Request::get('postModify')));
                return;
            }
            FlashBagService::addFlashMessage('primary', 'La publication a été modifiée');
            $this->redirect('posts_admin&id= ' . (Request::get('postModify')));
            return;

        }

        $this->render('posts/Author/modification/textPostsModif.html.twig',
            [
                'posts_admin' => (new PostsTable())->find(Query::get('id')),
            ]);
    }

    public function writeText()
    {
        if (Request::exist('postSave')) {
            (new PostsTable())->NewPostWrite();
            FlashBagService::addFlashMessage('warning', 'Votre texte a bien été enregistré');
            $this->redirect('publication_Office');
            return;
        }

        $this->render('posts/Author/office/officeWriteNewText.html.twig',
            [
                'writeText' => (new PostsTable())->NewPostWrite(),
            ]);
    }
}
