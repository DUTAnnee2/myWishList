<?php

namespace mywishlist\controllers;

class UserController
{
        function connectUser($username,$pwd)
        {
            if(isset($username) && isset($pwd)) {


                $u = \mywishlist\models\User::where('email', "=", $username)->get()->toArray();
                if (sizeof($u) == 1) {

                    if ($u[0]["password"] === $pwd) {
                        $SESSION["userid"] = $u[0]["user_id"];
                        $SESSION["username"] = $u[0]["username"];
                        $SESSION["email"] = $u[0]["email"];
                        return "oui";
                    }
                }
            }
            return "non";
        }
}