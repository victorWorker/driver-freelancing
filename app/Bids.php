<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bids extends Model
{
    protected $fillable = [ 'driver_id','user_id','shipment_id','amount','proposal','status','expiration','promoted'];
    public function transporter() {
        return $this->belongsTo('App\User', 'driver_id');
    }

    public function shipment() {
        return $this->belongsTo('App\Shipment', 'shipment_id');
    }
     public function dreview() {
        return $this->hasOne('App\DriverReview', 'bid_id');
    }
    public function review() {
        return $this->hasOne('App\Review', 'bid_id');
    }

    public function awardedshipment() {
        return $this->hasMany('App\Shipment', 'awarded_bid');
    }
}
