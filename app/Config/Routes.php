<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 11/02/2019
 * Time: 21:28
 */

namespace Literary\Config;

use Literary\Controller\office\OfficeAdminController;
use Literary\Controller\security\SessionController;
use LiteraryCore\Router\RoutesInterface;
use Literary\Controller\exception\HttpException;

use Literary\Controller\page\HomeController;
use Literary\Controller\page\PostController;
use Literary\Controller\page\MailController;
use Literary\Controller\page\HeadingController;
use Literary\Controller\page\RgpdController;
use Literary\Controller\page\ShowingController;
use Literary\Controller\page\CommentController;


class Routes implements RoutesInterface
{


    public function getRoutes(): array
    {

        return [
            'home' => ['controller' => HomeController::class, 'action' => 'homepage'],

            /*
             * Front part
             */

            'book' => ['controller' => PostController::class, 'action' => 'list'],
            'chapter_show' => ['controller' => PostController::class, 'action' => 'show'],
            'rgpd_show' => ['controller' => RgpdController::class, 'action' => 'show'],
            'heading_show' => ['controller' => HeadingController::class, 'action' => 'show'],
            'showing_show' => ['controller' => ShowingController::class, 'action' => 'show'],
            'contact' => ['controller' => MailController::class, 'action' => 'contact'],

            /*
            *  Administration part
            */

            'login' => ['controller' => SessionController::class, 'action' => 'sessionAuthor'],
            'admin' => ['controller' => OfficeAdminController::class, 'action' => 'admin', 'secure' => true],
            //

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


            'http_exception_not_found' => ['controller' => HttpException::class, 'action' => 'notFound'],
            'ForbiddenHttpException' => ['controller' => HttpException::class, 'action' => 'Forbidden'],
            'InternalServerErrorHttpException' => ['controller' => HttpException::class, 'action' => 'internalServeurE']

        ];


    }


}

