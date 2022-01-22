<?php

namespace mywishlist\models;
class Reservation extends \Illuminate\Database\Eloquent\Model
{

    protected $table = 'reservation';
    protected $primaryKey = ['user_id ', 'item_id'];
    public $timestamps = true;


}

?>