<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
     protected $fillable = ['user_id', 'title', 'description', 'collection', 'delivery', 'pickup_floor', 'pickup_lift', 'delivery_floor', 'delivery_lift', 'geometry', 'distance', 'delivery_date', 'image', 'budget', 'delivery_size', 'status', 'awarded_to', 'awarded_bid', 'category_id', 'actual_details', 'competitors'];

    protected $casts = ['geometry' => 'json', 'actual_details' => 'json', 'competitors' => 'json'];

}
