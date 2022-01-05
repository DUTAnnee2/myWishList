<?php
//TD13
namespace mywishlist\views;
class VueParticipant
{
    private $list;

    /**
     * Classic constructor
     * @param $data
     */
    public function __construct($data)
    {
        $this->list = $data;
    }

    /**
     * Display a list
     * @param $liste
     * @return string
     */
    private function displayListe($liste)
    {
        $html = '<div class="card">';
        $html .= "<h2>" . $liste["titre"] . "</h2>";
        $html .= "<h3>FIN : " . $liste["expiration"] . "</h3>";
        $html .= "<h4>ID : " . $liste["no"] . "</h4>";
        $html .= '<div class="card-description">';
        $html .= "<p>" . $liste["description"] . "</p>";
        $html .= '</div>';


        $html .= <<<HTML
<div class="card-interraction-btns">
                    <a href="#" class="btn">
                        <img src="../../web/icons/edit.svg" alt="edit icon">
                    </a>
                    <a href="#" class="btn">
                        <img src="../../web/icons/delete.svg" alt="delete icon">
                    </a>
                    <a href="#" class="btn">
                        <img src="../../web/icons/share.svg" alt="share icon">
                    </a>
                    
                </div>
            </div>
HTML;
        return $html;

    }

    /**
     * Display list and its items
     * @param $liste
     * @return string
     */
    private function displayListeItems($liste)
    {

        $html = $this->displayListe($liste);
        $l = \mywishlist\models\Item::where('liste_id', "=", $liste["no"])->get()->toArray();
        foreach ($l as $item) {
            $html .= $this->displayItem($item);
        }
        return $html;
    }

    /**
     * Dispay item
     * @param $item
     * @return string
     */
    private function displayItem($item)
    {
        $html = "<tr>";
        $html .= "<td>" . $item["nom"] . "</td>";
        $html .= "<td>" . $item["descr"] . "</td>";
        $html .= "<td>" . $item["tarif"] . "</td>";
        $html .= "<td><img src='../../web/img/" . $item["img"] . "' alt='item' class='item-image'></td>";
        $html .= "</tr>";
        return $html;
    }

    /**
     * Generate render HTML code
     * @param $type
     * @return string
     */
    public function render($type)
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
            <img src="../../web/icons/user.svg" alt="user icon" class="user-icon">
        </nav>
    </header>

    <main>
            <div class="form-container">
            <form action="" method="post" class="id-form">
                <input type="text" placeholder="ID de votre liste" class="form-input" name="id">
                <input type="submit" value="CHERCHER" class="form-submit">
            </form>
        </div>
        <div class="card-container container-large">
HTML;
        switch ($type) {
            case 1:
                foreach ($this->list as $l) {
                    $html .= $this->displayListe($l);
                }
                break;

            case 2:
                foreach ($this->list as $l) {
                    $html .= $this->displayListeItems($l);
                }
                break;
            case 3:
                $html .= $this->displayItem($this->list[0]);
        }

        $html .= <<<HTML
      </div>
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

        return $html;
    }

}