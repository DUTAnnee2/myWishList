<?php

namespace mywishlist\controllers;

use mywishlist\models\Liste;

class ListController
{
    function getList()
    {
        if(!isset($_POST['id']))
        {
            //display all cards
            $listl = \mywishlist\models\Liste::all();
            $vue = new \mywishlist\views\VueParticipant($listl->toArray());
            return $vue->render(1);
        }
        else{
            $id = $_POST['id'];
            $listl = \mywishlist\models\Liste::where("no", "=", $id)->get();
            $vue = new \mywishlist\views\VueParticipant($listl->toArray());
           return $vue->render(2);
        }
    }

    function getItem($id)
    {
        $listl = \mywishlist\models\Item::find($id);
        $vue = new \mywishlist\views\VueParticipant([$listl]);

       return $vue->render(3);
    }

    function deleteListe($listeid)
    {
        if(isset($_SESSION["userid"])) {
                $listl = \mywishlist\models\Liste::where([["no", "=", $listeid],["user_id", "=", $_SESSION["userid"]]])->delete();

        }
        header("Location: /participant");
        Exit();
    }

    function editList($listeid)
    {
        if(isset($_SESSION["userid"])) {


            if (!isset($_POST["titre"])) {
                $listl = \mywishlist\models\Liste::where("no", "=", $listeid)->get()->toArray();
                $vue = new \mywishlist\views\VueParticipant([$listl]);
                return $vue->editList($listl);

            } else {
                $public = 0;
                if(isset($_POST["public"]))
                {
                    $public=1;
                }
                $listl = \mywishlist\models\Liste::where([["no", "=", $listeid],["user_id", "=", $_SESSION["userid"]]])->update([
                "titre" => $_POST["titre"],
                "description" => $_POST["desc"],
                    "public" => $public
                ]);


                header("Location: /participant");
                Exit();
            }
        }
        else
        {
            header("Location: /login");
            Exit();

        }

    }

    public function createList() : string {
        if(isset($_SESSION["userid"])) {
            if (!isset($_POST["titre"])) {
                $vue = new \mywishlist\views\VueCreateEdit();
                return $vue->render();

            } else {
                $public = 0;
                if(isset($_POST["public"]))
                {
                    $public=1;
                }
                $liste = new Liste();
                $liste->user_id = $_SESSION["userid"];
                $liste->titre = $_POST["titre"];
                $liste->description = $_POST["description"];
                $liste->public = $_POST["public"];

                $liste->save();
                header("Location: /participant");
                Exit();
            }
        }
        else {
            header("Location: /login");
            Exit();
        }
    }


}