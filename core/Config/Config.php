<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 11/02/2019
 * Time: 19:16
 */

namespace LiteraryCore\Config;


/**
 * Configuration de l'application. Crée lors de l'initiation aux Singleton
 */
class Config
{
    private $settings = [];

    private static $_instance;

    /**
     * Constructeur qui lit le fichier config pour instancier la confid de l'application
     * @param string $files Chemin vers le fichier de config
     * @return none
     */
    protected function __construct(string $files)
    {
        $this->settings = require($files);
    }

    /**
     * Instancie l'objet une fois et le stocke dans lui-même pour permettre de n'avoir qu'une seule instance = singleton
     * @param string $files Chemin vers le fichier de config
     * @return object config Renvoie l'instance unique de config
     */
    public static function getInstance(string $files)
    {
        if (self::$_instance === null) {
            self::$_instance = new Config($files);
        }

        return self::$_instance;
    }

    /**
     * Retourne un élément de la config
     * @param string $key Nom du paramètre à récupérer
     * @return mixed Valeur du paramètre si la clé existe, sinon retourne null
     */
    public function get(string $key)
    {
        return (isset($this->settings[$key])) ? $this->settings[$key] : null;
    }

}