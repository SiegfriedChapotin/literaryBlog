<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 14/11/2018
 * Time: 14:14
 */

namespace Literary\Controller\Author;


use Literary\Model\table\MailTable;
use Literary\Model\table\ShowingTable;
use LiteraryCore\Controller\AbstractController;
use Literary\Model\table\TextHomeTable;
use Literary\Model\table\PostsTable;
use Literary\Model\table\HeadingTable;
use Literary\Model\table\Author\AuthorTable;
use LiteraryCore\Request\Query;
use Literary\Model\table\CommentsTable;


class AuthorController extends AbstractController
{

    public function __postConstruct()
    {
        $this->twig->addGlobal('chapitresall', (new PostsTable())->all());
        $this->twig->addGlobal('texthome', (new TextHomeTable())->all());
        $this->twig->addGlobal('headings', (new HeadingTable())->all());
        $this->twig->addGlobal('showings', (new ShowingTable())->all());
    }

    public function admin()
    {

        $this->render('posts/Author/dashboard.html.twig',
            [
                'chapitres' => (new PostsTable())->listPostWrite('6'),
                'comment' => (new CommentsTable())->listComment(6),
                'mail' => (new MailTable())->listMail(6),
                'commentreport' => (new CommentsTable())->listreport(6)
            ]);
    }

    public function writeText()
    {
        $this->render('posts/Author/office/officewriteText.html.twig',
            [
                'newpost' => (new PostsTable())->NewPostWrite(),

            ]);
    }

    public function showTextHome()
    {
        $this->render('posts/Author/modification/textHomeModif.html.twig',
            [
                'texthome' => (new TextHomeTable())->all(),
            ]);

    }

    public function showHeadingHome()
    {
        $this->render('posts/Author/modification/textHeadingModif.html.twig',
            [
                'heading_admin' => (new HeadingTable())->find(Query::get('id')),
            ]);
    }

    public function showShowingHome()
    {
        $this->render('posts/Author/modification/textShowingModif.html.twig',
            [
                'showing_admin' => (new ShowingTable())->find($id = Query::get('id')),
            ]);

    }

    public function showPostsHome()
    {
        (new PostsTable())->modifPostWrite();

        $this->render('posts/Author/modification/textPostsModif.html.twig',
            [
                'posts_admin' => (new PostsTable())->find(Query::get('id')),
            ]);

    }

    public function login()
    {
        $this->render('posts/Author/officeConnection.html.twig', ['login' => AuthorTable::login()]);
    }


}

