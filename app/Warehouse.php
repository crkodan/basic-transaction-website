<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouses';
    public function item(){
        return $this->belongsTo('App/Item','item_id');
    }
}
