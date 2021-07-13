<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table='items';
    protected $fillable = ['jenisItem','stockjumlah','tipeitem','hargabeli','hargajual','catatan','satuan','jumlahminimal'];
    public function item(){
        return $this->hasMany('App/Warehouse');
    }
    public function itemvendor(){
        return $this->hasMany('App/ItemVendor');
    }
    public function itemcustomer(){
        return $this->hasMany('App/ItemCustomer');
    }
    public function notification(){
        return $this->hasOne('App/Notification');
    }
}
