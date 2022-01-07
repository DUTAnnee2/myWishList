<?php

namespace mywishlist\views;

class VueLogin
{
        //Cas 1 : Pas connecté, 2 : Deja connecte, 3 : erreur
        function getRender($case) : string
        {
            $elements = new Elements();
            $render = $elements->renderHeaders().$elements->renderHeader();
            $form = <<<HTML
 <div class="form-container">
            <form action="" method="post" class="id-form">
                <input type="text" placeholder="Login" class="form-input" name="login">
                <input type="password" placeholder="Pswd" class="form-input" name="pwd">
                <input type="submit" value="LOGIN" class="form-submit">
            </form>
        </div>
HTML;


            switch ($case)
            {
                case 1:
                    $render.=$form;

                    break;
                case 2:
                    $render.=<<<HTML
                <div class="">
                <p>Vous avez été déconnecté</p>
                </div>
HTML.$form;

                    break;
                case 3:
                    $render.=<<<HTML
                <div class="">
                <p>Les informations transmises n'ont pas permis de vous authentifier.</p>
                </div>
HTML.$form;

                    break;
            }

            return $render.$elements->renderFooter();
        }
}