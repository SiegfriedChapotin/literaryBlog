<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 14/11/2018
 * Time: 14:14
 */

namespace Literary\Controller\page;

use Literary\Controller\BlogTrait;
use LiteraryCore\Controller\AbstractController;
use Literary\Model\entity\Introduction;
use Literary\Model\table\HeadingTable;
use LiteraryCore\Request\Query;
use LiteraryCore\Request\Request;
use LiteraryCore\Service\flashBag\FlashBagService;
use LiteraryCore\Exception\httpException\NotFoundHttpException;

class HeadingController extends AbstractController
{

    use BlogTrait;

    public function show()
    {
        $heading=(new HeadingTable())->findShowing(Query::get('id'));
        if(!$heading){
            throw new NotFoundHttpException();
        }

        $this->render('posts/showheading.html.twig',
            [
                'heading' =>$heading
            ]);
    }


    public function showHeadingHome()
    {
        if (Request::exist('postModify')) {
            $post = (new Introduction())->setId(intval(Query::get('id')))->setText(Request::get('TextDashboard'))->setTitle(Request::get('TitleDashboard'));

            (new HeadingTable())->HeadingUpdate($post);
            FlashBagService::addFlashMessage('primary', 'La publication a été modifiée');
            $this->redirect('heading_admin&id=' . Query::get('id'));
            return;
        }

        $heading=(new HeadingTable())->findShowing(Query::get('id'));
        if(!$heading){
            throw new NotFoundHttpException();
        }

        $this->render('admin/Modification/textHeadingModif.html.twig',
            [
                'heading' =>$heading
            ]);
           }
}


