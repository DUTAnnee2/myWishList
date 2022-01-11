<?php

namespace mywishlist\controllers;





class UserController
{
    //Login the user or display the form
        function getLoginRender() : string
        {

            $elements = new \mywishlist\views\VueLogin();

            if(isset($_SESSION["userid"])) {
                session_unset();
                return $elements->getRender(2);
            }
            if (isset($_POST["login"]) && isset($_POST["pwd"])) {



                    $username = $_POST["login"];
                    $pwd = $_POST["pwd"];
                    $u = \mywishlist\models\User::where('email', "=", $username)->get()->toArray();
                    if (sizeof($u) == 1) {

                        if (password_verify($pwd, $u[0]["password"])) {
                            $_SESSION["userid"] = $u[0]["user_id"];
                            $_SESSION["username"] = $u[0]["username"];
                            $_SESSION["email"] = $u[0]["email"];
                            header("Location: /index.php/participant");
                            Exit();
                        }
                    }


            }
            else
            {
                return $elements->getRender(1);
            }

            return $elements->getRender(3);
        }


        //Register user
         function getRegisterRender() : string
         {

             $elements = new \mywishlist\views\VueRegister();

             if(isset($_SESSION["userid"])) {
                 session_unset();
                 return $elements->getRender(2, "Vous avez été déconnecté");
             }

             if(isset($_POST["login"]) && isset($_POST["email"]) && isset($_POST["pwd"]) && isset($_POST["pwd_c"])) {

                 $login = $_POST["login"];
                 $email = $_POST["email"];
                 $pwd = $_POST["pwd"];
                 $pwd_c = $_POST["pwd_c"];
                 $u = \mywishlist\models\User::where('username', "=", $login)->get()->toArray();
                 $u1 = \mywishlist\models\User::where('email', "=", $email)->get()->toArray();

                 if (sizeof($u) === 0 && sizeof($u1) === 0) {


                     if (strlen(str_replace(" ", "", $login)) >= 5 && strlen(str_replace(" ", "", $email)) >= 10 && strlen(str_replace(" ", "", $pwd)) > 5) {
                         if ($pwd_c === $pwd) {
                             $user = new \mywishlist\models\User();
                             $id = \mywishlist\models\User::count() + 1;
                             $user->user_id = $id;
                             $user->username = $login;
                             $user->email = $email;
                             $user->password = password_hash($pwd, PASSWORD_DEFAULT);
                             $user->save();
                             return $elements->getRender(3);
                         } else {
                             return $elements->getRender(2, "Les mots de passes ne sont pas identiques");
                         }
                     } else {
                         return $elements->getRender(2, "Un des champs est trop court");
                     }
                 } else {
                     return $elements->getRender(2, "Nom d'utilisateur/ email déjà pris");

                 }
             }

             return $elements->getRender(1);
         }


}