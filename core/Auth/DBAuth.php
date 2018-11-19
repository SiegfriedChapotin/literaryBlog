<?php

namespace LiteraryCore\Auth\DBAuth;

use LiteraryCore\Database;

/**
* Gère l'authentification par extraction des Users de la DB
**/
class DBAuth
{
	/** @var Object \PDO $db Connection à la DB **/
	protected $db;

	/**
	 * Initialise la connexion à la DB (injection de dépendance)
	 * @param Object \Core\Databse
	 **/
	public function __construct(Database $db) {
		$this->db = $db;
	}

	/**
	 * Permet au User de se connecter
	 * @param string $username
	 * @param string $password
	 * @return bool Selon si le User peut se connecter ou non
	 **/
	public function login(string $login, string $password) {
		$user = $this->db->prepare('SELECT * FROM author WHERE username= ?', array($login), null, true);

		if ($user) {
			if ($user->password === sha1($password)) {
				$_SESSION['auth'] = $user->id;
				return true;
			}
		}

		return false;

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
		if ($this->logged()) {
			unset($_SESSION['auth']);
		}
	}
}