<?php
define('ROOT', dirname(__DIR__));
require_once ROOT.'/vendor/autoload.php';


use \LiteraryCore\Request\Query;
use \LiteraryCore\Request\Request;
use \Literary\App;
use \LiteraryCore\Auth\DBAuth;


use \LiteraryCore\Router\Router;

use \Literary\Config\Routes;


$router = new Router(new Routes());

$login = Request::get('login');
$password = Request::get('password');

if ($login==='Forteroche' && $password==='forteroche') {

    $router->execController('admin');
}else{
    $router->execController('login');
}

