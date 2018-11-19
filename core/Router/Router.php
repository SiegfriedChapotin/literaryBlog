<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 13:52
 */

namespace LiteraryCore\Router;

use LiteraryCore\Util\ArrayUtil;

class Router
{
    private $routes;

    public function __construct(RoutesInterface $routes)
    {
        $this->routes = $routes;
    }

    public function execController($p)
    {
        $routeInfos = ArrayUtil::get($this->routes->getRoutes(), $p);

        if ($routeInfos === null) {
            throw new \Exception('La route n\'existe pas'); //remplacer par une exception personnalisé 404
        }

        $controller = new $routeInfos['controller']();
        $controller->{$routeInfos['action']}();
    }
}