<?php
define('ROOT', dirname(__DIR__));
require_once ROOT.'/vendor/autoload.php';

use \LiteraryCore\Router\Router;
use \LiteraryCore\Request\Query;
use \Literary\Config\Routes;
use \LiteraryCore\Request\Request;

$router = new Router(new Routes());

$router->execController(Query::get('p', 'home'));






