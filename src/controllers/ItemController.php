<?php
	namespace mywishlist\controllers;
	
	use \mywishlist\models\Item as Item;
	
	  class ItemController{



          function getItem($id): string
          {
              $listl = \mywishlist\models\Item::find($id);
              $vue = new \mywishlist\views\VueParticipant([$listl]);

              return $vue->render(3);
          }

      }