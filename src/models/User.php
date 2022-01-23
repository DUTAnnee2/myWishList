<?php

namespace mywishlist\models;

/**
 * Class User
 * @package mywishlist\models
 * @author 1shade
 * @author Eureka
 * @author Azflow
 */
class User extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    public $timestamps = false;
}