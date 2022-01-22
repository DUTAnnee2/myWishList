<?php

namespace mywishlist\views;

class VueProfile
{

    function render(): string
    {
        $id = $_SESSION["userid"];
        $u = \mywishlist\models\User::where('user_id', "=", $id)->get()[0];
        $username = $u["username"];
        $email =  $u["email"];
        $elements = new Elements();
        $render = $elements->renderHtmlHeaders() . $elements->renderHeader();
        $render .= <<<HTML
<div class="card-container container-large">
<div class="card">
<h2>$username</h2>
<h4>$email</h4>
            <div class="card-interraction-btns">
          
            <a href="/login">Déconnection    </a>
       
</div>
</div>         
            </div>
              
HTML;

        return $render.$elements->renderFooter();
    }
}