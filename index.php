<?php
session_start();

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';


error_reporting(E_ALL ^ E_DEPRECATED);

\mywishlist\database\Eloquent::start(__DIR__ . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "conf" . DIRECTORY_SEPARATOR . "conf.ini");

$container = new Slim\Container(['settings' => ['displayErrorDetails' => true]]);
$app = new Slim\App($container);






//display a specific item
$app->get('/item/{id}',
    function (Request $rq, Response $rs, $args): Response {
        $controller = new \mywishlist\controllers\ItemController();
        return $rs->write($controller->getItem($args["id"]));
    });
$app->get('/book-item/{id}',
    function (Request $rq, Response $rs, $args): Response {
        $controller = new \mywishlist\controllers\ItemController();
        return $rs->write($controller->reserverItem($args["id"]));
    });
//login
$app->get('/login',
    function (Request $rq, Response $rs, $args): Response {
        $controller = new \mywishlist\controllers\UserController();
        return $rs->write($controller->getLoginRender());
    });

$app->post('/login',
    function (Request $rq, Response $rs, $args): Response {
        $controller = new \mywishlist\controllers\UserController();
        return $rs->write($controller->getLoginRender());
    });

//register
$app->get('/register',
    function (Request $rq, Response $rs, $args): Response {

        $controller = new \mywishlist\controllers\UserController();
        return $rs->write($controller->getRegisterRender());
    });

//
$app->post('/register',
    function (Request $rq, Response $rs, $args): Response {
        $controller = new \mywishlist\controllers\UserController();
        return $rs->write($controller->getRegisterRender());
    });

$app->get('/user',
		function (Request $rq, Response $rs, $args): Response {
			$controller = new \mywishlist\controllers\UserController();
			return $rs->write($controller->getProfile());
			
		});
$app->get('/delete-list/{id}',
    function (Request $rq, Response $rs, $args): Response {
        $controller = new \mywishlist\controllers\ListController();
        $controller->deleteListe($args["id"]);
    });

$app->get('/edit-list/{id}',
    function (Request $rq, Response $rs, $args): Response {
        $controller = new \mywishlist\controllers\ListController();
        return $rs->write($controller->editList($args["id"]));
    });

$app->post('/edit-list/{id}',
    function (Request $rq, Response $rs, $args): Response {
        $controller = new \mywishlist\controllers\ListController();
        return $rs->write($controller->editList($args["id"]));
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
$app->get('/share/{id}',
    function (Request $rq, Response $rs, $args): Response {
        $controller = new \mywishlist\controllers\ListController();
        return $rs->write($controller->share($args["id"]));
    });
	
$app->get('/liste/{token}',
		function (Request $rq, Response $rs, $args): Response {
			$controller = new \mywishlist\controllers\ListController();
			$controller->getListByToken($args["token"]);
			return $rs->write("");
		});

$app->get('/delete-item/{listid}/{id}',
    function (Request $rq, Response $rs, $args): Response {
        $controller = new \mywishlist\controllers\ItemController();
        $controller->deleteItem($args['listid'],$args["id"]);
    });

$app->get('/edit-item/{listid}/{id}',
    function (Request $rq, Response $rs, $args): Response {
        $controller = new \mywishlist\controllers\ItemController();
        return $rs->write($controller->editItem($args['listid'],$args["id"]));
    });

$app->post('/edit-item/{listid}/{id}',
    function (Request $rq, Response $rs, $args): Response {
        $controller = new \mywishlist\controllers\ItemController();
        $controller->saveEditedItem($args['listid'],$args["id"]);
    });

$app->get('/create_item/{listid}',
    function (Request $rq, Response $rs, $args): Response {
        $controller = new \mywishlist\controllers\ItemController();
        return $rs->write($controller->createNewItem());
    });

$app->post('/create_item/{listid}',
    function (Request $rq, Response $rs, $args): Response {
        $controller = new \mywishlist\controllers\ItemController();
        $controller->saveNewItem($args['listid']);
    });
$app->get('/messages/{id}',
    function (Request $rq, Response $rs, $args): Response {
        $controller = new \mywishlist\controllers\MessageController();
        return  $rs->write($controller->getMessages($args["id"]));
    });
$app->post('/messages/{id}',
    function (Request $rq, Response $rs, $args): Response {
        $controller = new \mywishlist\controllers\MessageController();
        return  $rs->write($controller->postMessage($args["id"]));
    });
// Display a list with his ID
	$app->get('/{id}',
		function (Request $rq, Response $rs, $args): Response {
			$controller = new \mywishlist\controllers\ListController();
			return  $rs->write($controller->getListClick($args["id"]));
		});
//root
	$app->get('/',
		function (Request $rq, Response $rs, $args): Response {
			$controller = new \mywishlist\controllers\ListController();
			return $rs->write($controller->getList());
			
		});
	$app->post('/',
		function (Request $rq, Response $rs, $args): Response {
			$controller = new \mywishlist\controllers\ListController();
			$controller->redirect();
			return $rs->write("");
		});

try {
    $app->run();
} catch (Throwable $e) {
    echo $e->getMessage();
}