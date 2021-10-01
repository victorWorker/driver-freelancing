<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image', 'about', 'type', 'phone', 'address', 'country', 'state', 'zip', 'status', 'documents','badge','is_send_sms','profileimage'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'documents' => 'json'
    ];

    public function shipments() {
        return $this->hasMany('App\Shipment', 'user_id');
    }

    public function transactions() {
        return $this->hasMany('App\Transaction', 'user_id');
    }

    public function bids() {
        return $this->hasMany('App\Bids', 'driver_id');
    }
    public function reviews() {
        return $this->hasMany('App\Review', 'driver_id');
    }
    public function listings() {
        return $this->hasMany('App\Shipment');
    }

    public function awardedshipments() {
        return $this->hasMany('App\Shipment', 'awarded_to');
    }

    public function fromMessages() {
        return $this->hasMany('App\Message', 'from_id');
    }
   
    public function toMessages() {
        return $this->hasMany('App\Message', 'to_id');
    }

    public function transporterSubjects() {
        return $this->hasMany('App\Subject', 'driver_id');
    }

    public function userSubjects() {
        return $this->hasMany('App\Subject', 'user_id');
    }
}
