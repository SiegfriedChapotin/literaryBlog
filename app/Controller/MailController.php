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
use Literary\Model\table\MailTable;
use LiteraryCore\Request\Query;
use Literary\Model\table\ShowingTable;
use LiteraryCore\Request\Request;




class MailController extends AbstractController{


    public function writeMail() {
        $this->render ('posts/contact.html.twig',['contact'=>(new MailTable())->writeMail()]);
    }
    /*
    public function show() {

        $this->render ('posts/show.html.twig',
            ['chapitre'=> (new PostsTable())->find($id=Query::get('id')),
             'comments'=>(new CommentsTable())->findCommentChapter(),
             'commentwrite'=>(new CommentsTable())->commentWrite(),
             'showings' => (new ShowingTable())->all()
                ]);

    }
    public function list() {
        $this->render ('posts/book.html.twig',['chapitreall'=>(new PostsTable())->all()]);
    }
    */
}
