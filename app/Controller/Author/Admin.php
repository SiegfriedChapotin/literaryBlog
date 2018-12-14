<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:14
 */

namespace Literary\Controller\Author;


use Literary\Model\ShowingTable;
use LiteraryCore\Controller\AbstractController;
use Literary\Model\TextHomeTable;
use Literary\Model\PostsTable;
use Literary\Model\HeadingTable;
use Literary\Model\Author\AuthorTable;
use LiteraryCore\Request\Query;


class Admin extends AbstractController {

    public function admin() {

        if(!empty($_SESSION['user'])) {
            $this->redirect('home');
        }

        $this->render('posts/Author/dashboard.html.twig',
            ['chapitres'=>(new PostsTable())->all(),
            'chapitresall'=>(new PostsTable())->all(),
            'texthome'=>(new TextHomeTable())->all(),
            'headings'=>(new HeadingTable())->all(),
            'showings'=>(new ShowingTable())->all(),
            'login'=>(new AuthorTable())->all(),
            'newpost'=>(new PostsTable())->NewPostWrite()
        ]);
    }

    public function showTextHome(){
        $this->render ('posts/Author/modification/textHomeModif.html.twig',[
            'texthome'=>(new TextHomeTable())->all(),
          
            'chapitresall'=>(new PostsTable())->all(),
            'showings'=>(new ShowingTable())->all(),
            'headings'=>(new HeadingTable())->all(),

        ]);

    }

    public function showHeadingHome()
    {
        $this->render('posts/Author/modification/textHeadingModif.html.twig', [
            'heading_admin' => (new HeadingTable())->find($id = Query::get('id')),
            'texthome' => (new TextHomeTable())->all(),
            'chapitres' => (new PostsTable())->all(),
            'showings' => (new ShowingTable())->all(),
            'chapitresall' => (new PostsTable())->all(),
            'headings' => (new HeadingTable())->all()

        ]);
    }

    public function showShowingHome(){
        $this->render ('posts/Author/modification/textShowingModif.html.twig',[
            'showing_admin'=>(new ShowingTable())->find($id=Query::get('id')),
            'texthome'=>(new TextHomeTable())->all(),
            'chapitres'=>(new PostsTable())->all(),
            'showings'=>(new ShowingTable())->all(),
            'chapitresall'=>(new PostsTable())->all(),
            'headings'=>(new HeadingTable())->all()
        ]);

    }
    public function showPostsHome(){
        $this->render ('posts/Author/modification/textPostsModif.html.twig',[
            'posts_admin'=>(new PostsTable())->find($id=Query::get('id')),
            'texthome'=>(new TextHomeTable())->all(),
            'chapitres'=>(new PostsTable())->all(),
            'showings'=>(new ShowingTable())->all(),
            'chapitresall'=>(new PostsTable())->all(),
            'headings'=>(new HeadingTable())->all(),
            'modif'=>(new PostsTable())->ModifPostWrite()

        ]);

    }

    public function login() {

        $this->render('posts/Author/connection.html.twig',['login'=>AuthorTable::login()]);
    }



}

