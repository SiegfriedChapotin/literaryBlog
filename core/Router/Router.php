<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 13:52
 */

namespace LiteraryCore\Router;

use LiteraryCore\Exception\HttpException\ForbiddenHttpException;
use LiteraryCore\Exception\HttpException\NotFoundHttpException;
use LiteraryCore\Exception\HttpException\InternalServerErrorHttpException;
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
            throw new NotFoundHttpException();
        }

        if (!$routeInfos) {
            throw new InternalServerErrorHttpException();
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