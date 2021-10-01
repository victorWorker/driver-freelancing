<?php

namespace App\Http\Controllers\frontdash;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use Illuminate\Http\Request;
use App\Bids;
use App\Shipment;
use App\DriverReview;


class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getOuBids(Request $request) {
        $user = $request->user('sanctum');
        $bids = Bids::with(['transporter:id,name,email', 'shipment:id,title,budget'])

                    ->orderBy('id', 'DESC')
                    ->where('status', 'ACTIVE')
                    ->where('driver_id', $user->id)
                    ->paginate(10);
         foreach ($bids as  $value) {
                        $minprice=Bids::where('shipment_id',$value->shipment_id)->min('amount');
                        $value->minprice=$minprice;
                        $value->login_id=$user->id;
                        $d2=Bids::where(['shipment_id'=>$value->shipment_id,'amount'=>$minprice])->first();
                        $value->mindriver_id=$d2->driver_id;

                    }           

        return $bids;
    }

public function getLowerAmount($shipment_id)
{
    return Bids::where('shipment_id',$shipment_id)->min('amount');
}

public function get_bid_by_shipment_id($shipment_id)
{
    return Shipment::where('id',$shipment_id)->get();
}


    public function get_bid_data($id)
    {
    //print_r($request->all());die;
        $data = Bids::find($id);
         //$bonus=($data->amount*20)/100;
         //$data->amount= $bonus+$data->amount;
         return $data;

     
    }


public function get_all_bid($id)
{
   return Bids::where('shipment_id',1)->get();
}




public function getOpenBids(Request $request) {
        $user = $request->user('sanctum');
        $bids = Bids::with(['transporter:id,name,email', 'shipment:id,title,budget'])
                    ->orderBy('id', 'DESC')
                    ->where('status', 'ACTIVE')
                    ->where('driver_id', $user->id)
                    ->paginate(10);
        return $bids;
    }

    public function getAwardedBids(Request $request) {
        $user = $request->user('sanctum');
        $bids = Bids::with(['transporter:id,name,email', 'shipment:id,title,budget'])
                    ->orderBy('id', 'DESC')
                    ->where('status', 'AWARDED')
                    ->where('driver_id', $user->id)
                    ->paginate(10);
        return $bids;
    }

    public function getExpiredBids(Request $request) {
        $user = $request->user('sanctum');
        $bids = Bids::with(['transporter:id,name,email', 'shipment:id,title,budget'])
                    ->orderBy('id', 'DESC')
                    ->where('status', 'EXPIRED')
                    ->where('driver_id', $user->id)
                    ->paginate(10);
        return $bids;
    }

    public function getCompletedBids(Request $request) {
        $user = $request->user('sanctum');
        $bids = Bids::with(['transporter:id,name,email', 'shipment:id,title,budget', 'dreview:id,bid_id,rating'])
                    ->orderBy('id', 'DESC')
                    ->where('status', 'COMPLETED')
                    ->where('driver_id', $user->id)
                    ->paginate(10);
      // echo "<pre>";
      // print_r($bids);
    //   die;
 // $bids = Bids::join('bids','bids.driver_id','=','users.id')
 //                    ->join('shipments','shipments.id','=','bids.shipment_id')
 //                    ->leftJoin('driver_reviews','driver_reviews.bid_id','=','bids.id')
 //                     ->select('bids.*','shipments.title','shipments.budget','users.name','users.email','driver_reviews.bid_id','driver_reviews.rating','driver_reviews.review')
 //                    ->orderBy('bids.id', 'DESC')
 //                    ->where('bids.status', 'COMPLETED')
 //                    ->where('bids.driver_id', $user->id)
 //                    ->paginate(10);
                    

        return $bids;
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //


        $request->validate([
            'proposal' => 'required',
            'amount' => 'required',
            'expiration' => 'required'
        ]);
        $bid = Bids::find($id);
        $bid->proposal = $request->proposal;
        $bid->amount = $request->amount;
        $bid->expiration = $request->expiration;
        return $bid->save();
    } 



    public function updatebid(Request $request, $id)
    {
        //
     //echo $id;die;
       // print_r( $request->all());die;

        $request->validate([
            'proposal' => 'required',
            'amount' => 'required',
            'expiration' => 'required'
        ]);
        $bid = Bids::find($id);

       // print_r($bid);die;
        $bid->proposal = $request->proposal;
        $bid->amount = $request->amount;
        $bid->expiration = $request->expiration;
        return $bid->save();
    }


  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $user = $request->user();
        return Bids::where('id', $id)->delete();
    }

}
