<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 30/01/2019
 * Time: 12:51
 */

namespace LiteraryCore\Service\FlashBag;


class FlashBag
{
    private $flashMessages = [];

    public function addFlashMessage($type, $message)
    {
        $this->flashMessages[$type][] = $message;
    }

    public function getFlashMessages()
    {
        $flashMessages = $this->flashMessages;
        $this->flashMessages = [];

        return $flashMessages;
    }
}