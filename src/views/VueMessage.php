<?php

namespace mywishlist\views;

use JetBrains\PhpStorm\Pure;

class VueMessage
{
    private $elements;
    #[Pure] function __construct()
    {
        $this->elements = new Elements();
    }

    function renderMessages($messages,$id) :string{
        $render = $this->elements->renderHtmlHeaders() . $this->elements->renderHeader().<<<HTML
            <a href="/$id" class="msg-switch">Retour à la liste</a>
HTML;

        $render .="<div class='message-container'>";

        foreach ($messages as $msg) {
        $render .= $this->displayMessage($msg);
    }
        $render.="</div>";
        if(isset($_SESSION["userid"]))
        {
           $render.=<<<HTML
                     <div class="form-container">
                    <form action="" method="post" class="login-form">
                        <textarea placeholder="Blablabla" class="login-field"  name="text"></textarea>
                        <input type="submit" value="Envoyer" class="login-connexion">
                    </form>

                </div>
                HTML;
        }
    return $render."</div>".$this->elements->renderFooter();
    }
    function displayMessage($message)
    {

        $author= \mywishlist\models\User::where("user_id","=",$message["author_id"])->get()[0]["username"];
        $text= $message["text"];
        $time = $message["date"];
        return <<<HTML
                <div class="message">
                <p><h1>$author</h1><h4>$time</h4></p><p>$text</p>
</div>
HTML;

    }

}