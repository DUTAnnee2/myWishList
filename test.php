<?php
require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as DB;
use mywishlist\models\Liste;

$db = new DB();
$db->addConnection( [
    'driver'    => 'mysql',
    'host'      => '127.0.0.1',
    'database'  => 'aled',
    'username'  => 'root',
    'password'  => 'root',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => ''
] );

$db->setAsGlobal();
$db->bootEloquent();
echo "connecté";
$liste = Liste::all();

var_dump($liste);
//print Item::get();
/**if(isset($_GET["id"]))
{
    print Item::where('id', '=', $_GET["id"]);
}
*/
