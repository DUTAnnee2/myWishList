<?php

namespace mywishlist\views;


/**
 * Class Elements, used to render the differents reusable elements of the website
 * @package mywishlist\views
 * @author 1shade
 * @author Eureka
 * @author Azflow
 */
class Elements
{

    /**
     * Render the HTML headers
     * @return string The HTML headers
     */
    public function renderHtmlHeaders(): string
    {
        return <<<HTML
            <!doctype html>
            <html lang="fr">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <link rel="stylesheet" href="/web/css/main.min.css">
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
        $login = "/login";
        if (isset($_SESSION["userid"])) {
            $user = "Bonjour, " . $_SESSION["username"] . "!";
            $login = "/user";
        }

        return <<<HTML
            <header>
                <nav class="container-large">
                    <h1>
                        <a href="/">
                            <span>My</span><span class="text-purple">WishList</span>
                        </a>
                    </h1>
                    <p>$user</p>
                    <a href="$login">
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
                <form action="/" method="post" class="id-form">
                    <input type="text" placeholder="ID de votre liste" class="form-input" name="redirect_id">
                    <input type="submit" value="AFFICHER" class="form-submit">
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
                            <h4>
                                <span>My</span><span class="text-purple">WishList</span>
                            </h4>
                        </nav>
                    </footer>
            </body>
            </html>
HTML;
    }

    /**
     * Render the HTML buttons to edit a list
     * @param $id int The ID of the list
     * @return string The HTML buttons to edit a list
     */
    public function renderActionButtons(int $id): string
    {
        return <<<HTML
            <div class="card-interraction-btns">
                <a href="/edit-list/$id" class="btn">
                    <img src="/web/icons/edit.svg" alt="edit icon">
                </a>
                <a href="/delete-list/$id" class="btn">
                    <img src="/web/icons/delete.svg" alt="delete icon">
                </a>
                <a href="/share/$id" class="btn">
                    <img src="/web/icons/share.svg" alt="share icon">
                </a>
            </div>
HTML;
    }

    /**
     * Render the HTML form to create an item card
     * @param $name string The name of the item
     * @param $description string The description of the item
     * @param $tarif string The price of the item
     * @param $img string The image of the item
     * @param $id int The ID of the list
     * @param $listid int The ID of the list
     * @return string The HTML form to create an item card
     */
    public function renderCardItem(string $name, string $description, string $tarif, string $img, int $id, int $listid): string
    {
        return <<<HTML
            <div class="item-card">
                <img src="$img" alt="" srcset="" class="item-img">
                <h3><a href="/item/$id">
                    $name
                    </a>
                </h1>
                <p>
                    $description             
                </p>
                <h5>
                    $tarif €
                </h5>
                <div class="card-interraction-btns">
                    <a href="/edit-item/$listid/$id" class="btn">
                        <img src="/web/icons/edit.svg" alt="edit icon">
                    </a>
                    <a href="/delete-item/$listid/$id" class="btn">
                        <img src="/web/icons/delete.svg" alt="delete icon">
                    </a>
                </div>
            </div>
HTML;


    }
}