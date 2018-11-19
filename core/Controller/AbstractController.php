<?php

namespace LiteraryCore\Controller;

use \Twig_Loader_Filesystem;
use \Twig_Environment;

abstract class AbstractController
{
    /** @var String $viewPath Chemin par défaut des vues */
    protected $viewPath;

    /** @var String $layout Nom du layout à charger */
    protected $template;

    /**
     * Appel la vue, lui applique les variables et l'envoie à l'application
     *
     * @param String $nameView Nom de la vue à appeler
     * @param Array $variables Variables nécessaire dans la vue pour afficher les différents éléments récupérés dans les Models
     * @return type
     **/
    protected function render(String $nameView, array $variables = [])
    {
        ob_start();


        $loader = new Twig_Loader_Filesystem('../app/Views');
        $twig = new Twig_Environment($loader, array('cache' => ROOT.'/tmp','debug' => true ));
        $twig->addExtension(new \Twig_Extensions_Extension_Text());
        echo $twig->render($nameView, $variables);
    }




	/**
	 * Permet de renvoyer vers une page 404
	 * @param none
	 * @return none
	 */
	protected function error404() {
		header("HTTP/1.0 404 Not Found");
		header('Location: index.php');
	}

	/**
	 * Interdit l'accès à la page quand le User n'est pas Auth
	 * @param none
	 * @return none
	 */
	protected function forbidden() {
		header('HTTP/1.0 403 forbidden');
		die('Accès interdit');
	}
}