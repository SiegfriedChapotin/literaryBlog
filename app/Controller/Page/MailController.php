<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 14/11/2018
 * Time: 14:16
 */

namespace Literary\Controller\Page;

use Literary\Controller\BlogTrait;
use Literary\Model\Table\MailTable;
use LiteraryCore\Request\Request;
use LiteraryCore\Controller\AbstractController;
use LiteraryCore\Service\CsrfValidator;
use LiteraryCore\Service\FlashBag\FlashBagService;
use Literary\Model\Entity\Mail;
use LiteraryCore\Exception\HttpException\InternalServerErrorHttpException;
use LiteraryCore\Service\ReCaptChaValidator;

class MailController extends AbstractController
{

    use BlogTrait;

    public function contact()
    {

        if (Request::exist('NameMail') && Request::exist('TitreMail') && Request::exist('EmailMail') && Request::exist('TextMail') && Request::exist('Envoyer')) {

            if ((ReCaptChaValidator::validateReCaptChat()) != true) {
                throw new InternalServerErrorHttpException();
            }

            if (!(CsrfValidator::validateToken(Request::get('csrf_token')))) {
                FlashBagService::addFlashMessage('danger', 'Session  expirée, reformuler votre demande ');
                $this->redirect('contact');
                return;
            }
            if ((filter_var(Request::get('EmailMail'), FILTER_VALIDATE_EMAIL)) === false) {
                FlashBagService::addFlashMessage('danger', 'Votre adresse mail n\'est pas bonne');
                $this->redirect('contact');
                return;
            } elseif (strlen(Request::get('NameMail')) > 30) {
                FlashBagService::addFlashMessage('danger', 'Vous avez un espace maximum 50 caractères pour vous identifier');
                $this->redirect('contact');
                return;
            } elseif (strlen(Request::get('TitreMail')) > 60) {
                FlashBagService::addFlashMessage('danger', 'Votre titre est trop long, maximum 100 caractères');
                $this->redirect('contact');
                return;
            } else {

                $TextMail = filter_var(Request::get('TextMail'), FILTER_SANITIZE_STRING);
                $TitreMail = filter_var(Request::get('TitreMail'), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
                $NameMail = filter_var(Request::get('NameMail'), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
                $EmailMail = (Request::get('EmailMail'));
                $post = (new Mail())->setName($NameMail)->setEmail($EmailMail)->setText($TextMail)->setTitle($TitreMail);

                (new MailTable())->writeMail($post);
                FlashBagService::addFlashMessage('info', 'Votre message est bien arrivé. Merci');
                $this->redirect('contact');
                return;

            }

        }
        $token = CsrfValidator::generateToken();

        $this->render('Posts/contact.html.twig', ['csrf_token' => $token]);
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

        $this->render('Admin/Office/officeMail.html.twig',
            [
                'mailoffice' => (new MailTable())->listMail(),
                'mailclass' => (new MailTable())->listMailClass()
            ]);
    }

}
