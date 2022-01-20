<?php

namespace mywishlist\views;

use JetBrains\PhpStorm\Pure;
use mywishlist\controllers\ItemController;

class VueCreateEditItem
{

    private $elements;

    #[Pure] public function __construct()
    {
        $this->elements = new Elements();
    }

    #[Pure] public function renderModifier($id): string
    {
        $item = \mywishlist\models\Item::find($id);
        $img = $item->img;
        $titre = $item->nom;
        $description = $item->descr;
        $prix = $item->tarif;
        $html = $this->elements->renderHtmlHeaders() . $this->elements->renderHeader();
        $html .= <<<HTML
            <div class="form-container">
                <form action="" method="post" class="login-form">
                    <input type="text" name="img" id="" value="$img" class="login-field" placeholder="URL de l'image">
                    <input type="text" name="titre" id="" class="login-field" value="$titre" placeholder="titre de l'item">
                    <textarea name="description" id="" cols="30" rows="10" class="login-field" placeholder="Description de l'item">$description</textarea>
                    <input type="number" name="price" id="" min="0" step="0.01" value="$prix" class="login-field" placeholder="Prix de l'item">
                    <input type="submit" value="Modifier" class="login-connexion">
                </form>
            </div>
HTML;
        $html .= $this->elements->renderFooter();
        return $html;
    }

    #[Pure] public function renderCreateItem()
    {
        $html = $this->elements->renderHtmlHeaders() . $this->elements->renderHeader();
        $html .= <<<HTML
            <div class="form-container">
                <form action="" method="post" class="login-form">
                    <input type="text" name="img" id="" value="" class="login-field" placeholder="URL de l'image">
                    <input type="text" name="titre" id="" class="login-field" value="" placeholder="titre de l'item">
                    <textarea name="description" id="" cols="30" rows="10" class="login-field" placeholder="Description de l'item"></textarea>
                    <input type="number" name="price" id="" min="0" step="0.01" value="" class="login-field" placeholder="Prix de l'item">
                    <input type="submit" value="Enregistrer" class="login-connexion">
                </form>
            </div>
HTML;
        $html .= $this->elements->renderFooter();
        return $html;
    }
}