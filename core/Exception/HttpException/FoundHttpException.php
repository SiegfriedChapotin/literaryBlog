<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 21/11/2018
 * Time: 08:56
 */
namespace LiteraryCore\Exception\HttpException;

use Throwable;

class FoundHttpException extends HttpException
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct(302, $message, $code, $previous);
    }
}