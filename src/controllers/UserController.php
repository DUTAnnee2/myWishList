<?php

namespace mywishlist\controllers;

class UserController
{
        function connectUser($username,$pwd)
        {
            $u = \mywishlist\models\User::where('email', "=", $username)->get()->toArray();
            if(sizeof($u) == 1)
            {
                if(password_verify($pwd, $u[0]["password"]))
                {
                    session_start();
                    $SESSION["userid"] = $u[0]["user_id"];
                    $SESSION["username"] = $u[0]["username"];
                    $SESSION["email"] = $u[0]["email"];
                }
            }

        }
}