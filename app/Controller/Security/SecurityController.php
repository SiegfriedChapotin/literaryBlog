<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 25/12/2018
 * Time: 22:58
 */

namespace Literary\Controller\security;


use Literary\Controller\office\OfficeController;
use LiteraryCore\Request\Request;
use Literary\Model\table\Security\UserTable;


class SecurityController extends OfficeController

{

    public function sessionAuthor()
    {
        if (!empty($_SESSION['user'])) {
            $this->redirect('home');
        }

        $username = Request::get('username');
        $password = Request::get('password');
        $errors = [];



    if ($username && $password) {
        $user = (new UserTable())->login($username);


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

    $this->render('security/officeConnection.html.twig', ['errors' => $errors]);
}





    public function logout()
    {
        unset($_SESSION['user']);
        $this->redirect('home');
    }
}