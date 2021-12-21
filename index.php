<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require 'vendor/autoload.php';

\mywishlist\database\Eloquent::start(__DIR__.DIRECTORY_SEPARATOR."src".DIRECTORY_SEPARATOR."conf".DIRECTORY_SEPARATOR."conf.ini");

$container = new Slim\Container(['settings' => ['displayErrorDetails' => true]]);
$app = new Slim\App($container);

$app->get('/listes',
    function (Request $rq, Response $rs, $args):Response {
        $controller = new mywishlist\controllers\ListController();
        return $controller->displayAll($rq, $rs, $args);
    }
);

$app->get('/listes/{id}',
    function (Request $rq, Response $rs, $args):Response {
        $controller = new mywishlist\controllers\ListController();
        return $controller->displayById($rq, $rs, $args);
    }
);

$app->get('/items/{id}}',
    function (Request $rq, Response $rs, $args):Response {
        return $rs;
    }
);

$app->run();
?>