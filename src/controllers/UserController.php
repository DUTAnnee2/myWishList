<?php

namespace mywishlist\controllers;

/**
 * Class UserController
 * @package mywishlist\controllers
 * @author 1shade
 * @author Eureka
 */
class UserController
{
    /**
     * Get the login form
     * @return string The login form
     */
    function getLoginRender(): string
    {

        $elements = new \mywishlist\views\VueLogin();

        if (isset($_SESSION["userid"])) {
            session_unset();
            return $elements->getLoginRender(2);
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
                    header("Location: /");
                    exit();
                }
            }


        } else {
            return $elements->getLoginRender(1);
        }

        return $elements->getLoginRender(3);
    }


    /**
     * Get the register form
     * @return string The register form
     */
    function getRegisterRender(): string
    {

        $elements = new \mywishlist\views\VueRegister();

        if (isset($_SESSION["userid"])) {
            session_unset();
            return $elements->getRender(2, "Vous avez été déconnecté");
        }

        if (isset($_POST["login"]) && isset($_POST["email"]) && isset($_POST["pwd"]) && isset($_POST["pwd_c"])) {

            $login = $_POST["login"];
            $email = $_POST["email"];
            $pwd = $_POST["pwd"];
            $pwd_c = $_POST["pwd_c"];
            $u = \mywishlist\models\User::where('username', "=", $login)->get()->toArray();
            $u1 = \mywishlist\models\User::where('email', "=", $email)->get()->toArray();

            if (sizeof($u) === 0 && sizeof($u1) === 0) {

                if (strlen(str_replace(" ", "", $login)) >= 5 && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen(str_replace(" ", "", $pwd)) > 5) {
                    if ($pwd_c === $pwd) {
                        $user = new \mywishlist\models\User();
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

    /**
     * Get the user profile
     * @return string The profile view
     */
    function getProfile(): string
    {
        if (isset($_SESSION["userid"])) {
            $vue = new \mywishlist\views\VueProfile();

            return $vue->render();
        }
        header("Location: /login");
        exit();
    }

}