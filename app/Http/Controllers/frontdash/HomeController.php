<?php

namespace App\Http\Controllers\frontdash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Events\GeneralEvent;
use App\Http\Controllers\MailController;
use App\Bids;
use App\Shipment;
use App\Review;
use App\User;
// use App\Request_for_delivery;

class HomeController extends Controller
{
    //
    public function index() {
       // echo "Here r";die;
        return view('standard.master');
    }

    //
    public function client_registration() {

       // echo "Here";die;
        return view('client_registration');
    }

    public function sendCustomMessage()
    {
        // $curl = curl_init();

        // $headers = ["Content-Type: application/json",
        //         "Accept: application/json",
        //         "Authorization: Bearer 51adGRs5IjBgkgzS9OvDcpJ4nKZZSig0"];

        // $params = ['to' => '7905107964',"bypass_optout" => true,
        //         'message' => "This is test \n   This is a new line",
        //         //'callback_url' => "https://example.com/callback/handler",
        //         'sender_id' => 'SMSto'];

        // curl_setopt_array($curl, array(
        //   CURLOPT_URL => "https://api.sms.to/sms/send",
        //   CURLOPT_RETURNTRANSFER => true,
        //   CURLOPT_ENCODING => "",
        //   CURLOPT_MAXREDIRS => 10,
        //   CURLOPT_TIMEOUT => 0,
        //   CURLOPT_FOLLOWLOCATION => true,
        //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //   CURLOPT_CUSTOMREQUEST => "POST",
        //   CURLOPT_POSTFIELDS => json_encode($params),  
        //   CURLOPT_HTTPHEADER => $headers,
        // ));

        // $response = curl_exec($curl);
        // curl_close($curl);
        // echo $response;
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.sms.to/sms/send?api_key=51adGRs5IjBgkgzS9OvDcpJ4nKZZSig0&to=+917905107964&message=This%20is%20test%20and%20%250A%20this%20is%20a%20new%20line&sender_id=smsto',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        echo "hello";
   }

    public function getTransporterDashData(Request $request) {
         //   echo "Here";die;
        $user = $request->user('sanctum');
        $data = array();
        $data['awarded_bids'] = Bids::with(['transporter:id,name,email', 'shipment:id,title,budget'])
                ->orderBy('updated_at', 'DESC')
                ->where('status', 'AWARDED')
                ->where('driver_id', $user->id)
                ->limit(5)
                ->get();
        $data['reviews'] = Review::with(['shipment:id,title,budget', 'bid:id,amount'])
                           ->orderBy('id', 'DESC')
                           ->where('driver_id', $user->id)
                           ->limit(5)
                           ->get();
        $data['open_count'] = Bids::where('status', 'ACTIVE')->where('driver_id', $user->id)->count();
        $data['completed_count'] = Bids::where('status', 'COMPLETED')->where('driver_id', $user->id)->count();
        $data['expired_count'] = Bids::where('status', 'EXPIRED')->where('driver_id', $user->id)->count();
        $data['total_price'] = Bids::where('driver_id', $user->id)->where('status', 'COMPLETED')->sum('amount');
        return $data;
    }


    function getUserDashData(Request $request) {
        $user = $request->user('sanctum');
        $data = array();
        $data['open_shipments'] = Shipment::where('user_id', $user->id)
                                  ->where('status', 'ACTIVE')
                                  ->limit(5)
                                  ->get();

        $data['awarded_shipments'] = Shipment::with(['awarded:id,name', 'awardedbid:id,amount'])
                                     ->where('user_id', $user->id)
                                     ->where('status', 'AWARDED')
                                     ->limit(5)
                                     ->get();
 
        $data['open_count'] = Shipment::where('status', 'ACTIVE')->where('user_id', $user->id)->count();
        $data['completed_count'] = Shipment::where('status', 'COMPLETED')->where('user_id', $user->id)->count();
        $data['awarded_count'] = Shipment::where('status', 'AWARDED')->where('user_id', $user->id)->count();
        $data['expired_count'] = Shipment::where('status', 'EXPIRED')->where('user_id', $user->id)->count();
        $data['user'] = $user;

        return $data;
    }

    public function uploadDocuments(Request $request) {
        if(strpos($request->doc,'jpg') || strpos($request->doc,'jpeg') || strpos($request->doc,'png') || strpos($request->doc,'mp4')){
            $headers = explode(',',$request->doc);
            $extension = explode('/', $headers[0])[1];
            $extension = explode(';', $extension)[0];
            $actualbase = $headers[1];
            $docname = md5(uniqid('',true)).'.'.$extension;
            Storage::put('public/documents/'.$docname, base64_decode($actualbase));
            return $docname;
        }
    }
    public function uploadProfile(Request $request) {
        if(strpos($request->doc,'jpg') || strpos($request->doc,'jpeg') || strpos($request->doc,'png') || strpos($request->doc,'mp4')){
            $headers = explode(',',$request->doc);
            $extension = explode('/', $headers[0])[1];
            $extension = explode(';', $extension)[0];
            $actualbase = $headers[1];
            $docname = md5(uniqid('',true)).'.'.$extension;
            if(Storage::put('public/documents/'.$docname, base64_decode($actualbase))){ 
            return $docname;
            }
            else{
            
            return "wrong";
            }
        }
    }

    public function addTransporterDocuments(Request $request) {
        $user = $request->user('sanctum');
        $request->validate([
            "frontImage" => 'required',
            "backImage" => 'required',
            "video" => 'required',
        ]);
        $data = array(
            "frontImage" => $request->frontImage,
            "backImage" => $request->backImage,
            "video" => $request->video
        );
        return User::where('id', $user->id)->update([
            'documents' => json_encode($data)
        ]);
    }


      public function updateUserProfile(Request $request) {

        $user = $request->user('sanctum');
        $request->validate([
            'name' => 'required',
            'phone' => 'required'
        ]);
        if($request->password != ''){
            $changes = [
                'name' => $request->name,
                'phone' => $request->phone,
                'about' => $request->about,
                'profileimage' => $request->image,
                'password' => Hash::make($request->password)
            ];
        }else{
            $changes = [
                'name' => $request->name,
                'phone' => $request->phone,
                'about' => $request->about,
                'profileimage' => $request->image,
            ];
        }
        return User::where('id', $user->id)->update($changes);
    }


    

    public function sendEmail(Request $request, MailController $mail) {
        $message = "<b>Name:</b> ".$request->name."<br />";
        $message .= "<b>Email:</b> ".$request->email."<br />";
        $message .= "<b>Query:</b> ".$request->queryText."<br />";
        return $mail->sendMail('info@buscargo.pt', "Help realted query", $message);   
    }


    // public function saverequest(Request $request) {
        
    //    return Request_for_delivery::create([
    //        "transport"=>$request->transport,
    //        "from"=>$request->from,
    //        "to"=>$request->to
    //    ])->id;

    // }

}
