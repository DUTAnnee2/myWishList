<?php

namespace mywishlist\models;

/**
 * Class Item
 * @package mywishlist\models
 * @author 1shade
 * @author Eureka
 * @author Azflow
 */
class Item extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'item';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function liste()
    {
        return $this->belongsTo('mywishlist\models\Liste', 'liste_id');
    }

}