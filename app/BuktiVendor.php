<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuktiVendor extends Model
{
    //
    protected $table='bukti_vendors';
    protected $fillable = ['namafile','keterangan','ext'];
    public function shipment(){
        return $this->belongsTo('App/OrderVendor','ordervendor_id');
    }
}
