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
use Literary\Model\Entity\Introduction;
use Literary\Model\Table\HeadingTable;
use LiteraryCore\Request\Query;
use LiteraryCore\Request\Request;
use LiteraryCore\Service\FlashBag\FlashBagService;
use LiteraryCore\Exception\HttpException\NotFoundHttpException;
use LiteraryCore\Service\CsrfValidator;

class HeadingController extends AbstractController
{

    use BlogTrait;

    public function show()
    {
        $heading = (new HeadingTable())->findShowing(Query::get('id'));
        if (!$heading) {
            throw new NotFoundHttpException();
        }

        $this->render('Posts/showheading.html.twig',
            [
                'heading' => $heading
            ]);
    }


    public function showHeadingHome()
    {
        if ((Request::exist('postModify'))) {

            if (!(CsrfValidator::validateToken(Request::get('csrf_token')))) {
                FlashBagService::addFlashMessage('danger', 'Session  expirée, reformuler votre demande ');
                $this->redirect('heading_admin&id=' . Query::get('id'));
                return;
            }

            $post = (new Introduction())->setId(intval(Query::get('id')))->setText(Request::get('TextDashboard'))->setTitle(Request::get('TitleDashboard'));

            (new HeadingTable())->HeadingUpdate($post);
            FlashBagService::addFlashMessage('primary', 'La publication a été modifiée');
            $this->redirect('heading_admin&id=' . Query::get('id'));
            return;
        }

        $heading = (new HeadingTable())->findShowing(Query::get('id'));
        if (!$heading) {
            throw new NotFoundHttpException();
        }

        $token = CsrfValidator::generateToken();

        $this->render('Admin/Modification/textHeadingModif.html.twig',
            [
                'heading' => $heading,
                'csrf_token' => $token
            ]);
    }
}


