<?php

namespace mywishlist\views;

use JetBrains\PhpStorm\Pure;

class VueCreateEditItem
{

    private $item;
    private $elements;

    #[Pure] public function __construct($item)
    {
        $this->item = $item;
        $this->elements = new Elements();
    }

    #[Pure] public function render(): string
    {
        $html = $this->elements->renderHeaders() . $this->elements->renderHeader();
        $html .= <<<HTML
            <div class="form-container">
                <form action="" method="post" class="login-form">
                    <input type="url" name="img" id="" placeholder="URL de l'image" class="login-field">
                    <input type="text" name="login" id="" class="login-field" placeholder="titre">
                    <textarea name="" id="" cols="30" rows="10" class="login-field">Description</textarea>
                    <input type="number" name="" id="" min="0" step="0.01" placeholder="Prix en €" class="login-field">
                    <input type="submit" value="Modifier" class="login-connexion">
                </form>
            </div>
HTML;
        $html .= $this->elements->renderFooter();
        return $html;
    }
}