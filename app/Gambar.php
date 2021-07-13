<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    protected $table = "payments";

    protected $fillable = ['namafile','ext'];
    
    public function itemcustomer(){
        return $this->belongsTo('App/ItemCustomer','itemcustomer_id');
    }
}