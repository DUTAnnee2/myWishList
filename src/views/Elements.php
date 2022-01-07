<?php

namespace mywishlist\views;

class Elements
{

    public function renderHeaders() : string
    {
        $html = <<<HTML
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/web/css/main.css">
    <title>MyWishList</title>
</head>
<body>

HTML;

        return $html;
    }

    public function renderHeader() : string
    {
        $html = <<<HTML
    <header>
        <nav class="container-large">
            <h1>
                <a href="/index.php/participant">
                    <span>My</span><span class="text-purple">WishList</span>
                </a>
            </h1>
            <img src="/web/icons/user.svg" alt="user icon" class="user-icon">
        </nav>
    </header>
    <main>
HTML;

        return $html;
    }

    public function renderFormId() : string
    {
        $html = <<<HTML
        <div class="form-container">
            <form action="" method="post" class="id-form">
                <input type="text" placeholder="ID de votre liste" class="form-input" name="id">
                <input type="submit" value="CHERCHER" class="form-submit">
            </form>
        </div>
HTML;

        return $html;
    }
}