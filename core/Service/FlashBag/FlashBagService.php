<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 30/01/2019
 * Time: 12:52
 */

namespace LiteraryCore\Service\FlashBag;


class FlashBagService
{
    public static function init()
    {
        if (empty($_SESSION['flash_bag'])) {
            $_SESSION['flash_bag'] = new FlashBag();
        }
    }

    public static function addFlashMessage($type, $message)
    {
        $_SESSION['flash_bag']->addFlashMessage($type, $message);
    }

    public static function getFlashMessages()
    {
        return $_SESSION['flash_bag']->getFlashMessages();
    }
}