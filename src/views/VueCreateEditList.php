<?php

namespace mywishlist\views;

use JetBrains\PhpStorm\Pure;

class VueCreateEditList
{

    private Elements $elements;

    #[Pure] public function __construct()
    {
        $this->elements = new Elements();
    }

    #[Pure] public function renderCreateList(): string
    {
        $html = $this->elements->renderHtmlHeaders() . $this->elements->renderHeader();
        $html .= <<<HTML
            <div class="form-container">
                <form method="post" class="login-form">
                    <input type="text" name="titre" placeholder="Titre de la liste" class="login-field">
                    <textarea name="description" placeholder="Description de la liste" class="login-field"></textarea>
                    <input type="date" name="expiration" placeholder="Expiration" class="login-field" value="">
                    <div class="login-field">
                        <label for="public">Cette liste est publique?</label>
                        <input type="checkbox" name="public" id="">
                    </div>
                    <input type="submit" value="Créer la liste" class="form-submit-login">
                </form>
            </div>

HTML;

        $html .= $this->elements->renderFooter();
        return $html;
    }

    #[Pure] public function renderModifyList($liste): string
    {
        $liste = $liste[0];
        $html = $this->elements->renderHtmlHeaders() . $this->elements->renderHeader();
        $date = $liste['expiration'];
        $titre = $liste["titre"];
        $desc = $liste["description"];
        $checkbox = '<input type="checkbox" checked name="public">';
        $id = $liste["no"];
        if ($liste["public"] == 0) {
            $checkbox = '<input type="checkbox" name="public">';
        }
        $html .= <<<HTML
            <div class="form-container">
                <form method="post" class="login-form">
                    <input type="text" name="titre" placeholder="Titre de la liste" class="login-field" value="$titre">
                    <textarea name="description" placeholder="Expiration" class="login-field">$desc</textarea>
                    <input type="date" name="expiration" placeholder="Titre de la liste" class="login-field" value="$date">
                    <div class="login-field">
                        <label for="public">Cette liste est publique?</label>
                        $checkbox
                    </div>
                    <input type="submit" value="Modifier la liste" class="form-submit-login">
                </form>
            </div>

HTML;

        $html .= $this->elements->renderFooter();
        return $html;
    }
}