<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 11/02/2019
 * Time: 21:28
 */

namespace Literary\Config;

use Literary\Controller\Office\OfficeAdminController;
use Literary\Controller\Security\SessionController;
use LiteraryCore\Router\RoutesInterface;
use Literary\Controller\Exception\HttpException;
use Literary\Controller\Security\AuthorController;
use Literary\Controller\Page\HomeController;
use Literary\Controller\Page\PostController;
use Literary\Controller\Page\MailController;
use Literary\Controller\Page\HeadingController;
use Literary\Controller\Page\RgpdController;
use Literary\Controller\Page\ShowingController;
use Literary\Controller\Page\CommentController;


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
            'logout' => ['controller' => AuthorController::class, 'action' => 'logout'],
            'admin' => ['controller' => OfficeAdminController::class, 'action' => 'admin', 'secure' => true],
            //

            'mail_Office' => ['controller' => MailController::class, 'action' => 'mailOffice', 'secure' => true],
            'comment_Office' => ['controller' => CommentController::class, 'action' => 'commentOffice', 'secure' => true],
            'publication_Office' => ['controller' => PostController::class, 'action' => 'publicationOffice', 'secure' => true],

            'texthome_admin' => ['controller' => HomeController::class, 'action' => 'showTextHome', 'secure' => true],
            'heading_admin' => ['controller' => HeadingController::class, 'action' => 'showHeadingHome', 'secure' => true],
            'showing_admin' => ['controller' => ShowingController::class, 'action' => 'showShowingHome', 'secure' => true],
            'posts_admin' => ['controller' => PostController::class, 'action' => 'showPostsHome', 'secure' => true],
            'rgpd_admin' => ['controller' => RgpdController::class, 'action' => 'showRgpdHome', 'secure' => true],

            'writetext_admin' => ['controller' => PostController::class, 'action' => 'writeText', 'secure' => true],
            'writeprofil_admin' => ['controller' => ShowingController::class, 'action' => 'writeShowing', 'secure' => true],

            /*
             * Exception part
             */

            'http_exception_not_found' => ['controller' => HttpException::class, 'action' => 'notFound'],
            'ForbiddenHttpException' => ['controller' => HttpException::class, 'action' => 'Forbidden'],
            'InternalServerErrorHttpException' => ['controller' => HttpException::class, 'action' => 'internalServeurE']

        ];


    }


}

