<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuktiCustomer extends Model
{
    //
    protected $table='bukti_customers';
    protected $fillable = ['namafile','keterangan','ext'];
    public function payment(){
        return $this->belongsTo('App/ItemCustomer','itemcustomer_id');
    }
}
