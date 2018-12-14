<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 21/11/2018
 * Time: 08:56
 */
namespace LiteraryCore\Exception\HttpException;

use Throwable;

abstract class HttpException extends \Exception
{
    private $status;

    public function __construct(int $status, string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->status = $status;
    }

    public function getStatus(): int
    {
        return $this->status;
    }
}