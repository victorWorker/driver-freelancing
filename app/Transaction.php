<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = ['user_id', 'bid_id', 'shipment_id', 'type', 'method', 'payment_details', 'amount', 'status' , 'discount'];

    protected $casts = [
        'payment_details' => 'json'
    ];
    
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
