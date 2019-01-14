<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:16
 */

namespace Literary\Controller;


use Literary\Model\table\CommentsTable;
use LiteraryCore\Controller\AbstractController;
use Literary\Model\table\PostsTable;
use Literary\Model\table\ShowingTable;



class PostController extends AbstractController
{


    public function list()
    {
        $this->render('posts/book.html.twig',
            [   'chapitreall' => (new PostsTable())->listPostAll(),
                'showings' => (new ShowingTable())->all()]);
    }

    public function show()
    {

        $this->render('posts/show.html.twig',
            [   'chapitre' => (new PostsTable())->findPost(),
                'comments' => (new CommentsTable())->findCommentChapter(),
                'commentwrite' => (new CommentsTable())->commentWrite(),
                'showings' => (new ShowingTable())->all(),
                'commentreport'=>(new CommentsTable())->report()


            ]);

    }

}
