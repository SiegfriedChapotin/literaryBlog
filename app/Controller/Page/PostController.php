<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 14/11/2018
 * Time: 14:16
 */

namespace Literary\Controller\Page;

use Literary\Controller\BlogTrait;
use Literary\Model\Table\CommentsTable;
use LiteraryCore\Controller\AbstractController;
use Literary\Model\Table\PostsTable;
use LiteraryCore\Exception\HttpException\NotFoundHttpException;
use LiteraryCore\Exception\HttpException\InternalServerErrorHttpException;
use LiteraryCore\Request\Request;
use LiteraryCore\Request\Query;
use LiteraryCore\Service\FlashBag\FlashBagService;
use Literary\Model\Entity\Posts;
use Literary\Model\Entity\Comment;
use LiteraryCore\Service\CsrfValidator;
use LiteraryCore\Service\ReCaptChaValidator;

class PostController extends AbstractController
{
    use BlogTrait;


    public function list()
    {
        $this->render('Posts/book.html.twig', ['chapitreall' => (new PostsTable())->listPostAll()]);
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


            if ((ReCaptChaValidator::validateReCaptChat()) != true) {
                throw new InternalServerErrorHttpException();
            }

            if (!(CsrfValidator::validateToken(Request::get('csrf_token')))) {
                FlashBagService::addFlashMessage('danger', 'Session  expirée, reformuler votre demande ');
                $this->redirect('chapter_show&id=' . Query::get('id'));
                return;
            }
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
        $post = (new PostsTable())->findPost(Query::get('id'));
        if (!$post) {
            throw new NotFoundHttpException();
        }
        $token = CsrfValidator::generateToken();
        $this->render('Posts/show.html.twig',
            [
                'csrf_token' => $token,
                'chapitre' => $post,
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

        $this->render('Admin/Office/officePublication.html.twig',
            [
                'publicationoffice' => (new PostsTable())->listPostWrite(),
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

            if (!(CsrfValidator::validateToken(Request::get('csrf_token')))) {
                FlashBagService::addFlashMessage('danger', 'Session  expirée, reformuler votre demande ');
                $this->redirect('posts_admin&id= ' . (Request::get('postModify')));
                return;
            }

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

        $postModif = (new PostsTable())->findPost(Query::get('id'));
        if (!$postModif) {
            throw new NotFoundHttpException();
        }
        $token = CsrfValidator::generateToken();

        $this->render('Admin/Modification/textPostsModif.html.twig',
            [
                'chapitre' => $postModif,
                'csrf_token' => $token

            ]);

    }

    public function writeText()
    {
        if (Request::exist('TitleDashboard') && Request::exist('TextDashboard')) {
            $post = (new Posts())->setText(Request::get('TextDashboard'))->setTitle(Request::get('TitleDashboard'))->setClassify(Request::get('is_status'))->setChapter(Request::get('ChapDashboard'));

            if (!(CsrfValidator::validateToken(Request::get('csrf_token')))) {
                FlashBagService::addFlashMessage('danger', 'Session  expirée, reformuler votre demande ');
                $this->redirect('officeWriteNewText.html.twig');
                return;
            }
            if (Request::exist('postSave')) {
                (new PostsTable())->NewPostWrite($post);
                FlashBagService::addFlashMessage('warning', 'Votre texte a bien été enregistré');
                $this->redirect('publication_Office');
                return;
            }
            if (!$post) {
                throw new NotFoundHttpException();
            }
        }

        $token = CsrfValidator::generateToken();

        $this->render('Admin/NewWrite/officeWriteNewText.html.twig', ['csrf_token' => $token]);
    }
}
