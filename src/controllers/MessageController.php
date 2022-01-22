<?php

namespace mywishlist\controllers;

class MessageController
{
    function getMessages($listId)
    {
        $vue = new \mywishlist\views\VueMessage();
         $msgs =  \mywishlist\models\Message::where('liste_id',"=",$listId)->orderBy('liste_id','DESC')->get();

        return $vue->renderMessages($msgs->toArray());
    }
    function postMessage($liste) {

    }
}