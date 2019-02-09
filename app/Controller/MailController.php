<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:16
 */

namespace Literary\Controller;

use Literary\Model\table\MailTable;
use LiteraryCore\Request\Request;
use Literary\Controller\office\OfficeController;
use LiteraryCore\Service\flashBag\FlashBagService;


class MailController extends OfficeController
{


    public function contact()
    {

        if (Request::exist('Envoyer')) {
            (new MailTable())->writeMail();
            FlashBagService::addFlashMessage('info', 'Votre message est bien arrivé. Merci');
            $this->redirect('contact');
            return;
        }

        $this->render('posts/contact.html.twig', [
            'contact' => (new MailTable())->writeMail()
        ]);
    }

    public function mailOffice()
    {
        if (Request::exist('delete')) {
            (new MailTable())->delete();
            FlashBagService::addFlashMessage('danger', 'Le courriel a été supprimé');
            $this->redirect('mail_Office');
            return;
        }

        if (Request::exist('classify')) {
            (new MailTable())->classify(1);
            FlashBagService::addFlashMessage('primary', 'Le courriel a été archivé');
            $this->redirect('mail_Office');
            return;

        }

        $this->render('posts/Author/office/officeMail.html.twig',
            [
                'mailoffice' => (new MailTable())->listMail(6),
                'mailclass' => (new MailTable())->listMailClass(6)
            ]);
    }

}
