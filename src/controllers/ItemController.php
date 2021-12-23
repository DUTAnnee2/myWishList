<?php
namespace mywishlist\controller;

  use \mywishlist\models\Item as Item;
  use \mywishlist\views\ItemView as ItemView;

  class ItemController{

    public function DisplayItem($idItem)
    {
        $item = Item::where(['id' => $idItem])->first();
        $vue = new ItemView();
        $vue->render($item);
    }

    //je voulais faire createItem mais zzz

  }