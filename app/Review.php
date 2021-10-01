<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //

    protected $fillable = ['driver_id', 'user_id', 'shipment_id', 'bid_id', 'review', 'rating', 'status'];

    public function shipment() {
        return $this->belongsTo('App\Shipment', 'shipment_id');
    }

    public function bid() {
        return $this->belongsTo('App\Bids', 'bid_id');
    }
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
