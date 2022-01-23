<?php

namespace mywishlist\controllers;

/**
 * Class MessageController
 * @package mywishlist\controllers
 * @author 1shade
 * @author Eureka
 */
class MessageController
{
    /**
     * Get all messages
     * @param $listId int List id
     * @return string HTML content
     */
    function getMessages(int $listId): string
    {
        $vue = new \mywishlist\views\VueMessage();
        $msgs = \mywishlist\models\Message::where('liste_id', "=", $listId)->orderBy('mess_id', 'DESC')->get();

        return $vue->renderMessages($msgs->toArray(), $listId);
    }

    /**
     * Add message
     * @param $listeid int List id
     * @return string HTML content
     */
    function postMessage(int $listeid): string
    {
        if (isset($_POST["text"]) && isset($_SESSION["userid"])) {
            $text = $_POST["text"];
            $userid = $_SESSION["userid"];
            if (strlen($text) > 3) {
                $message = new \mywishlist\models\Message();
                $message->author_id = $userid;
                $message->liste_id = $listeid;
                $message->text = $text;
                $message->save();
            }

        }
        return $this->getMessages($listeid);
    }
}