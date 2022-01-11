<?php

namespace mywishlist\views;


/**
 * Class Elements, used to render the differents reusable elements of the website
 */
class Elements
{

    /**
     * Render the HTML headers
     * @return string The HTML headers
     */
    public function renderHeaders(): string
    {
        return <<<HTML
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
    }

    /**
     * Render the HTML page header
     * @return string The HTML page header
     */
    public function renderHeader(): string
    {
        $user = "";
        if (isset($_SESSION["userid"])) {
            $user = "Bonjour, " . $_SESSION["username"] . "!";
        }

        return <<<HTML
            <header>
                <nav class="container-large">
                    <h1>
                        <a href="/participant">
                            <span>My</span><span class="text-purple">WishList</span>
                        </a>
                    </h1>
                    $user
                    <a href="/login">
                            <img src="/web/icons/user.svg" alt="user icon" class="user-icon">
                    </a>
                </nav>
            </header>
            <main>
HTML;
    }


    /**
     * Render the HTML form to get the ID of a list
     * @return string The HTML form to get the ID of a list
     */
    public function renderFormId(): string
    {
        return <<<HTML
            <div class="form-container">
                <form action="" method="post" class="id-form">
                    <input type="text" placeholder="ID de votre liste" class="form-input" name="id">
                    <input type="submit" value="CHERCHER" class="form-submit">
                </form>
            </div>
HTML;
    }

    /**
     * Render the HTML page footer
     * @return string The HTML page footer
     */
    public function renderFooter(): string
    {
        return <<<HTML
                </main>
                    <footer>
                        <nav class="container-large">
                            <h1>
                                <span>My</span><span class="text-purple">WishList</span>
                            </h1>
                        </nav>
                    </footer>
            </body>
            </html>
HTML;
    }

    /**
     * Render the HTML buttons to edit a list
     * @param $id
     * @return string The HTML buttons to edit a list
     */
    public function renderInterractionCardButtons($id): string
    {
        return <<<HTML
            <div class="card-interraction-btns">
                <a href="#" class="btn">
                    <img src="/web/icons/edit.svg" alt="edit icon">
                </a>
                <a href="/delete-list/$id" class="btn">
                    <img src="/web/icons/delete.svg" alt="delete icon">
                </a>
                <a href="#" class="btn">
                    <img src="/web/icons/share.svg" alt="share icon">
                </a>
            </div>
HTML;
    }
}