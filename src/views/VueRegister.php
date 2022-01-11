<?php

namespace mywishlist\views;

class VueRegister
{
    //Cases : 1 : classique, 2 : erreur, 3 : succes
        function getRender($case, $error="") : string {
            $elements = new Elements();
            $render = $elements->renderHeaders().$elements->renderHeader();
            $login = "";
            $email = "";
            if(isset($_POST["login"]) && isset($_POST["email"]))
            {
                $login = $_POST["login"];
                $email = $_POST["email"];
            }
            $form = <<<HTML
        
 <div class="form-container">
            <form action="" method="post" class="id-form">
            <label for="login">Min 5 chars</label>
                <input type="text" placeholder="Login" class="form-input" name="login" value="$login">
                            <label for="email">Min 10 chars</label>

                <input type="email" placeholder="Email" class="form-input" name="email" value="$email">
                <input type="password" placeholder="Password" class="form-input" name="pwd">
                            <label for="pwd">Min 5 chars</label>
                <input type="password" placeholder="Confirm password" class="form-input" name="pwd_c">
                <input type="submit" value="REGISTER" class="form-submit">
            </form>
        </div>
HTML;

            switch ($case)
            {
                case 1:
                    $render.=$form;
                    break;
                case 3 :
                    $render.="<p>Vous avez été enregistré. Cliquez <a href='/login'>ici</a> pour vous connecter</p>".$form;
                    break;
                default:
                    $render.="<p>".$error."</p>".$form;
            }


            return $render.$elements->renderFooter();
        }
}