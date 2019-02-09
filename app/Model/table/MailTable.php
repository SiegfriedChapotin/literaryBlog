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
use Literary\Model\entity\Mail;

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



    function listMail($int)
    {
        return $this->query('SELECT * FROM '.$this->getTableName().' WHERE classify = 0 ORDER BY mail.date DESC LIMIT ' . $int);
    }

    function listMailClass($int)
    {
        return $this->query('SELECT * FROM  '.$this->getTableName().' WHERE classify = 1 ORDER BY mail.date DESC LIMIT ' . $int);
    }

    function writeMail()
    {
        if (Request::exist('NameMail') && Request::exist('TitreMail') && Request::exist('EmailMail') && Request::exist('TextMail')) {

                $post=(new Mail())->setName(Request::get('NameMail'))->setEmail(Request::get('EmailMail'))->setText(Request::get('TextMail'))->setTitle(Request::get('TitreMail'));
                $this->flush($post);

                return header('Location:index.php?p=contact');
        }

    }

    function deleteMail(int $id)
    {
        return $this->delete($id);
    }


}

