<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 27/11/2018
 * Time: 16:27
 */

namespace Literary\Controller;

use LiteraryCore\Controller\AbstractController;
use Literary\Model\table\CommentsTable;
use Literary\Model\table\MailTable;
use Literary\Model\table\ShowingTable;
use Literary\Model\table\TextHomeTable;
use Literary\Model\table\PostsTable;
use Literary\Model\table\HeadingTable;
use LiteraryCore\Request\Query;
use LiteraryCore\Request\Request;


class CommentController extends AbstractController
{

    public function list()
    {
        $this->render('posts/show.html.twig', ['commentall' => CommentsTable::commentall()]);
    }

    public function show()
    {

        $this->render('posts/show.html.twig', ['comment' => (new CommentsTable())->find(Query::get('id'))]);

    }

    public function commentOffice()
    {
        if (Request::exist('commentdel')) {

            (new CommentsTable())->deleteComment(Request::get('commentdel'));
            $this->redirect('comment_Office');
            return;
        }

        if (Request::exist('commentreport')) {
            (new CommentsTable())->restaureComment(Request::get('commentreport'));
            $this->redirect('comment_Office');
            return;
        }


        $this->render('posts/Author/office/officeComment.html.twig',
            [
                'chapitres' => (new PostsTable())->all(),
                'chapitresall' => (new PostsTable())->all(),
                'texthome' => (new TextHomeTable())->all(),
                'headings' => (new HeadingTable())->all(),
                'showings' => (new ShowingTable())->all(),
                'commentoffice' => (new CommentsTable())->listComment(10),
                'commentreport' => (new CommentsTable())->listReport(10)


            ]);
    }

}