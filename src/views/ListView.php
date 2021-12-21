<?php

namespace mywishlist\views;

class ListView
{
    /**
     * Generates HTML code to diplay lists
     * @param $lists
     * @return string
     */
    public function generateLists($lists): string
    {

        // Base HTML code
        $html = <<<HTML
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/src/views/assets/css/main.css">
    <link rel="stylesheet" href="../../src/views/assets/css/main.css" type="text/css">
    <title>Document</title>
</head>
<body>
    <header>
        <nav class="container-large">
            <h1>
                <span>My</span><span class="text-purple">WishList</span>
                
            </h1>
            <img src="../../src/views/assets/icons/user.svg" alt="user icon" class="user-icon">
        </nav>
    </header>
    <main>
        <div class="form-container">
            <form action="" method="get" class="id-form">
                <input type="text" placeholder="ID de votre liste" class="form-input">
                <input type="submit" value="CHERCHER" class="form-submit">
            </form>
        </div>
    </main>
HTML;
        // Add every lists to the HTML code
        foreach ($lists as $list) {
            $html .= $list->description;
        }

        // Close tags
        $html .= "</body></html>";

        // Return the HTML code to the controller
        return $html;
    }
}