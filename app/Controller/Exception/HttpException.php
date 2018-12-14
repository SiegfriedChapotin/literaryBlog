<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 21/11/2018
 * Time: 09:12
 */

namespace Literary\Controller\Exception;

use LiteraryCore\Controller\AbstractController;


class HttpException extends AbstractController
{
    public function notFound()
    {
        echo "not found";
    }
}