<?php
require_once '../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as DB;
use mywishlist\models\Liste;
use mywishlist\models\Item;

$db = new DB();
$db->addConnection(parse_ini_file("conf/conf.ini"));

$db->setAsGlobal();
$db->bootEloquent();
echo "connecté";
$liste = Liste::all();
var_dump($liste);
//print Item::get();

if(isset($_GET["id"]))
{
    $oui = Item::where("id", "=", $_GET["id"]);
    var_dump($oui);
}

