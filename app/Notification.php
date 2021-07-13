<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table='notifications';
    public function item(){
        return $this->belongsTo('App/Item','item_id');
    }
}
