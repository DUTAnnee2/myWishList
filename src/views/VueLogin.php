<?php

namespace mywishlist\views;

use JetBrains\PhpStorm\Pure;

class VueLogin
{

    private Elements $elements;

        //Cas 1 : Pas connecté, 2 : Deja connecte, 3 : erreur
    #[Pure] public function __construct()
    {
        $this->elements = new Elements();
    }

    #[Pure] function getLoginRender($case) : string
        {
            $render = $this->elements->renderHeaders().$this->elements->renderHeader();
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

            return $render.$this->elements->renderFooter();
        }
}