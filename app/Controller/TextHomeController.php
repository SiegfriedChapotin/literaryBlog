<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:14
 */

namespace Literary\Controller;


use LiteraryCore\Controller\AbstractController;
use Literary\Model\table\TextHomeTable;
use Literary\Model\table\PostsTable;
use Literary\Model\table\HeadingTable;
use Literary\Model\table\CommentsTable;
Use Literary\Model\table\ShowingTable;


class TextHomeController extends AbstractController {



    public function homepage() {
        $this->render('posts/home.html.twig',[
            'chapitres'=>(new PostsTable())->listPost(),
            'comments'=>(new CommentsTable())->listComment(),
            'texthome'=>(new TextHomeTable())->all(),
            'headings'=>(new HeadingTable())->all(),
            'showings' => (new ShowingTable())->all()
        ]);
    }


}

