<?php
define('ROOT', dirname(__DIR__));
require_once ROOT . '/vendor/autoload.php';

use LiteraryCore\Exception\httpException\InternalServerErrorHttpException;
use LiteraryCore\Exception\httpException\HttpException;
use LiteraryCore\Exception\httpException\NotFoundHttpException;
Use LiteraryCore\Exception\httpException\ForbiddenHttpException;

use \LiteraryCore\Router\Router;
use \LiteraryCore\Request\Query;
use \Literary\Config\Routes;
use \Literary\App;


App::load();



$router = new Router(new Routes());

try {
    $router->execController(Query::get('p', 'home'));
}
catch (ForbiddenHttpException $e) {
    header('HTTP/2.1 ' . $e->getStatus());
    $router->execController('ForbiddenHttpException');

}
catch (NotFoundHttpException $e) {
    header('HTTP/2.1 ' . $e->getStatus());
    $router->execController('http_exception_not_found');
}
catch (InternalServerErrorHttpException $e) {
    header('HTTP/2.1 ' . $e->getStatus());
    $router->execController('http_exception_not_found');
}
catch (HttpException $e) {
    header('HTTP/2.1 ' . $e->getStatus());
    $router->execController('http_exception_not_found');
}
catch (\Exception $e) {
    //header('HTTP/2.1 ' . $e->getStatus());
   //$router->execController('http_exception_not_found');

    echo "catch exception";
    var_dump($e);

}







