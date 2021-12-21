<?php

namespace mywishlist\controllers;

use mywishlist\models\Liste;
use mywishlist\views\ListView;

class ListController
{
    /**
     * Display every lists that are in the database for an user
     * @param $rq
     * @param $rs
     * @param $args
     * @return mixed
     */
    public function displayAll($rq, $rs, $args)
    {
        // Get all lists in database and generate the view
        $listes = Liste::all();
        $view = new ListView();

        // Generate HTML response code to display every lists
        $html = $view->generateLists($listes);
        $rs->write($html);
        return $rs;
    }

    /**
     * Display a list by his ID (no column) for a specific user
     * @param $rq
     * @param $rs
     * @param $args
     * @return mixed
     */
    public function displayById($rq, $rs, $args)
    {
        // Get all lists in database and generate the view
        $listes = Liste::all();
        $view = new ListView();

        // Find and filter the list by the id catched by slim in the URL
        $liste = $listes->find($args);

        // Generate HTML response code
        $html = $view->generateLists($liste);
        $rs->write($html);
        return $rs;
    }

}