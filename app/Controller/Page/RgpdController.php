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
use LiteraryCore\Service\ReCaptChaValidator;

class RgpdController extends AbstractController
{

    use BlogTrait;

    public function show()
    {

        $this->render('posts/showRgpd.html.twig', ['rgpd' => (new RgpdTable())->all()]);
    }


    public function showRgpdHome()
    {
        if ((Request::exist('postModify'))&& (ReCaptChaValidator::validateReCaptChat())) {
            $post = (new Introduction())->setId(intval(Query::get('id')))->setText(Request::get('TextDashboard'))->setTitle(Request::get('TitleDashboard'));

            (new RgpdTable())->RgpdUpdate($post);
            FlashBagService::addFlashMessage('primary', 'La publication a été modifiée');
            $this->redirect('rgpd_admin&id=' . Query::get('id'));
            return;
        }
        $this->render('admin/Modification/textRgpdModif.html.twig',
            [
                'rgpd_admin' => (new RgpdTable())->RgpdHome(),
            ]);
    }

}

