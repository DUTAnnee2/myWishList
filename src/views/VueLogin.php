<?php

namespace mywishlist\views;

class VueLogin
{

        function getRender()
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
            <header>
                <nav class="container-large">
                    <h1>
                        <span>My</span><span class="text-purple">WishList</span>
                    </h1>
                    <img src="/web/icons/user.svg" alt="user icon" class="user-icon">
                </nav>
            </header>
        
            <main>
                    <div class="form-container">
                    <form action="" method="post">
                        <input type="text" placeholder="Email" class="form-input" name="email">
                        <input type="password" placeholder="mot de passe" class="form-input" name="pwd">
                        <input type="submit" value="CHERCHER" class="form-submit">
                    </form>
                </div>
        HTML;
        }
}