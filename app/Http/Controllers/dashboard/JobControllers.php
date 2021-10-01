<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Shipment;
use App\Bids;
class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Shipment::orderBy('id','desc')->paginate(10);
    }

    public function getBids($id)
    {
        return Shipment::find($id)->bids()->paginate(10);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
