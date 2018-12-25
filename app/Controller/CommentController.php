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
use LiteraryCore\Request\Query;


class CommentController extends AbstractController{

    public function list() {
        $this->render ('posts/show.html.twig',['commentall'=>CommentsTable::commentall()]);
    }

    public function show() {

        $this->render ('posts/show.html.twig',['comment'=> (new CommentsTable())->find($id=Query::get('id'))]);

    }


}