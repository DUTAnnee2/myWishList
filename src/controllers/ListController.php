<?php

namespace mywishlist\controllers;

use http\Header;
use JetBrains\PhpStorm\NoReturn;
use mywishlist\models\Liste;
use mywishlist\views\VueCreateEditList;

/**
 * Class ListController
 * @author 1shade
 * @author Eureka
 * @package mywishlist\controllers
 */
class ListController
{
    /**
     * Get all lists
     * @return string List view
     */
    function getList(): string
    {
        $listl = \mywishlist\models\Liste::all();
        $vue = new \mywishlist\views\VueListItem($listl->toArray());
        return $vue->renderLists(1);
    }


    /**
     * Get a list by his token
     * @param $token string Token of the list
     * @return void Redirect to the list
     */
    #[NoReturn] function getListByToken(string $token): void
    {
        $listl = \mywishlist\models\Liste::where("token", "=", $token)->get();
        header("Location: /" . $listl[0]["no"]);
        exit();
    }

    /**
     * @param $listeid int id of the list
     * @return void Redirect to the list
     */
    #[NoReturn] function deleteListe(int $listeid): void
    {
        if (isset($_SESSION["userid"])) {
            $listl = \mywishlist\models\Liste::where([["no", "=", $listeid], ["user_id", "=", $_SESSION["userid"]]])->delete();

        }
        header("Location: /");
        exit();
    }

    /**
     * Edit a specific list
     * @param $listeid int id of the list
     * @return string|void List view
     */
    function editList(int $listeid)
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
                    "public" => $public,
                    "expiration" => $_POST["expiration"]
                ]);


                header("Location: /");
                exit();
            }
        } else {
            header("Location: /login");
            exit();

        }

    }

    /**
     * Creta a new list
     * @return string List view
     */
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
                $liste->expiration = $_POST["expiration"];
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

    /**
     * Share a list
     * @param $id int id of the list
     * @return string|void
     */
    public function share(int $id)
    {


        if (isset($_SESSION["userid"])) {
            $listl = \mywishlist\models\Liste::where([["no", "=", $id], ["user_id", "=", $_SESSION["userid"]]])->get();
            $vue = new \mywishlist\views\VueListItem($listl->toArray());
            return $vue->shareRender($listl);
        }
        header("Location: /login");
        exit();
    }

    /**
     * Display list items when we click on it
     * @param $id int id of the list
     * @return string|void
     */
    public function getListClick(int $id)
    {

        $listl = \mywishlist\models\Liste::where("no", "=", $id)->get();
        if ($listl["public"] == 1) {
            $vue = new \mywishlist\views\VueListItem($listl->toArray());
            return $vue->renderLists(2);
        } else {
            if (isset($_SESSION["userid"])) {
                if ($_SESSION["userid"] == $listl["user_id"]) {
                    $vue = new \mywishlist\views\VueListItem($listl->toArray());
                    return $vue->renderLists(2);
                }
            }
        }
        header("Location: /login");
        exit();
    }

    /**
     * Redirect to the list
     * @return void Redirect to the list
     */
    public function redirect(): void
    {
        if (isset($_POST["redirect_id"])) {
            header("Location: /" . $_POST["redirect_id"]);
            exit();
        }
    }

}