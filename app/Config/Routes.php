<?php
namespace Literary\Config;

use LiteraryCore\Router\RoutesInterface;
use Literary\Controller\Post;
use Literary\Controller\Texthome;
use Literary\Controller\Heading;
use Literary\Controller\Author\Admin;


class Routes implements RoutesInterface {
    public function getRoutes() : array {
        return [
            'home' => ['controller' => Texthome::class, 'action' => 'homepage'],

            'heading_show' => ['controller' =>Heading::class, 'action' => 'show'],

            'admin' => ['controller' =>Admin::class,'action'=>'admin'],
            'login' => ['controller' =>Admin::class,'action'=>'login'],

            'post_list' => ['controller' => Post::class, 'action' => 'list'],
            'post_show' => ['controller' => Post::class, 'action' => 'show'],
            'post_add' => ['controller' => Post::class, 'action' => 'add']
        ];
    }
}