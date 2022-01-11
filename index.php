<?php
session_start();

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';


error_reporting(E_ALL ^ E_DEPRECATED);

\mywishlist\database\Eloquent::start(__DIR__ . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "conf" . DIRECTORY_SEPARATOR . "conf.ini");

$container = new Slim\Container(['settings' => ['displayErrorDetails' => true]]);
$app = new Slim\App($container);

$app->get('/participant',
    function (Request $rq, Response $rs, $args): Response {
        $oui = new \mywishlist\controllers\ListController();


        return $rs->write($oui->getList());

    });

// Display a list with his ID
$app->post('/participant',
    function (Request $rq, Response $rs, $args): Response {
        $oui = new \mywishlist\controllers\ListController();

        return  $rs->write($oui->getList());
    });


//display a specific item
$app->get('/participant/item/{id}',
    function (Request $rq, Response $rs, $args): Response {


        $oui = new \mywishlist\controllers\ListController();

        return $rs->write($oui->getItem($args["id"]));
    });


$app->get('/login',
    function (Request $rq, Response $rs, $args): Response {

        $oui = new \mywishlist\controllers\UserController();


        return $rs->write($oui->getLoginRender());
    });

$app->post('/login',
    function (Request $rq, Response $rs, $args): Response {

        $oui = new \mywishlist\controllers\UserController();


        return $rs->write($oui->getLoginRender());
    });


$app->get('/register',
    function (Request $rq, Response $rs, $args): Response {

        $oui = new \mywishlist\controllers\UserController();


        return $rs->write($oui->getRegisterRender());
    });

//
$app->post('/register',
    function (Request $rq, Response $rs, $args): Response {

        $oui = new \mywishlist\controllers\UserController();


        return $rs->write($oui->getRegisterRender());
    });

$app->get('/delete-list/{id}',
    function (Request $rq, Response $rs, $args): Response {

        $oui = new \mywishlist\controllers\ListController();
        $oui->deleteListe($args["id"]);

        return $rs->write("");
    });

$app->get('/edit-list/{id}',
    function (Request $rq, Response $rs, $args): Response {

        $oui = new \mywishlist\controllers\ListController();


        return $rs->write($oui->editList($args["id"]));
    });

$app->post('/edit-list/{id}',
    function (Request $rq, Response $rs, $args): Response {

        $oui = new \mywishlist\controllers\ListController();


        return $rs->write($oui->editList($args["id"]));
    });

$app->get('/create-list',
    function (Request $rq, Response $rs, $args): Response {

        $controller = new \mywishlist\controllers\ListController();
        return $rs->write($controller->createList());
    });

$app->post('/create-list',
    function (Request $rq, Response $rs, $args): Response {

        $controller = new \mywishlist\controllers\ListController();
        return $rs->write($controller->createList());
    });
$app->run();