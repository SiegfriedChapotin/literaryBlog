<?php
namespace Literary\Config;


use Literary\Controller\CommentController;
use Literary\Controller\ShowingController;
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
            'showing_show' => ['controller' =>ShowingController::class, 'action' => 'show'],

            'contact'=>['controller'=>MailController::class, 'action'=>'writeMail'],

/*
 *  Partie administration
*/
            'admin' => ['controller' =>AuthorController::class,'action'=>'admin','secure'=>true],

            'mail_Office'=>['controller'=>MailController::class,'action'=>'mailOffice'],
            'comment_Office'=>['controller'=>CommentController::class,'action'=>'commentOffice'],

            'texthome_admin'=>['controller'=>AuthorController::class, 'action'=>'showTextHome'],
            'heading_admin' => ['controller' =>AuthorController::class, 'action' => 'showHeadingHome'],
            'showing_admin' => ['controller' =>AuthorController::class, 'action' => 'showShowingHome'],
            'posts_admin' => ['controller' =>AuthorController::class, 'action' => 'showPostsHome'],
            'writeText_admin' => ['controller' =>AuthorController::class, 'action' => 'writeText'],




            'http_exception_not_found' => ['controller' => HttpException::class, 'action' => 'notFound'],
            'ForbiddenHttpException'=> ['controller' => HttpException::class, 'action' => 'Forbidden'],
            'InternalServerErrorHttpException'=> ['controller' => HttpException::class, 'action' => 'internalServeurE'],


            'login' => ['controller' =>SecurityController::class,'action'=>'sessionAuthor'],


        ];
    }
}