<?php

namespace mywishlist\controllers;



class UserController
{
        function connectUser($username,$pwd)
        {

            $elements = new \mywishlist\views\VueLogin();
            if(!isset($_SESSION["userid"])) {
                if (isset($username) && isset($pwd)) {


                    $u = \mywishlist\models\User::where('email', "=", $username)->get()->toArray();
                    if (sizeof($u) == 1) {

                        if ($u[0]["password"] === $pwd) {
                            $_SESSION["userid"] = $u[0]["user_id"];
                            $_SESSION["username"] = $u[0]["username"];
                            $_SESSION["email"] = $u[0]["email"];
                            header("Location: /index.php/participant");
                            Exit();
                        }
                    }
                }
            }
            else
            {
                session_unset();
                return $elements->getRender(2);
            }
            return $elements->getRender(3);
        }

         function getRender()
         {
             $oui = new \mywishlist\views\VueLogin();

             if (isset($_SESSION["userid"])) {
                 session_unset();

                 return $oui->getRender(2);
             }
             return $oui->getRender(1);

         }
}