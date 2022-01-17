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

    #[Pure] public function renderCreateList() : string {
        $html = $this->elements->renderHeaders() . $this->elements->renderHeader();
        $html .= <<<HTML
            <div class="form-container">
                <form method="post" class="create-modify-form">
                    <input type="text" name="titre" placeholder="Titre de la liste" class="form-titre">
                    <textarea name="description" placeholder="Description de la liste"></textarea>
                    <div class="puclic-check">
                        <label for="public">Cette liste est publique?</label>
                        <input type="checkbox" name="public" id="">
                    </div>
                    <input type="submit" value="Créer la liste" class="form-submit">
                </form>
            </div>

HTML;

        $html .= $this->elements->renderFooter();
        return $html;
    }

    #[Pure] public function renderModifyList($liste) : string {
        $liste = $liste[0];
        $html = $this->elements->renderHeaders() . $this->elements->renderHeader();
        $titre = $liste["titre"];
        $desc = $liste["description"];
        $checkbox = '<input type="checkbox" checked name="public">';
        $id = $liste["no"];
        if($liste["public"]==0)
        {
            $checkbox = '<input type="checkbox" name="public">';
        }
        $html .= <<<HTML
            <div class="form-container">
                <form method="post" class="create-modify-form">
                    <input type="text" name="titre" placeholder="Titre de la liste" class="form-titre" value="$titre">
                    <textarea name="description" placeholder="Description de la liste">$desc</textarea>
                    <div class="puclic-check">
                        <label for="public">Cette liste est publique?</label>
                        $checkbox
                    </div>
                    <input type="submit" value="Modifier la liste" class="form-submit">
                </form>
            </div>

HTML;

        $html .= $this->elements->renderFooter();
        return $html;
    }
}