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
use LiteraryCore\Service\ReCaptChaValidator;
use LiteraryCore\Exception\HttpException\ForbiddenHttpException;

class ShowingController extends AbstractController
{
    use BlogTrait;

    public function show()
    {
        $showing = (new ShowingTable())->findShowing(Query::get('id'));
        if (!$showing) {
            throw new NotFoundHttpException();
        }

        $this->render('posts/showShowing.html.twig',
            [
                'showing' => $showing
            ]);
    }


    public function writeShowing()
    {

        if (Request::exist('TitleDashboard') && Request::exist('TextDashboard')) {
            $post = (new Showing())->setText(Request::get('TextDashboard'))->setTitle(Request::get('TitleDashboard'))->setClassify(Request::get('is_status'));


            if ((Request::exist('postSave')) && (ReCaptChaValidator::validateReCaptChat())) {

                (new ShowingTable())->NewShowingWrite($post);
                FlashBagService::addFlashMessage('warning', 'Votre texte a bien été enregistré');
                $this->redirect('publication_Office');
                return;
            }

        }
        $this->render('admin/NewWrite/officeWriteNewShowing.html.twig', []);
    }

    public
    function showShowingHome()
    {
        if ((Request::exist('delete')) && (ReCaptChaValidator::validateReCaptChat())) {

            (new ShowingTable())->delete();
            FlashBagService::addFlashMessage('danger', 'La publication a été supprimée');
            $this->redirect('publication_Office');
            return;
        }

        if ((Request::exist('postModify')) && (ReCaptChaValidator::validateReCaptChat())) {

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

        $this->render('admin/Modification/textShowingModif.html.twig',
            [
                'showing' => $showing
            ]);


    }


}


