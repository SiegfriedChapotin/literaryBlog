<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 11/02/2019
 * Time: 21:15
 */

namespace LiteraryCore\Router;

use LiteraryCore\Exception\HttpException\ForbiddenHttpException;
use LiteraryCore\Exception\HttpException\NotFoundHttpException;
use LiteraryCore\Request\Util\ArrayUtil;

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
            throw new ForbiddenHttpException();
        }

        if (!$routeInfos) {
            throw new NotFoundHttpException();
        }

        if (ArrayUtil::get($routeInfos, 'secure')) {
            if (empty($_SESSION['user'])) {
                header('Location: index.php?p=login');
                die();
            }
        }
        $controller = new $routeInfos['controller']();
        $controller->{$routeInfos['action']}();

    }
}