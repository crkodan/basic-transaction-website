<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemVendor extends Model
{
    protected $table = 'itemvendors';
    protected $fillable = ['vendor_id','item_id'];
    public function item(){
        return $this->belongsTo('App/Item','item_id');
    }
    public function vendor(){
        return $this->belongsTo('App/Vendor','vendor_id');
    }
}
