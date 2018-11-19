<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:14
 */

namespace Literary\Controller\Author;


use LiteraryCore\Controller\AbstractController;
use Literary\Model\Tablehome;
use Literary\Model\TablePosts;
use Literary\Model\TableHeading;
use Literary\Model\Author\TableAuthor;


class Admin extends AbstractController {

    public function admin() {

        $this->render('posts/Author/dashboard.html.twig',
            ['chapitres'=>TablePosts::chapitres(),
            'chapitresall'=>TablePosts::chapitresall(),
            'textHome'=>Tablehome::all(),
            'headings'=>Tableheading::headings(),
            'login'=>TableAuthor::login()]);
    }
    public function login() {

        $this->render('posts/Author/connection.html.twig',['login'=>TableAuthor::login()]);
    }



}

