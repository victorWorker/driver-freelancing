<?php

namespace App\Http\Controllers\userfront;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Shipment;

class UserController extends Controller
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
    public function getTransporter($id){
        $data = array();
        $data['user'] = User::find($id);
       
        $data['incomplete_jobs'] = Shipment::where('status', 'ACTIVE')->where('awarded_to', $id)->count();
        $data['completed_jobs'] = Shipment::where('status', 'COMPLETED')->where('awarded_to', $id)->count();
        $data['awarded_count'] = Shipment::where('status', 'AWARDED')->where('awarded_to', $id)->count();
        $data['expired_count'] = Shipment::where('status', 'EXPIRED')->where('awarded_to', $id)->count();
        $data['reviews'] = User::find($id)->reviews()->with(['user:id,name,profileimage,email'])->get();
        
        //calculate rating
        $ratingcount = User::find($id)->reviews->count() * 5;
        if($ratingcount !== 0){
            $receivedrating = User::find($id)->reviews->sum('rating');
            $data['rating'] = ($receivedrating * 5) / $ratingcount;
        }else{
            $data['rating'] = 0;
        }
        if($ratingcount !== 0){
            $negativecount = User::find($id)->reviews->count() * 5;
            $receivednegativerating = $negativecount - User::find($id)->reviews->sum('rating');
            $data['negativerating'] = ($receivednegativerating * 5) / $negativecount;
        }else{
            $data['negativerating'] = 0;
        }

        
        return $data;
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
