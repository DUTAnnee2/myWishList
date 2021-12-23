<?php

namespace mywishlist\models;
class User extends Illuminate\Database\Eloquent\Model
{
    protected $table = 'account';
    protected $primaryKey = 'id';
    public $timestamps = false;

}
?>