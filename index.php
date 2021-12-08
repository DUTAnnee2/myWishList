<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require 'vendor/autoload.php';

$app = new \Slim\App;


$app->get('/listes',
    function (Request $rq, Response $rs, $args):Response {
        $name = $args['name'];
        $rs->getBody()->write("Hello, $name");
        return $rs;
    }
);

$app->get('/listes/{id}',
    function (Request $rq, Response $rs, $args):Response {
        $id = $args['name'];
        $rs->getBody()->write("Hello, $id");
        return $rs;
    }
);

$app->get('/items/{id}}',
    function (Request $rq, Response $rs, $args):Response {
        $id = $args['name'];
        $rs->getBody()->write("Hello, $id");
        return $rs;
    }
);

$app->run();
