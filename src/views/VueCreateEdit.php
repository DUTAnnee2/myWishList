<?php

namespace mywishlist\views;

use JetBrains\PhpStorm\Pure;

class VueCreateEdit
{

    private Elements $elements;

    #[Pure] public function __construct()
    {
        $this->elements = new Elements();
    }

    public function render() : string {
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
                    <input type="submit" value="Créer une liste" class="form-submit">
                </form>
            </div>

HTML;

        $html .= $this->elements->renderFooter();
        return $html;
    }
}