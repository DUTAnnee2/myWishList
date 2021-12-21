<?php

namespace mywishlist\database;

use Illuminate\Database\Capsule\Manager as Capsule;

class Eloquent
{
    public static function start($file)
    {
        $capsule = new Capsule;
        $capsule->addConnection(parse_ini_file($file));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}