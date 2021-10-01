<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Shipment;
use App\Bids;
use App\Transaction;

class HomeController extends Controller
{
    //
    public function index() {
        return view('dashboard');
    }

    public function login() {
        return view('login');
    }

    public function count_all(){

        $data['incomplete_jobs'] = Shipment::where('status', 'ACTIVE')->count();
        $data['completed_jobs'] = Shipment::where('status', 'COMPLETED')->count();
        $data['awarded_jobs'] = Shipment::where('status', 'AWARDED')->count();
        $data['expired_jobs'] = Shipment::where('status', 'EXPIRED')->count();
        $data['total_jobs'] = Shipment::all()->count();
        $data['incomplete_bids'] = Bids::where('status', 'ACTIVE')->count();
        $data['completed_bids'] = Bids::where('status', 'COMPLETED')->count();
        $data['awarded_bids'] = Bids::where('status', 'AWARDED')->count();
        $data['expired_bids'] = Bids::where('status', 'EXPIRED')->count();
        $data['total_bids'] = Bids::all()->count();
        $data['total_drivers'] = User::where('type','TRANSPORTER')->count();
        $data['total_client'] = User::where('type','USER')->count();
        $data['total_approveuser'] = User::where('status','APPROVED')->count();
        $data['total_unapproveuser'] = User::where('status','UNAPPROVED')->count();
        $data['total_users'] = User::all()->count();
        $data['transaction']= Transaction::with(['user:id,name,email'])->limit(5)->offset(0)->orderBy('id', 'ASC')->get();
        return $data;
    }
}
