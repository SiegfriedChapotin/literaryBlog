<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:16
 */
namespace Literary\Controller;


use Literary\Model\CommentsTable;
use LiteraryCore\Controller\AbstractController;
use Literary\Model\PostsTable;
use LiteraryCore\Request\Query;
use Literary\Model\ShowingTable;
use LiteraryCore\Request\Request;




class Post extends AbstractController{




    public function list() {
        $this->render ('posts/book.html.twig',['chapitreall'=>(new PostsTable())->all()]);
    }

    public function show() {

        $this->render ('posts/show.html.twig',
            ['chapitre'=> (new PostsTable())->find($id=Query::get('id')),
             'comments'=>(new CommentsTable())->findCommentChapter(),
             'commentwrite'=>(new CommentsTable())->commentWrite(),
             'showings' => (new ShowingTable())->all()
                ]);

    }

}
