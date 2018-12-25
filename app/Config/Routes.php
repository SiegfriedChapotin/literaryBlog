<?php
namespace Literary\Config;


use LiteraryCore\Router\RoutesInterface;
use Literary\Controller\Exception\HttpException;
use Literary\Controller\PostController;
use Literary\Controller\MailController;
use Literary\Controller\TextHomeController;
use Literary\Controller\HeadingController;
use Literary\Controller\Author\AuthorController;
use Literary\Controller\Security\SecurityController;



class Routes implements RoutesInterface {
    public function getRoutes() : array {
        return [
            'home' => ['controller' => TextHomeController::class, 'action' => 'homepage'],

            'post_list' => ['controller' => PostController::class, 'action' => 'list'],
            'post_show' => ['controller' => PostController::class, 'action' => 'show'],
            'post_add' => ['controller' => PostController::class, 'action' => 'add'],

            'heading_show' => ['controller' =>HeadingController::class, 'action' => 'show'],

            'contact'=>['controller'=>MailController::class, 'action'=>'writeMail'],

            'texthome'=>['controller'=>AuthorController::class, 'action'=>'showTextHome'],
            'heading_admin' => ['controller' =>AuthorController::class, 'action' => 'showHeadingHome'],
            'showing_admin' => ['controller' =>AuthorController::class, 'action' => 'showShowingHome'],
            'posts_admin' => ['controller' =>AuthorController::class, 'action' => 'showPostsHome'],
            'writeText_admin' => ['controller' =>AuthorController::class, 'action' => 'writeText'],
            'admin' => ['controller' =>AuthorController::class,'action'=>'admin','secure'=>true],
            //


            'http_exception_not_found' => ['controller' => HttpException::class, 'action' => 'notFound'],
            'ForbiddenHttpException'=> ['controller' => HttpException::class, 'action' => 'Forbidden'],
            'InternalServerErrorHttpException'=> ['controller' => HttpException::class, 'action' => 'internalServeurE'],


            'login' => ['controller' =>SecurityController::class,'action'=>'login'],


        ];
    }
}