<?php

namespace LiteraryCore\Auth\DBAuth;


use Literary\App;
use LiteraryCore\Controller\AbstractController;
/**
* Gère l'authentification par extraction des Users de la DB
**/
class DBAuth extends AbstractController
{
    private  function getDb(){

        return App::getInstance()->getDb();
    }



	/**
	 * Permet au User de se connecter
	 * @param string $username
	 * @param string $password
	 * @return bool Selon si le User peut se connecter ou non
	 **/

	public function login(string $login, string $password) {
		$user = $this->getDb()->prepare('SELECT * FROM author WHERE username= ?', array($login), null, true);

		if ($user) {
			if ($user->password === sha1($password)) {
				$_SESSION['auth'] = $user;
                $this->redirect('admin');
			}else {
                $errors[] = 'Couple login/mot de passe invalide';
            }
        } else {
            $errors[] = 'login non trouvé';
        }

        $this->render('login.html.twig', ['errors' => $errors]);

	}

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