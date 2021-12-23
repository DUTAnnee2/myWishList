<?php

namespace mywishlist\models;
class user extends Illuminate\Database\Eloquent\Model
{
    protected $table = 'account';
    protected $primaryKey = 'id';
    public $timestamps = false;

}
?>