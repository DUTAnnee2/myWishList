<?php

namespace mywishlist\models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Reservation
 * @package mywishlist\models
 * @author 1shade
 * @author Eureka
 * @author Azflow
 */
class Reservation extends Model
{
    public $timestamps = true;
    protected $table = 'reservation';
    protected $primaryKey = ['user_id ', 'item_id'];
}