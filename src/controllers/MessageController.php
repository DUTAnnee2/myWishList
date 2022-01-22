<?php

namespace mywishlist\controllers;

class MessageController
{
    function getMessages($listId)
    {
        $vue = new \mywishlist\views\VueMessage();
         $msgs =  \mywishlist\models\Message::where('liste_id',"=",$listId)->orderBy('liste_id','DESC')->get();

        return $vue->renderMessages($msgs->toArray(), $listId);
    }
    function postMessage($listeid) {
        if(isset($_POST["text"]) && isset($_SESSION["userid"]))
        {
            $text = $_POST["text"];
            $userid=$_SESSION["userid"];
            if(strlen($text)>3)
            {
                $message = new \mywishlist\models\Message();
                $message->author_id=$userid;
                $message->liste_id=$listeid;
                $message->text=$text;
                $message->save();
            }

        }
        return $this->getMessages($listeid);
    }
}