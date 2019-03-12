<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 05/03/2019
 * Time: 09:16
 */

namespace LiteraryCore\Service;

use ReCaptcha\ReCaptcha;


abstract class ReCaptChaValidator
{

    public static function validateReCaptChat(): bool
    {

        $secret = '6Lf3TpUUAAAAAMYf4RN61p9k0XB97s_ro-aIxC_N';
        $recaptcha = new ReCaptcha($secret);
        $recaptcha_response = $_POST['recaptcha'];

        $resp = $recaptcha->verify($recaptcha_response);

        return $resp->isSuccess();
    }
}
