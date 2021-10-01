<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = ['user_id', 'title', 'description', 'collection', 'delivery', 'pickup_floor', 'pickup_lift', 'delivery_floor', 'delivery_lift', 'geometry', 'distance', 'delivery_date', 'image', 'budget', 'delivery_size', 'status', 'awarded_to', 'awarded_bid', 'category_id', 'actual_details', 'competitors','location_type'];

    protected $casts = ['geometry' => 'json', 'actual_details' => 'json', 'competitors' => 'json'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function bids(){
        return $this->hasMany('App\Bids', 'shipment_id');
    }

    public function review() {
        return $this->hasOne('App\Review', 'shipment_id');
    }
     public function dreview() {
        return $this->hasOne('App\DriverReview', 'shipment_id');
    }
    public function awarded() {
        return $this->belongsTo('App\User', 'awarded_to');
    }

    public function awardedbid() {
        return $this->belongsTo('App\Bids', 'awarded_bid');
    }

    public function messages() {
        return $this->hasMany('App\Message', 'shipment_id');
    }

 // this is the recommended way for declaring event handlers
    public static function boot() {
        parent::boot();
        self::deleting(function($shipment) { 

             $shipment->messages()->each(function($message) {
                $message->delete(); // <-- direct deletion
             });

            

            $shipment->awardedbid()->each(function($awardedbid) {
                $awardedbid->delete(); 
             });
             
            $shipment->awarded()->each(function($awarded) {
                $awarded->delete(); 
             });
              $shipment->review()->each(function($review) {
                $review->delete(); 
             }); 
              $shipment->dreview()->each(function($dreview) {
                $dreview->delete(); 
             }); 
            $shipment->bids()->each(function($bids) {
                $bids->delete(); 
             });
             
             
            $shipment->user()->each(function($user) {
                $user->delete(); 
             });
             
        });
    }




}
