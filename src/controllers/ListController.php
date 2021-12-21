<?php

namespace mywishlist\controllers;

use mywishlist\models\Liste;
use mywishlist\views\ListView;

class ListController
{
    public function displayAll($rq, $rs, $args)
    {
        $listes = Liste::all();
        $view = new ListView();
        $html = $view->generateLists($listes);
        $rs->write($html);
        return $rs;
    }

}