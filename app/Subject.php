<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    protected $fillable = ['user_id', 'driver_id', 'shipment_id', 'title', 'addedd_by'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function transporter() {
        return $this->belongsTo('App\User', 'driver_id');
    }
}
