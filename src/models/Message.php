<?php

namespace mywishlist\models;

/**
 * Class Message
 * @package mywishlist\models
 * @author 1shade
 * @author Eureka
 * @author Azflow
 */
class Message extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'message';
    protected $primaryKey = 'mess_id';
    public $timestamps = false;
}

