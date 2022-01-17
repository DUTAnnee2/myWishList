<?php

namespace mywishlist\views;

use JetBrains\PhpStorm\Pure;

class VueRegister
{
    //Cases : 1 : classique, 2 : erreur, 3 : succes
    #[Pure] function getRender($case, $error = ""): string
    {
        $elements = new Elements();
        $render = $elements->renderHtmlHeaders() . $elements->renderHeader();
        $login = "";
        $email = "";
        if (isset($_POST["login"]) && isset($_POST["email"])) {
            $login = $_POST["login"];
            $email = $_POST["email"];
        }
        $form = <<<HTML
                <div class="form-container">
                    <form action="" method="post" class="login-form">
                        <p>Mininimum 5 caractères</p>
                        <input type="text" placeholder="Login" class="login-field" name="login" value="$login">
                        <p>Mininimum 10 caractères</p>
                        <input type="email" placeholder="Email" class="login-field" name="email" value="$email">
                        <p>Mininimum 5 caractères</p>
                        <input type="password" placeholder="Password" class="login-field" name="pwd">
                        <input type="password" placeholder="Confirm password" class="login-field" name="pwd_c">
                        <input type="submit" value="REGISTER" class="form-submit-login">
                    </form>
                </div>
HTML;

        $render .= match ($case) {
            1 => $form,
            3 => "<div class='form-message'><p>Vous avez été enregistré. Cliquez <a href='/login'><span class='text-purple'>ici</span></a> pour vous connecter</p></div>" . $form,
            default => "<p class='form-message'>" . $error . "</p>" . $form,
        };


        return $render . $elements->renderFooter();
    }
}