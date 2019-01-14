<?php

namespace LiteraryCore\Controller;

use \Twig_Loader_Filesystem;
use \Twig_Environment;

abstract class AbstractController
{
    protected $twig;

    /**
     * AbstractController constructor.
     */
    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem('../app/Views');
        $this->twig = new Twig_Environment($loader, array('cache' => ROOT . '/tmp', 'debug' => true));
        $this->twig->addExtension(new \Twig_Extensions_Extension_Text());
        $this->__postConstruct();
    }

    protected function __postConstruct(){

    }

    public function redirect(string $route)
    {
        header('Location: index.php?p=' . $route);
        die();
    }

    /**
     * Appel la vue, lui applique les variables et l'envoie à l'application
     * @param String $nameView Nom de la vue à appeler
     * @param Array $variables Variables nécessaire dans la vue pour afficher les différents éléments récupérés dans les Models
     * @return type
     **/
    protected function render(String $nameView, array $variables = [])
    {
        echo $this->twig->render($nameView, $variables);
    }


}