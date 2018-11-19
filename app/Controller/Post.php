<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:16
 */
namespace Literary\Controller;


use LiteraryCore\Controller\AbstractController;
use Literary\Model\TablePosts;




class Post extends AbstractController{
    public function list() {
        $this->render ('posts/show.html.twig',['chapitreall'=>TablePosts::chapitreall()]);
    }

    public function show() {
        $this->render ('posts/show.html.twig',['chapitre'=>TablePosts::chapitre()]);
    }

    public function add() {
        echo "add";
    }
}
