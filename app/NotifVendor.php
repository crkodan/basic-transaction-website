<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotifVendor extends Model
{
    protected $table='notif_vendors';
    public function itemcustomer(){
        return $this->belongsTo('App/OrderVendor','ordervendor_id');
    }
}
