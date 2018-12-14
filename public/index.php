<?php
define('ROOT', dirname(__DIR__));
require_once ROOT.'/vendor/autoload.php';

use LiteraryCore\Exception\HttpException\InternalServerErrorHttpException;
use LiteraryCore\Exception\HttpException\HttpException;
use LiteraryCore\Exception\HttpException\NotFoundHttpException;
Use LiteraryCore\Exception\HttpException\MovedPermanentlyHttpException;
Use LiteraryCore\Exception\HttpException\FoundHttpException;
Use LiteraryCore\Exception\HttpException\ForbiddenHttpException;

use \LiteraryCore\Router\Router;
use \LiteraryCore\Request\Query;
use \Literary\Config\Routes;
use \Literary\App;


App::getInstance();

$router = new Router(new Routes());

try {
$router->execController(Query::get('p', 'home'));

}catch (MovedpermanentlyHttpException $e) {

    header('HTTP/2.1 ' . $e->getStatus());
}catch (FoundHttpException $e) {
   header('HTTP/2.1 ' . $e->getStatus());
}catch (ForbiddenHttpException $e) {
    header('HTTP/2.1 ' . $e->getStatus());
} catch (NotFoundHttpException $e) {
    $router->execController('http_exception_not_found');
    header('HTTP/2.1 ' . $e->getStatus());
}catch (InternalServerErrorHttpException $e) {
    header('HTTP/2.1 ' . $e->getStatus());
}catch (HttpException $e) {
    echo "catch http";
} catch (\Exception $e) {
    echo "catch exception";
    var_dump($e);
}






