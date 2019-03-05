<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 23/12/2018
 * Time: 20:24
 */

namespace Literary\Controller\Exception;

use LiteraryCore\Controller\AbstractController;


class HttpException extends AbstractController
{
    public function notFound()
    {
        $this->render ('errors/404.html.twig',[]);
    }

    public function Forbidden()
    {
        $this->render ('errors/403.html.twig',[]);
    }

    public function internalServeurE()
    {
        $this->render ('errors/500.html.twig',[]);
    }
}