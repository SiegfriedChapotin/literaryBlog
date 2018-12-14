<?php
namespace Literary\Config;


use LiteraryCore\Router\RoutesInterface;
use Literary\Controller\Post;
use Literary\Controller\Texthome;
use Literary\Controller\Heading;
use Literary\Controller\Author\Admin;
use Literary\Controller\Security;
use Literary\Controller\Exception\HttpException;


class Routes implements RoutesInterface {
    public function getRoutes() : array {
        return [
            'home' => ['controller' => Texthome::class, 'action' => 'homepage'],

            'texthome'=>['controller'=>Admin::class, 'action'=>'showTextHome'],

            'heading_show' => ['controller' =>Heading::class, 'action' => 'show'],

            'heading_admin' => ['controller' =>Admin::class, 'action' => 'showHeadingHome'],
            'showing_admin' => ['controller' =>Admin::class, 'action' => 'showShowingHome'],
            'posts_admin' => ['controller' =>Admin::class, 'action' => 'showPostsHome'],
            'admin' => ['controller' =>Admin::class,'action'=>'admin'],
            //'secure'=>true


            'login' => ['controller' =>Security::class,'action'=>'login'],

            'post_list' => ['controller' => Post::class, 'action' => 'list'],
            'post_show' => ['controller' => Post::class, 'action' => 'show'],
            'post_add' => ['controller' => Post::class, 'action' => 'add'],

            'http_exception_not_found' => ['controller' => HttpException::class, 'action' => 'notFound']

        ];
    }
}