<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 30/01/2019
 * Time: 12:51
 */

namespace LiteraryCore\Service\flashBag;


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