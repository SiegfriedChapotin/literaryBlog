<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 14/11/2018
 * Time: 14:14
 */

namespace Literary\Controller\Page;

use Literary\Controller\BlogTrait;
use LiteraryCore\Controller\AbstractController;
use Literary\Model\Table\ShowingTable;
use LiteraryCore\Service\FlashBag\FlashBagService;
use LiteraryCore\Request\Query;
use LiteraryCore\Request\Request;
use Literary\Model\Entity\Showing;
use LiteraryCore\Exception\HttpException\NotFoundHttpException;
use LiteraryCore\Service\CsrfValidator;

class ShowingController extends AbstractController
{
    use BlogTrait;

    public function show()
    {
        $showing = (new ShowingTable())->findShowing(Query::get('id'));
        if (!$showing) {
            throw new NotFoundHttpException();
        }

        $this->render('Posts/showShowing.html.twig',
            [
                'showing' => $showing
            ]);
    }


    public function writeShowing()
    {

        if (Request::exist('TitleDashboard') && Request::exist('TextDashboard')) {

            $post = (new Showing())->setText(Request::get('TextDashboard'))->setTitle(Request::get('TitleDashboard'))->setClassify(Request::get('is_status'));

            if (!(CsrfValidator::validateToken(Request::get('csrf_token')))) {
                FlashBagService::addFlashMessage('danger', 'Session  expirée, reformuler votre demande ');
                $this->redirect('writeprofil_admin');
                return;
            }

            if (Request::exist('postSave')) {

                (new ShowingTable())->NewShowingWrite($post);
                FlashBagService::addFlashMessage('warning', 'Votre texte a bien été enregistré');
                $this->redirect('publication_Office');
                return;
            }

        }
        $token = CsrfValidator::generateToken();

        $this->render('Admin/NewWrite/officeWriteNewShowing.html.twig', ['csrf_token' => $token]);
    }

    public
    function showShowingHome()
    {
        if (Request::exist('delete')) {
            (new ShowingTable())->delete();
            FlashBagService::addFlashMessage('danger', 'La publication a été supprimée');
            $this->redirect('publication_Office');
            return;
        }

        if (Request::exist('postModify')) {

            if (!(CsrfValidator::validateToken(Request::get('csrf_token')))) {
                FlashBagService::addFlashMessage('danger', 'Session  expirée, reformuler votre demande ');
                $this->redirect('showing_admin&id= ' . (Request::get('postModify')));
                return;
            }

            $position = (new Showing())->setClassify(Request::get('is_status'));
            $post = (new Showing())->setId(intval(Query::get('id')))->setText(Request::get('TextDashboard'))->setTitle(Request::get('TitleDashboard'))->setClassify(Request::get('is_status'));

            (new ShowingTable())->ShowingUpdate($post);

            if ($position->getClassify() == '1') {
                FlashBagService::addFlashMessage('success', 'La publication est lisible sur votre site');
                $this->redirect('showing_admin&id= ' . (Request::get('postModify')));
                return;
            }

            FlashBagService::addFlashMessage('primary', 'La publication a été modifiée');
            $this->redirect('showing_admin&id= ' . (Request::get('postModify')));
            return;
        }

        $showing = (new ShowingTable())->findShowing(Query::get('id'));
        if (!$showing) {
            throw new NotFoundHttpException();
        }

        $token = CsrfValidator::generateToken();
        $this->render('Admin/Modification/textShowingModif.html.twig',
            [
                'csrf_token' => $token,
                'showing' => $showing
            ]);


    }


}


