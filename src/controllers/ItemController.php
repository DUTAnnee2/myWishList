<?php
	namespace mywishlist\controllers;
	
	use JetBrains\PhpStorm\NoReturn;
    use \mywishlist\models\Item as Item;
	
	  class ItemController{



          function getItem($id): string
          {
              $listl = \mywishlist\models\Item::find($id);
              $vue = new \mywishlist\views\VueParticipant([$listl]);

              return $vue->render(3);
          }

          #[NoReturn] function deleteItem($id)
          {
              $item = \mywishlist\models\Item::find($id);
              $item->delete();
              header('Location: /');
              Exit();
          }

          function editItem($id): string
          {
              $item = \mywishlist\models\Item::find($id);
              $vue = new \mywishlist\views\VueCreateEditItem([$item]);
              return $vue->renderModifier($item->id);
          }

          #[NoReturn] public function saveEditedItem(mixed $id)
          {
              $item = \mywishlist\models\Item::find($id);
              $item->nom = $_POST['titre'];
              $item->descr = $_POST['description'];
              $item->img = $_POST['img'];
              $item->tarif = $_POST['price'];
              $item->save();
              header('Location: /');
              Exit();
          }

      }