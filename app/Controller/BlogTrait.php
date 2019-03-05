<?php
/**
 * Created by PhpStorm.
 * Author: siegf_000
 * Date: 11/02/2019
 * Time: 22:20
 */

namespace Literary\Controller;


use Literary\Model\Table\PostsTable;
use Literary\Model\Table\TextHomeTable;
use Literary\Model\Table\HeadingTable;
use Literary\Model\Table\ShowingTable;
use Literary\Model\Table\RgpdTable;


trait BlogTrait
{
    public function __postConstruct()
    {
        $this->twig->addGlobal('chapitresall', (new PostsTable())->all());
        $this->twig->addGlobal('texthome', (new TextHomeTable())->all());
        $this->twig->addGlobal('headings', (new HeadingTable())->all());
        $this->twig->addGlobal('showingsP', (new ShowingTable())->listShowingPubli());
        $this->twig->addGlobal('showingsD', (new ShowingTable())->listShowingDraft());
        $this->twig->addGlobal('rgpd', (new RgpdTable())->all());
    }
}