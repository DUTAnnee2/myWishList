<?php

namespace mywishlist\models;

/**
 * Class Liste
 * @package mywishlist\models
 * @author 1shade
 * @author Eureka
 * @author Azflow
 */
class Liste extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'liste';
    protected $primaryKey = 'no';
    public $timestamps = false;

    public function items()
    {
        return $this->hasMany('mywishlist\models\Item', 'id');
    }
}

?>