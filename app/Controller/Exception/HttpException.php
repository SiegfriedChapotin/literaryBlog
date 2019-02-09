<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 23/12/2018
 * Time: 20:24
 */

namespace Literary\Controller\exception;

use LiteraryCore\Controller\AbstractController;


class HttpException extends AbstractController
{
    public function notFound()
    {
        $this->render ('posts/Errors/404.html.twig',[]);
    }

    public function Forbidden()
    {
        $this->render ('posts/Errors/403.html.twig',[]);
    }

    public function internalServeurE()
    {
        $this->render ('posts/Errors/500.html.twig',[]);
    }
}