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
        $this->render('Errors/404.html.twig', []);
    }

    public function forbidden()
    {
        $this->render('Errors/403.html.twig', []);
    }

    public function internalServeurE()
    {
        $this->render('Errors/500.html.twig', []);
    }
}