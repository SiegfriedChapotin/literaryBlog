<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 14/11/2018
 * Time: 14:16
 */

namespace Literary\Controller\page;

use Literary\Controller\BlogController;
use Literary\Model\table\MailTable;
use LiteraryCore\Request\Request;
use LiteraryCore\Controller\AbstractController;
use LiteraryCore\Service\flashBag\FlashBagService;
use Literary\Model\entity\Mail;


class MailController extends AbstractController
{

    use BlogController;

    public function contact()
    {
        if (Request::exist('NameMail') && Request::exist('TitreMail') && Request::exist('EmailMail') && Request::exist('TextMail')) {

            $post = (new Mail())->setName(Request::get('NameMail'))->setEmail(Request::get('EmailMail'))->setText(Request::get('TextMail'))->setTitle(Request::get('TitreMail'));

            if (Request::exist('Envoyer')) {
                (new MailTable())->writeMail($post);
                FlashBagService::addFlashMessage('info', 'Votre message est bien arrivé. Merci');
                $this->redirect('contact');
                return;
            }
        }

        $this->render('posts/contact.html.twig', []);
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

        $this->render('admin/Office/officeMail.html.twig',
            [
                'mailoffice' => (new MailTable())->listMail(6),
                'mailclass' => (new MailTable())->listMailClass(6)
            ]);
    }

}
