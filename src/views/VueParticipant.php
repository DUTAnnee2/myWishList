<?php
//TD13
namespace mywishlist\views;
use JetBrains\PhpStorm\Pure;

class VueParticipant
{
    private $list;
    private Elements $elements;

    /**
     * Classic constructor
     * @param $data
     */
    #[Pure] public function __construct($data)
    {
        $this->list = $data;
        $this->elements = new Elements();
    }

    /**
     * Display a list
     * @param $liste
     * @return string
     */
    #[Pure] private function displayListe($liste): string
    {

        $html = "";
        $id = $liste["no"];

        $html .= '<div class="card">';
        $html .= "<h2>" . $liste["titre"] . "</h2>";
        $html .= "<h3>FIN : " . $liste["expiration"] . "</h3>";
        if ($liste["public"] == 1) {
            $html .= "<h4>Liste publique</h4>";
        }
        else {

            $html .= "<h4>ID : " . $id . "</h4>";

        }
        $html .= '<div class="card-description">';
        $html .= "<p>" . $liste["description"] . "</p>";
        $html .= '</div>';
        if (isset($_SESSION["userid"])) {

            if ($liste["user_id"] == $_SESSION["userid"]) {
                $html .= $this->elements->renderInterractionCardButtons($id);
            }
        }
        $html .= "</div>";

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
    private function displayItem($item): string
    {
        $html = "<tr>";
        $html .= "<td>" . $item["nom"] . "</td>";
        $html .= "<td>" . $item["descr"] . "</td>";
        $html .= "<td>" . $item["tarif"] . "</td>";
        $html .= "<td><img src='/web/img/" . $item["img"] . "' alt='item' class='item-image'></td>";
        $html .= "</tr>";
        return $html;
    }

    /**
     * Generate render HTML code
     * @param $type
     * @return string
     */
    public function render($type): string
    {
        $html = $this->elements->renderHeaders() . $this->elements->renderHeader() . $this->elements->renderFormId();
        $html .= '<div class="card-container container-large">';
        switch ($type) {
            case 1:
                foreach ($this->list as $l) {
                    $html .= $this->displayListe($l);
                }
                $html .= <<<HTML
                    <div class="card-add">
                        <a href="/create-list" class="btn">
                            <img src="/web/icons/plus-circle.svg" alt="add icon">
                        </a>
                    </div>
HTML;

                break;

            case 2:
                foreach ($this->list as $l) {
                    $html .= $this->displayListeItems($l);
                }
                break;
            case 3:
                $html .= $this->displayItem($this->list[0]);
        }

        $html .= $this->elements->renderFooter();

        return $html;
    }

    function editList($liste)
    {
        $liste = $liste[0];
        $html = $this->elements->renderHeaders() . $this->elements->renderHeader();
        $titre = $liste["titre"];
        $desc = $liste["description"];
        $checkbox = '<input type="checkbox" checked name="public">';
        $id = $liste["no"];
        if($liste["public"]==0)
        {
            $checkbox = '<input type="checkbox" name="public">';
        }
        $form = <<<HTML
 <div class="form-container">
            <form action="" method="post" class="id-form">
                <input type="text" placeholder="Titre" class="form-input" name="titre" value="$titre">
                <textarea rows="5" name="desc">$desc</textarea>
                <label for="public">Publique?</label>
                $checkbox
                <input type="submit" value="Modifier" class="form-submit">
            </form>
        </div>
HTML;
        $html .= $form. $this->elements->renderFooter();
        return $html;
    }

}