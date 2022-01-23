<?php

namespace mywishlist\controllers;

use http\Header;
use JetBrains\PhpStorm\NoReturn;
use mywishlist\models\Liste;
use mywishlist\views\VueCreateEditList;

class ListController
{
    function getList(): string
    {
            //display all cards
            $listl = \mywishlist\models\Liste::all();
            $vue = new \mywishlist\views\VueListItem($listl->toArray());
            return $vue->renderLists(1);

    }


    function getListByToken($token)
    {
        $listl = \mywishlist\models\Liste::where("token", "=", $token)->get();
		header("Location: /".$listl[0]["no"]);
		exit();
    }

    /**
     * @param $listeid "id of the list
     * @return void
     */
    #[NoReturn] function deleteListe($listeid)
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

    public function share($id)
    {


        if (isset($_SESSION["userid"])) {
            $listl = \mywishlist\models\Liste::where([["no", "=", $id], ["user_id", "=", $_SESSION["userid"]]])->get();
            $vue = new \mywishlist\views\VueListItem($listl->toArray());
            return $vue->shareRender($listl);
        }
        header("Location: /login");
        Exit();
    }

    public function getListClick($id): string
    {
        $listl = \mywishlist\models\Liste::where("no", "=", $id)->get();
        $vue = new \mywishlist\views\VueListItem($listl->toArray());
        return $vue->renderLists(2);
    }

	public function redirect()
	{
		if(isset($_POST["redirect_id"]))
		{
			header("Location: /".$_POST["redirect_id"]);
			Exit();
		}
	}

}