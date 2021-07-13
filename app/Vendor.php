<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vendors';
    protected $fillable = ['namaVendor','pemilikVendor','brandVendor','alamatVendor','kotaVendor','jenisUsahaVendor','kategoriVendor'];
    public function ordervendor(){
        return $this->hasMany('App/OrderVendor');
    }
    public function itemvendor(){
        return $this->hasMany('App/ItemVendor');
    }
    public function user(){
        return $this->hasOne('App/User');
    }
}
