<?php

namespace mywishlist\views;

class VueProfile
{

    function render(): string
    {
        $id = $_SESSION["userid"];
        $u = \mywishlist\models\User::where('user_id', "=", $id)->get();
        $elements = new Elements();
        $render = $elements->renderHtmlHeaders() . $elements->renderHeader();
        //TODO
        return $render;
    }
}