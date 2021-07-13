<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderVendor extends Model
{
    protected $table= 'ordervendors';
    public function vendor(){
        return $this->belongsTo('App/Vendor','vendor_id');
    }
    public function itemcustomer(){
        return $this->belongsTo('App/ItemCustomer','itemCustomer_id');
    }
    public function notifVendor(){
        return $this->hasOne('App/NotifVendor');
    }
}
