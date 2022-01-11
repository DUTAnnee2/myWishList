<?php

namespace mywishlist\controllers;

use mywishlist\models\Liste;

class ListController
{
    function getList()
    {
        if(!isset($_POST['id']))
        {
            //display all cards
            $listl = \mywishlist\models\Liste::all();
            $vue = new \mywishlist\views\VueParticipant($listl->toArray());
            return $vue->render(1);
        }
        else{
            $id = $_POST['id'];
            $listl = \mywishlist\models\Liste::where("no", "=", $id)->get();
            $vue = new \mywishlist\views\VueParticipant($listl->toArray());
           return $vue->render(2);
        }
    }

    function getItem($id)
    {
        $listl = \mywishlist\models\Item::find($id);
        $vue = new \mywishlist\views\VueParticipant([$listl]);

       return $vue->render(3);
    }
    function deleteListe($userid, $listeid)
    {
        $listl = \mywishlist\models\Liste::where("no", "=", $listeid)->get();
        if($listl["user_id"]==$userid)
        {
            \mywishlist\models\Liste::where("no", "=", $listeid)->delete();
        }
    }
}