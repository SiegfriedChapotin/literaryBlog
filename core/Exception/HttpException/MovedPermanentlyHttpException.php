<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 21/11/2018
 * Time: 08:56
 */
namespace LiteraryCore\Exception\HttpException;

use Throwable;

class MovedPermanentlyHttpException extends HttpException
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct(301, $message, $code, $previous);
    }
}