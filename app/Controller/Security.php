<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 05/12/2018
 * Time: 08:35
 */

namespace Literary\Controller;
use Literary\App;
use LiteraryCore\Controller\AbstractController;
use LiteraryCore\Request\Request;
use Literary\Model\Author\AuthorTable;

class Security extends AbstractController
{


    private  function getDb(){

        return App::getInstance()->getDb();
    }

    public function login() {

        $this->render('posts/Author/connection.html.twig',['login'=>(new AuthorTable())->login(Request::get('pseudo', Request::get('password')))]);

    }
    /**
     * Permet au User de se connecter
     * @param string $username
     * @param string $password
     * @return bool Selon si le User peut se connecter ou non

    public function login() {
        if (!empty($_SESSION['user'])) {
            $this->redirect('home');
        }

        $login = Request::get('login');
        $password = Request::get('password');
        $errors = [];

        if ($login && $password) {
            $user = (new UserRepository())->findByEmail($login);

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

        $this->render('connection.html.twig', ['errors' => $errors]);
    }
**/
    /**
     * Retourne l'ID de l'utilisateur s'il est connecté
     * @return string ID de l'utilisateur
     **/
    public function getUserId()
    {
        if($this->logged()) {
            return $_SESSION['auth'];
        } else {
            return false;
        }
    }

    /**
     * Vérifie dans le $_SESSION si l'utilisateur est déjà connecté
     * @return bool
     **/
    public function logged() {
        return isset($_SESSION['auth']);
    }

    /**
     * Déconnecte le User
     **/
    public function disconnect()
    {
        unset($_SESSION['auth']);
        $this->redirect('home');
    }
}