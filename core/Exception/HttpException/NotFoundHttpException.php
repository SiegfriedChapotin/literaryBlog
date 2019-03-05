<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 21/11/2018
 * Time: 08:56
 */
namespace LiteraryCore\Exception\HttpException;

use Throwable;


class NotFoundHttpException extends HttpException
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct(404, $message, $code, $previous);
    }
}