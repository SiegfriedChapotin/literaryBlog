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
use Literary\Model\Table\RgpdTable;
use Literary\Model\Entity\Introduction;
use LiteraryCore\Request\Request;
use LiteraryCore\Request\Query;
use LiteraryCore\Service\FlashBag\FlashBagService;
use LiteraryCore\Exception\HttpException\NotFoundHttpException;
use LiteraryCore\Service\CsrfValidator;

class RgpdController extends AbstractController
{

    use BlogTrait;

    public function show()
    {

        $this->render('Posts/showRgpd.html.twig', ['rgpd' => (new RgpdTable())->all()]);
    }


    public function showRgpdHome()
    {
        if (Request::exist('postModify')) {

            if (!(CsrfValidator::validateToken(Request::get('csrf_token')))) {
                FlashBagService::addFlashMessage('danger', 'Session  expirée, reformuler votre demande ');
                $this->redirect('rgpd_admin&id=' . Query::get('id'));
                return;
            }

            $post = (new Introduction())->setId(intval(Query::get('id')))->setText(Request::get('TextDashboard'))->setTitle(Request::get('TitleDashboard'));

            (new RgpdTable())->RgpdUpdate($post);
            FlashBagService::addFlashMessage('primary', 'La publication a été modifiée');
            $this->redirect('rgpd_admin&id=' . Query::get('id'));
            return;
        }

        $rgpdHome = (new RgpdTable())->findRgpdHome(Query::get('id'));
        if (!$rgpdHome) {
            throw new NotFoundHttpException();
        }

        $token = CsrfValidator::generateToken();

        $this->render('Admin/Modification/textRgpdModif.html.twig',
            [
                'rgpd_admin' => $rgpdHome,
                'csrf_token' => $token
            ]);
    }

}

