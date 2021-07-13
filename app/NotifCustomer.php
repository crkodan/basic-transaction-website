<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotifCustomer extends Model
{
    protected $table='notif_customers';
    public function itemcustomer(){
        return $this->belongsTo('App/ItemCustomer','itemcustomer_id');
    }
}
