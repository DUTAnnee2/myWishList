<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require 'vendor/autoload.php';


error_reporting(E_ALL ^ E_DEPRECATED);

\mywishlist\database\Eloquent::start(__DIR__.DIRECTORY_SEPARATOR."src".DIRECTORY_SEPARATOR."conf".DIRECTORY_SEPARATOR."conf.ini");

$container = new Slim\Container(['settings' => ['displayErrorDetails' => true]]);
$app = new Slim\App($container);

$app->get('/participant/{type}',
    function (Request $rq, Response $rs, $args):Response {
        $type = intval($args['type']);
        switch ($type)
        {
            case 1:
            case 2:
                $listl = \mywishlist\models\Liste::all() ;
                $vue = new \mywishlist\views\VueParticipant( $listl->toArray() ) ;

                return $rs->write($vue->render( $type ));
            case 3:
                $listl = \mywishlist\models\Item::find(1) ;
                $vue = new \mywishlist\views\VueParticipant( [$listl] ) ;

                return $rs->write($vue->render( 3 ));

        }

        return $rs;
    });

$app->run();