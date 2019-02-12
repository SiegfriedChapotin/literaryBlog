<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 27/11/2018
 * Time: 16:23
 */

namespace Literary\Model\table;

use LiteraryCore\Table\AbstractTable;
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

    function writeMail($post)
    {
        $this->flush($post);
    }


}

