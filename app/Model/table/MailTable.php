<?php
/**
 * Created by PhpStorm.
 * User: siegf_000
 * Date: 27/11/2018
 * Time: 16:23
 */

namespace Literary\Model\table;

use LiteraryCore\Table\AbstractTable;

use LiteraryCore\Request\Query;
use LiteraryCore\Request\Request;

class MailTable extends AbstractTable
{


    protected function getTableName()
    {
        return 'mail';
    }

    protected function getClassName()
    {
        return Mail::class;
    }

    function findCommentChapter(){
        return $this->query('SELECT * FROM comment WHERE id_chapter = ? ORDER BY comment.date DESC ',[Query::get('id')] );
    }



    function writeMail()
    {
        if (Request::exist('NameMail') && Request::exist('EmailMail')&& Request::exist('TextMail')) {

            return $this->create(['name'=>Request::get('NameMail'), 'email'=>Request::get('EmailMail'),'text'=>Request::get('TextMail')]);
        }

    }
    function report(){
        return $this->query('SELECT * FROM comment WHERE is_reported = 1 ORDER BY comment.date DESC ');
    }
}