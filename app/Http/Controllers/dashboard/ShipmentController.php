<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Shipment;
use App\Bids;
use App\Review;
use App\DriverReview;
use App\Subject;
use App\Message;
use App\Transaction;
class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Shipment::where('status','ACTIVE')->orderBy('id','desc')->paginate(10);
    }

   public function getExpiredShipments(Request $request) {
       // $user = $request->user('sanctum');
        return Shipment::where('status', 'EXPIRED')
                        ->paginate(10);
    }

    public function uploadImage(Request $request) {
        if(strpos($request->image,'jpg') || strpos($request->image,'jpeg') || strpos($request->image,'png')){
            $headers = explode(',',$request->image);
            $extension = explode('/', $headers[0])[1];
            $extension = explode(';', $extension)[0];
            $actualbase = $headers[1];
            $imagename = md5(uniqid('',true)).'.'.$extension;
            Storage::put('public/shipments/'.$imagename, base64_decode($actualbase));
            return $imagename;
        }
    }



    public function getAllShipments(Request $request) {
       // $user = $request->user('sanctum');
        return Shipment::whereNotIn('status',['EXPIRED','ACTIVE'])->paginate(10);
    }

    public function getBids($id)
    {
        return Shipment::find($id)->bids()->paginate(10);
    }


    public function deleteShipment($id) {
        
         return Shipment::find($id)->delete();
    }


     public function markAsComplete($id) {
        $shipment = Shipment::find($id);
        $shipment->status = "COMPLETED";
        $shipment->save();
          Review::create([
                'driver_id' => $shipment->awarded_to,
                'user_id' => $shipment->user_id,
                'shipment_id' => $id,
                'bid_id' => $shipment->awarded_bid,
                'review' => '',
                'rating' => 0,
                'status' => 'ACTIVE'
            ]);
         DriverReview::create([
                'driver_id' => $shipment->awarded_to,
                'user_id' => $shipment->user_id,
                'shipment_id' => $id,
                'bid_id' => $shipment->awarded_bid,
                'review' => '',
                'rating' => 0,
                'status' => 'ACTIVE'
            ]);
         $bid = Bids::find($shipment->awarded_bid);
         $bid->status = "COMPLETED";
         return $bid->save();
    }
    public function suspendBid($id) {
        $bid = Bids::find($id);
        $bid->status = "SUSPENDED";
        return $bid->save();
    }

    public function activateBid($id) {
        $bid = Bids::find($id);
        $bid->status = "ACTIVE";
        return $bid->save();
    }
    public function updateBid(Request $request) {

       
        $bid = Bids::find($request->id);
        $bid->status = $request->status;
        $bid->proposal = $request->proposal;
        $bid->amount = $request->amount;
        return $bid->save();
    }


    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function getShipment($id) {
        $shipment = Shipment::find($id);
        $bids = $shipment->bids()->limit(6)->get();

        return ['data' => $shipment,'bids' => $bids];
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function addPrices(Request $request){
        $user = $request->user('sanctum');
        if($user->type == 'ROOT'){
            $request->validate([
                'shipment_id' => 'required',
                'competitors' => 'required'
            ]);
            $shipment = Shipment::find($request->shipment_id);
            $shipment->competitors = $request->competitors;
            return $shipment->save();
         }else{
             abort(400, 'Access Denied');
         }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function updateShipment(Request $request, $id)
    {
            $shipment = Shipment::find($id);
            $shipment->description = $request->description;
            $shipment->budget = $request->budget;
            $shipment->save();
    }
     public function updateShipmentexpire(Request $request, $id)
    {
            $shipment = Shipment::find($id);
            $shipment->description = $request->description;
            $shipment->budget = $request->budget;
            $shipment->save();
    }
     public function update(Request $request, $id) {
        
        $shipment = Shipment::find($id);
        $shipment->status = "ACTIVE";
        $shipment->delivery_date = $request->delivery_date;       
        return $shipment->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }


    public function destroy($id)
    {
       
            
       $shipment = Shipment::where('id',$id);
        Message::where('shipment_id',$id)->delete();

        Subject::where('shipment_id',$id)->delete();   
         $da=Bids::where('shipment_id',$id)->get(); 
         if($da->count()){  
         foreach ($da as $key => $ship) {
             Shipment::where('awarded_bid',$ship->id)->delete();
              Transaction::where('bid_id',$ship->id)->delete(); 
          } 
      }
      Bids::where('shipment_id',$id)->delete();   
       DriverReview::where('shipment_id',$id)->delete();  
       Review::where('shipment_id',$id)->delete();  
     
        return $shipment->delete();
    }
}



