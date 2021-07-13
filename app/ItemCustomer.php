<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemCustomer extends Model
{
    protected $table='itemcustomers';
    public function customer(){
        return $this->belongsTo('App/Customer','customer_id');
    }
    public function item(){
        return $this->belongsTo('App/Item','item_id');
    }
    public function ordervendor(){
        return $this->hasMany('App/OrderVendor');
    }
    public function payment(){
        return $this->hasMany('App/Payment');
    }
    public function gambar(){
        return $this->hasMany('App/Gambar');
    }
    public function notifCustomer(){
        return $this->hasOne('App/NotifCustomer');
    }
    public function user(){
        return $this->hasOne('App/User');
    }
}
