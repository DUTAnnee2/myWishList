<?php

namespace mywishlist\controllers;

use http\Header;
use mywishlist\models\Liste;
use mywishlist\views\VueCreateEditList;

class ListController
{
    function getList(): string
    {
        if (!isset($_GET['id'])) {
            //display all cards
            $listl = \mywishlist\models\Liste::all();
            $vue = new \mywishlist\views\VueParticipant($listl->toArray());
            return $vue->render(1);
        } else {
            $id = $_GET['id'];
            $listl = \mywishlist\models\Liste::where("no", "=", $id)->get();
            $vue = new \mywishlist\views\VueParticipant($listl->toArray());
            return $vue->render(2);
        }
    }

    function getListByToken($token): string
    {
        $listl = \mywishlist\models\Liste::where("token", "=", $token)->get();
        $vue = new \mywishlist\views\VueParticipant($listl->toArray());
        return $vue->render(2);
    }

    function deleteListe($listeid)
    {
        if (isset($_SESSION["userid"])) {
            $listl = \mywishlist\models\Liste::where([["no", "=", $listeid], ["user_id", "=", $_SESSION["userid"]]])->delete();

        }
        header("Location: /");
        exit();
    }

    function editList($listeid)
    {
        if (isset($_SESSION["userid"])) {


            if (!isset($_POST["titre"])) {
                $listl = \mywishlist\models\Liste::where("no", "=", $listeid)->get()->toArray();
                $vue = new VueCreateEditList();
                return $vue->renderModifyList($listl);

            } else {
                $public = 0;
                if (isset($_POST["public"])) {
                    $public = 1;
                }
                $listl = \mywishlist\models\Liste::where([["no", "=", $listeid], ["user_id", "=", $_SESSION["userid"]]])->update([
                    "titre" => $_POST["titre"],
                    "description" => $_POST["description"],
                    "public" => $public
                ]);


                header("Location: /");
                exit();
            }
        } else {
            header("Location: /login");
            exit();

        }

    }

    public function createList(): string
    {
        if (isset($_SESSION["userid"])) {
            if (!isset($_POST["titre"])) {
                $vue = new \mywishlist\views\VueCreateEditList();
                return $vue->renderCreateList();

            } else {
                $public = 0;
                if (isset($_POST["public"])) {
                    $public = 1;
                }
                //Genere token
                $ne = \mywishlist\models\Liste::count() + 1;
                $token = hash("ripemd128", $ne . "" . rand());
                $liste = new Liste();
                $liste->user_id = $_SESSION["userid"];
                $liste->titre = $_POST["titre"];
                $liste->description = $_POST["description"];
                $liste->token = $token;
                $liste->public = $public;

                $liste->save();
                header("Location: /");
                exit();
            }
        } else {
            header("Location: /login");
            exit();
        }
    }

    public function share($id)
    {
        if (isset($_SESSION["userid"])) {
            $listl = \mywishlist\models\Liste::where([["no", "=", $id], ["user_id", "=", $_SESSION["userid"]]])->get();
            $vue = new \mywishlist\views\VueParticipant($listl->toArray());
            return $vue->shareRender($listl);
        }
        header("Location: /login");
        exit();
    }


}