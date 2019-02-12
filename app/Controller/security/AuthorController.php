<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 12/02/2019
 * Time: 11:00
 */

namespace Literary\Controller\security;



use LiteraryCore\Auth\DBAuth;


class AuthorController extends DBAuth

{

    public function logout()
    {
        unset($_SESSION['user']);
        $this->redirect('home');
    }


}