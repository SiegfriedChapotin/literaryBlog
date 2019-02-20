<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 14/11/2018
 * Time: 14:16
 */

namespace Literary\Controller\page;

use Literary\Controller\BlogTrait;
use Literary\Model\table\CommentsTable;
use LiteraryCore\Controller\AbstractController;
use Literary\Model\table\PostsTable;
use LiteraryCore\Exception\httpException\NotFoundHttpException;
use LiteraryCore\Request\Request;
use LiteraryCore\Request\Query;
use LiteraryCore\Service\flashBag\FlashBagService;
use Literary\Model\entity\Posts;
use Literary\Model\entity\Comment;


class PostController extends AbstractController
{
    use BlogTrait;


    public function list()
    {
        $this->render('posts/book.html.twig', ['chapitreall' => (new PostsTable())->listPostAll()]);
    }

    public function show()
    {


        if (Request::exist('classify')) {
            (new CommentsTable())->classify(1);
            FlashBagService::addFlashMessage('success', 'Vous nous avez signalé un commentaire, nous vérifierons la conformité de ce dernier rapidement. Merci');
            $this->redirect('chapter_show&id=' . Query::get('id'));
            return;
        }

        if (Request::exist('Valider')) {
            if (strlen(Request::get('pseudo')) > 30) {
                FlashBagService::addFlashMessage('danger', 'Vous avez un espace maximum de 30 caractères pour vous identifier');
                $this->redirect('chapter_show&id=' . Query::get('id'));
                return;
            } elseif (strlen(Request::get('comment')) > 500) {
                FlashBagService::addFlashMessage('danger', 'Votre commentaire est trop long, maximum 500 caractères');
                $this->redirect('chapter_show&id=' . Query::get('id'));
                return;
            } else {

                $Comment = filter_var(Request::get('comment'), FILTER_SANITIZE_STRING);
                $Pseudo = filter_var(Request::get('pseudo'), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

                $post = (new Comment())->setComment($Comment)->setPseudo($Pseudo)->setIdChapter(Query::get('id'));
                (new CommentsTable())->commentWrite($post);
                FlashBagService::addFlashMessage('info', 'Votre message est bien arrivé. Merci');
                $this->redirect('chapter_show&id=' . Query::get('id'));
                return;
            }
        }
        $post=(new PostsTable())->findPost(Query::get('id'));
        if(!$post){
            throw new NotFoundHttpException();
        }

        $this->render('posts/show.html.twig',
            [
                'chapitre' =>$post,
                'comments' => (new CommentsTable())->findCommentChapter([Query::get('id')])
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


        $this->render('admin/Office/officePublication.html.twig',
            [
                'publicationoffice' => (new PostsTable())->listPostWrite(10),
                'publicationclass' => (new PostsTable())->listPostAll(),
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
            $post = (new Posts())->setId(intval(Query::get('id')))->setText(Request::get('TextDashboard'))->setTitle(Request::get('TitleDashboard'))->setClassify(Request::get('is_status'))->setChapter(Request::get('ChapDashboard'));

            (new PostsTable())->PostUpdate($post);

            if ($position->getClassify() == '1') {
                FlashBagService::addFlashMessage('success', 'La publication est lisible sur votre site');
                $this->redirect('posts_admin&id= ' . (Request::get('postModify')));
                return;
            }
            FlashBagService::addFlashMessage('primary', 'La publication a été modifiée');
            $this->redirect('posts_admin&id= ' . (Request::get('postModify')));
            return;

        }

        $this->render('admin/Modification/textPostsModif.html.twig',
            [
                'chapitre' => (new PostsTable())->find(Query::get('id')),

            ]);
    }

    public function writeText()
    {
        if (Request::exist('TitleDashboard') && Request::exist('TextDashboard')) {
            $post = (new Posts())->setText(Request::get('TextDashboard'))->setTitle(Request::get('TitleDashboard'))->setClassify(Request::get('is_status'))->setChapter(Request::get('ChapDashboard'));

            if (Request::exist('postSave')) {
                (new PostsTable())->NewPostWrite($post);
                FlashBagService::addFlashMessage('warning', 'Votre texte a bien été enregistré');
                $this->redirect('publication_Office');
                return;
            }
        }
        $this->render('admin/NewWrite/officeWriteNewText.html.twig', []);
    }
}
