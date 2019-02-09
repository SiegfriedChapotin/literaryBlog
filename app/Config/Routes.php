<?php

namespace Literary\Config;


use Literary\Controller\CommentController;
use Literary\Controller\ShowingController;
use LiteraryCore\Router\RoutesInterface;
use Literary\Controller\exception\HttpException;
use Literary\Controller\PostController;
use Literary\Controller\MailController;
use Literary\Controller\HomeController;
use Literary\Controller\HeadingController;
use Literary\Controller\RgpdController;
use Literary\Controller\office\OfficeController;
use Literary\Controller\security\SecurityController;


class Routes implements RoutesInterface
{
    public function getRoutes(): array
    {
        return [

            /*
             *  Front part
            */

            'home' => ['controller' => HomeController::class, 'action' => 'homepage'],

            'post_list' => ['controller' => PostController::class, 'action' => 'list'],
            'post_show' => ['controller' => PostController::class, 'action' => 'show'],

            'rgpd_show' => ['controller' => RgpdController::class, 'action' => 'show'],
            'heading_show' => ['controller' => HeadingController::class, 'action' => 'show'],
            'showing_show' => ['controller' => ShowingController::class, 'action' => 'show'],

            'contact' => ['controller' => MailController::class, 'action' => 'contact'],

            /*
             *  Administration part
             */

            'admin' => ['controller' => OfficeController::class, 'action' => 'admin', 'secure' => true],

            'mail_Office' => ['controller' => MailController::class, 'action' => 'mailOffice'],
            'comment_Office' => ['controller' => CommentController::class, 'action' => 'commentOffice'],
            'publication_Office' => ['controller' => PostController::class, 'action' => 'publicationOffice'],

            'texthome_admin' => ['controller' => HomeController::class, 'action' => 'showTextHome'],
            'heading_admin' => ['controller' => HeadingController::class, 'action' => 'showHeadingHome'],
            'showing_admin' => ['controller' => ShowingController::class, 'action' => 'showShowingHome'],
            'posts_admin' => ['controller' => PostController::class, 'action' => 'showPostsHome'],
            'rgpd_admin' => ['controller' => RgpdController::class, 'action' => 'showRgpdHome'],

            'writetext_admin' => ['controller' => PostController::class, 'action' => 'writeText'],
            'writeprofil_admin' => ['controller' => ShowingController::class, 'action' => 'writeShowing'],


            /*
            *  Error part
            */

            'http_exception_not_found' => ['controller' => HttpException::class, 'action' => 'notFound'],
            'ForbiddenHttpException' => ['controller' => HttpException::class, 'action' => 'Forbidden'],
            'InternalServerErrorHttpException' => ['controller' => HttpException::class, 'action' => 'internalServeurE'],

            /*
            *  login part
            */

            'login' => ['controller' => SecurityController::class, 'action' => 'sessionAuthor'],


        ];
    }
}