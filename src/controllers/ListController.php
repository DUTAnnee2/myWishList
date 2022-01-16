<?php

namespace mywishlist\controllers;

use http\Header;
use mywishlist\models\Liste;
use mywishlist\views\VueCreateEdit;

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

    function deleteListe($listeid)
    {
        if(isset($_SESSION["userid"])) {
                $listl = \mywishlist\models\Liste::where([["no", "=", $listeid],["user_id", "=", $_SESSION["userid"]]])->delete();

        }
        header("Location: /");
        Exit();
    }

    function editList($listeid)
    {
        if(isset($_SESSION["userid"])) {


            if (!isset($_POST["titre"])) {
                $listl = \mywishlist\models\Liste::where("no", "=", $listeid)->get()->toArray();
                $vue = new VueCreateEdit();
                return $vue->renderModifyList($listl);

            } else {
                $public = 0;
                if(isset($_POST["public"]))
                {
                    $public=1;
                }
                $listl = \mywishlist\models\Liste::where([["no", "=", $listeid],["user_id", "=", $_SESSION["userid"]]])->update([
                "titre" => $_POST["titre"],
                "description" => $_POST["description"],
                    "public" => $public
                ]);


                header("Location: /");
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
                return $vue->renderCreateList();

            } else {
                $public = 0;
                if(isset($_POST["public"]))
                {
                    $public=1;
                }
                //Genere token
                $ne = \mywishlist\models\Liste::count() + 1;
                $token = hash("ripemd128", $ne."".rand());
                $liste = new Liste();
                $liste->user_id = $_SESSION["userid"];
                $liste->titre = $_POST["titre"];
                $liste->description = $_POST["description"];
                $liste->token = $token;
                $liste->public = $public;

                $liste->save();
                header("Location: /");
                Exit();
            }
        }
        else {
            header("Location: /login");
            Exit();
        }
    }

    public function share($id)
    {
        if(isset($_SESSION["userid"])){
            $listl = \mywishlist\models\Liste::where([["no", "=", $id],["user_id", "=", $_SESSION["userid"]]])->get();
            $vue = new \mywishlist\views\VueParticipant($listl->toArray());
            return $vue->shareRender($listl);
        }
        header("Location: /login");
        Exit();
    }


}