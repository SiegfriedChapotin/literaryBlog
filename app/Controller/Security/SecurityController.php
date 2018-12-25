<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 25/12/2018
 * Time: 22:58
 */

namespace Literary\Controller\Security;

use LiteraryCore\Controller\AbstractController;
use LiteraryCore\Request\Request;
use Literary\Model\table\Security\UserTable;



class SecurityController extends AbstractController
{
    public function login() {
        if (!empty($_SESSION['user'])) {
            $this->redirect('home');
        }

        $email = Request::get('login');
        $password = Request::get('password');
        $errors = [];

        if ($email && $password) {
            $user = (new UserTable())->findByEmail();

            if ($user) {
                if ($user->getPassword() === $password) {
                    $_SESSION['user'] = $user;

                    $this->redirect('home');
                } else {
                    $errors[] = 'Couple email/mot de passe invalide';
                }
            } else {
                $errors[] = 'Email non trouvé';
            }
        }

        $this->render('posts/Author/connection.html.twig', ['errors' => $errors]);
    }

    public function logout() {
        unset($_SESSION['user']);
        $this->redirect('home');
    }
}