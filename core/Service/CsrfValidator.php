<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 26/02/2019
 * Time: 19:27
 */

namespace LiteraryCore\Service;


abstract class CsrfValidator
{

    public static function generateToken(): string
    {
        //On enregistre notre token
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf']['token'] = $token;
        $_SESSION['csrf']['createdAt'] = new \DateTime();
        return $token;
    }

    public static function validateToken(string $token): bool
    {

        if (empty($_SESSION['csrf']) || empty($_SESSION['csrf']['token']) || (empty($_SESSION['csrf']['createdAt']))) {
            return false;
        }

        $now = new \DateTime();
        $csrfExp = $_SESSION['csrf']['createdAt']->modify('+10 minutes');

        if (($_SESSION['csrf']['token'] === $token) && ($csrfExp >= $now)) {
            return true;
        }
        return false;
    }

}