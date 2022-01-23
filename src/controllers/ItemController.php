<?php

namespace mywishlist\controllers;

use JetBrains\PhpStorm\NoReturn;
use JetBrains\PhpStorm\Pure;
use \mywishlist\models\Item as Item;

/**
 * Class ItemController
 * @author 1shade
 * @author Eureka
 * @package mywishlist\controllers
 */
class ItemController
{

    /**
     * Get a specific item
     * @param $id int Item id
     * @return string Item view
     */
    function getItem(int $id): string
    {
        $listl = Item::find($id);
        $vue = new \mywishlist\views\VueListItem([$listl]);
        return $vue->renderLists(3);
    }


    /**
     * Delete an item in a list
     * @param $listid int List id
     * @param $id int Item id
     * @return void Redirect to the modified list
     */
    #[NoReturn] function deleteItem(int $listid, int $id): void
    {
        $item = Item::find($id);
        $item->delete();
        header('Location: /' . $listid);
        exit();
    }

    /**
     * Edit an item to a list
     * @param $id int Item id
     * @return string Item view
     */
    function editItem(int $id): string
    {
        $item = Item::find($id);
        $vue = new \mywishlist\views\VueCreateEditItem();
        return $vue->renderModifier($id);
    }

    /**
     * Update an item
     * @param $listid int List id
     * @param $id int Item id
     * @return void Redirect to the modified list
     */
    #[NoReturn] public function saveEditedItem(int $listid, int $id): void
    {
        $item = Item::find($id);
        $this->listInformations($item, $listid);
    }

    /**
     * Add an item to a list
     * @return string Item view
     */
    #[Pure] public function createNewItem(): string
    {
        $vue = new \mywishlist\views\VueCreateEditItem();
        return $vue->renderCreateItem();
    }

    /**
     * Save an item
     * @param $listid int List id
     * @return void Redirect to the modified list
     */
    #[NoReturn] public function saveNewItem(int $listid)
    {
        $item = new Item;
        $item->liste_id = $listid;
        $this->listInformations($item, $listid);
    }

    /**
     * Get informations from the list
     * @param $item Item Item
     * @param int $listid List id
     * @return void Redirect to the modified list
     */
    #[NoReturn] public function listInformations(Item $item, int $listid): void
    {
        $item->nom = $_POST['titre'];
        $item->descr = $_POST['description'];
        $item->img = $_POST['img'];
        $item->tarif = $_POST['price'];
        $item->save();
        header('Location: /' . $listid);
        exit();
    }

    /**
     * Reserve an item
     * @param $id int Item id
     * @return void Redirect to the modified list
     */
    function reserverItem(int $id): void
    {
        if (isset($_SESSION["userid"])) {
            $item = \mywishlist\models\Item::find($id);
            $item->reserv_id = $_SESSION["userid"];
            $item->save();

            header('Location: /' . $item["liste_id"]);
            exit();
        }
    }

}