<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:14
 */

namespace Literary\Controller;


use Literary\Controller\office\OfficeController;
use Literary\Model\table\ShowingTable;
use LiteraryCore\Service\flashBag\FlashBagService;
use LiteraryCore\Request\Query;
use LiteraryCore\Request\Request;
use Literary\Model\entity\Showing;

class ShowingController extends OfficeController
{


    public function show()
    {
        $this->render('posts/showShowing.html.twig', ['showing' => (new ShowingTable())->findShowing()]);
    }


    public function writeShow()
    {
        $this->render('posts/Author/office/officeWriteNewShowing.html.twig', ['newpost' => (new ShowingTable())->NewShowingWrite()]);
    }

    public function writeShowing()
    {
        if (Request::exist('postSave')) {
            (new ShowingTable())->NewShowingWrite();
            FlashBagService::addFlashMessage('warning', 'Votre texte a bien été enregistré');
            $this->redirect('publication_Office');
            return;
        }

        $this->render('posts/Author/office/officeWriteNewShowing.html.twig',
            [
                'writeText' => (new ShowingTable())->NewShowingWrite(),
            ]);
    }

    public function showShowingHome()
    {
        if (Request::exist('delete')) {
            (new ShowingTable())->delete();
            FlashBagService::addFlashMessage('danger', 'La publication a été supprimée');
            $this->redirect('publication_Office');
            return;
        }

        if (Request::exist('postModify')) {
            $position = (new Showing())->setClassify(Request::get('is_status'));
            (new ShowingTable())->ShowingUpdate();

            if ($position->getClassify() == '1') {
                FlashBagService::addFlashMessage('success', 'La publication est lisible sur votre site');
                $this->redirect('showing_admin&id= ' . (Request::get('postModify')));
                return;
            }

            FlashBagService::addFlashMessage('primary', 'La publication a été modifiée');
            $this->redirect('showing_admin&id= ' . (Request::get('postModify')));
            return;
        }
        $this->render('posts/Author/modification/textShowingModif.html.twig', ['showing_admin' => (new ShowingTable())->find(Query::get('id'))]);
    }
}


