<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:14
 */

namespace Literary\Controller;


use LiteraryCore\Controller\AbstractController;
use Literary\Model\Tablehome;
use Literary\Model\TablePosts;
use Literary\Model\TableHeading;

class Heading extends AbstractController {


    public function show() {
        $this->render ('posts/showheading.html.twig',['heading'=>TableHeading::heading()]);
    }

}

