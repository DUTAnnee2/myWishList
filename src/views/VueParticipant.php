<?php
//TD13
namespace mywishlist\views;
use JetBrains\PhpStorm\Pure;
use mywishlist\models\Liste;

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
    private function displayListeItems($liste): string
    {
        $html = '<div class="item-cards-container">';
        $l = \mywishlist\models\Item::where('liste_id', "=", $liste["no"])->get()->toArray();
        foreach ($l as $item) {
            $html .= $this->displayItem($item);
        }
        $html .= <<<HTML
                    <div class="item-add">
                        <a href="#" class="btn">
                            <img src="/web/icons/plus-circle.svg" alt="add icon">
                        </a>
                    </div>
HTML;
        $html .= '</div>';
        return $html;

    }

    /**
     * Dispay item
     * @param $item
     * @return string
     */
    #[Pure] private function displayItem($item): string
    {
        $id = $item["id"];
        $name = $item["nom"];
        $description = $item["descr"];
        $tarif = $item["tarif"];
        $img = "/web/img/" . $item["img"];
        return $this->elements->renderCardItem($name, $description, $tarif, $img, $id);
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
                $html .= '<div class="item-cards-container">';

                $html .= $this->displayItem($this->list[0]);
                $html .= '</div>';

        }

        $html .= $this->elements->renderFooter();

        return $html;
    }


    #[Pure] public function shareRender($liste) : string{
        $html = $this->elements->renderHeaders() . $this->elements->renderHeader() ;
        $html .= "localhost:8000/liste/".$liste[0]["token"];

        $html .= $this->elements->renderFooter();

        return $html;
    }
}