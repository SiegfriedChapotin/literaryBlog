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
use LiteraryCore\Table\Table;

class Texthome extends AbstractController {


    public function homepage() {
        $this->render('posts/home.html.twig',['chapitres'=>TablePosts::chapitres(),'textHome'=>Tablehome::all(),'headings'=>TableHeading::headings()]);
    }


}

