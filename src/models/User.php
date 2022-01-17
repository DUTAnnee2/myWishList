<?php

namespace mywishlist\models;
class User extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

}