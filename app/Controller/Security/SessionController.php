<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 12/02/2019
 * Time: 11:17
 */

namespace Literary\Controller\Security;

use Literary\Controller\BlogTrait;
use Literary\Controller\Security\AuthorController;
Use Literary\Model\Table\Security\AuthorTable;
use LiteraryCore\Request\Request;

class SessionController extends AuthorController
{

    use BlogTrait;

    public function sessionAuthor()
    {
        if (!empty($_SESSION['user'])) {
            $this->redirect('home');
        }

        $username = Request::get('username');
        $password = Request::get('password');
        $errors = [];


        if ($username && $password) {
            $user = (new AuthorTable())->login($username);


            if ($user) {
                if ($user->getPassword() === sha1($password)) {
                    $_SESSION['user'] = $user;

                    $this->redirect('admin');
                } else {
                    $errors[] = 'Couple email/mot de passe invalide';
                }
            } else {
                $errors[] = 'Nom d\'utilisateur non trouvé';
            }
        }

        $this->render('admin/Security/officeConnection.html.twig', []);
    }


}