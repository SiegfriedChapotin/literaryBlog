<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:16
 */
namespace Literary\Controller;

use Literary\Model\table\MailTable;
use Literary\Model\table\ShowingTable;
use LiteraryCore\Controller\AbstractController;
use Literary\Model\table\TextHomeTable;
use Literary\Model\table\PostsTable;
use Literary\Model\table\HeadingTable;
use Literary\Model\table\Author\AuthorTable;
use Literary\Model\table\CommentsTable;
use LiteraryCore\Request\Request;


class MailController extends AbstractController{


    public function writeMail() {
        $this->render ('posts/contact.html.twig', [
            'contact'=>(new MailTable())->writeMail(),
            'showings' => (new ShowingTable())->all()

        ]);
    }

    public function mailOffice() {
        if (Request::exist('maildel')) {

            (new MailTable())->deleteMail(Request::get('maildel'));
            $this->redirect('mail_Office');
            return;
        }


        $this->render('posts/Author/office/officeMail.html.twig',
            [
                'chapitres'=>(new PostsTable())->all(),
                'chapitresall'=>(new PostsTable())->all(),
                'texthome'=>(new TextHomeTable())->all(),
                'headings'=>(new HeadingTable())->all(),
                'showings'=>(new ShowingTable())->all(),

                'mail'=>(new MailTable())->listMail(6),
                'mailclass'=>(new MailTable())->listMailClass(6),
                'classify'=>(new MailTable())->classify(),




            ]);
    }
    /*
    public function show() {

        $this->render ('posts/show.html.twig',
            ['chapitre'=> (new PostsTable())->find($id=Query::get('id')),
             'comments'=>(new CommentsTable())->findCommentChapter(),
             'commentwrite'=>(new CommentsTable())->commentWrite(),

                ]);

    }
    public function list() {
        $this->render ('posts/book.html.twig',['chapitreall'=>(new PostsTable())->all()]);
    }
    */
}
