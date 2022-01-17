<?php

namespace mywishlist\models;
class Message extends \Illuminate\Database\Eloquent\Model
{

    protected $table = 'message_list';
    protected $primaryKey = 'id';
    public $timestamps = true;

    //Messages d'une liste
    public function liste()
    {
        return $this->belongsTo('mywishlist\models\Liste', 'list_id', 'no');
    }

}

?>