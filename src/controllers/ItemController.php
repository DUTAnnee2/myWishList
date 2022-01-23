<?php

namespace mywishlist\controllers;

use JetBrains\PhpStorm\NoReturn;
use JetBrains\PhpStorm\Pure;
use \mywishlist\models\Item as Item;

class ItemController
{


    function getItem($id): string
    {
        $listl = \mywishlist\models\Item::find($id);
        $vue = new \mywishlist\views\VueListItem([$listl]);

        return $vue->renderLists(3);
    }

    #[NoReturn] function deleteItem($listid,$id)
    {
        $item = \mywishlist\models\Item::find($id);
        $item->delete();
        header('Location: /'.$listid);
        exit();
    }

    function editItem($id): string
    {
        $item = \mywishlist\models\Item::find($id);
        $vue = new \mywishlist\views\VueCreateEditItem();
        return $vue->renderModifier($id);
    }

    #[NoReturn] public function saveEditedItem($listid, $id)
    {
        $item = \mywishlist\models\Item::find($id);
        $item->nom = $_POST['titre'];
        $item->descr = $_POST['description'];
        $item->img = $_POST['img'];
        $item->tarif = $_POST['price'];
        $item->save();
        header('Location: /'.$listid);
        exit();
    }

    #[Pure] public function createNewItem(): string
    {
        $vue = new \mywishlist\views\VueCreateEditItem();
        return $vue->renderCreateItem();
    }

    #[NoReturn] public function saveNewItem($listid)
    {
        $item = new \mywishlist\models\Item;
        $item->liste_id = $listid;
        $item->nom = $_POST['titre'];
        $item->descr = $_POST['description'];
        $item->img = $_POST['img'];
        $item->tarif = $_POST['price'];
        $item->save();
        header('Location: /'.$listid);
        exit();
    }

    function reserverItem($id){
        if(isset($_SESSION["userid"]))
        {
            $item = \mywishlist\models\Item::find($id);
            $item->reserv_id =$_SESSION["userid"];
            $item->save();

            header('Location: /'.$item["liste_id"]);
            exit();
        }
    }

}