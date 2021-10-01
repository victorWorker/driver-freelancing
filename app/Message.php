<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = ['from_id', 'to_id', 'shipment_id', 'message','subject_id'];

    public function fromUser() {
        return $this->belongsTo('App\User', 'from_id');
    }

    public function toUser() {
        return $this->belongsTo('App\User', 'to_id');
    }

    public function shipment() {
        return $this->belongsTo('App\Shipment', 'shipment_id');
    }
}
