<?php

namespace App\Http\Controllers\frontdash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\MailController;
use App\Shipment;
use App\Bids;
use App\Review;
use App\DriverReview;
use App\Subject;
use App\Message;
use App\Transaction;
use App\User;

class ShipmentController extends Controller
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
    public function getProjects(Request $request){
        $user = $request->user('sanctum');
        $projects = Shipment::select(['id','title'])->where('awarded_to',$user->id)->get();
        return $projects;
    }

    public function getOpenShipments(Request $request) {
        $user = $request->user('sanctum');
        return Shipment::where('user_id', $user->id)
                        ->where('status', 'ACTIVE')
                        ->paginate(10);
    }




    public function getAwardedShipments(Request $request) {
        $user = $request->user('sanctum');
        return Shipment::with(['awarded:id,name', 'awardedbid:id,amount'])
                        ->where('user_id', $user->id)
                        ->where('status', 'AWARDED')
                       // ->where('status', 'COMPLETED')
                        ->paginate(10);
    }

    public function getExpiredShipments(Request $request) {
        $user = $request->user('sanctum');
        return Shipment::where('user_id', $user->id)
                        ->where('status', 'EXPIRED')
                        ->paginate(10);
    }

    public function getCompletedShipments(Request $request) {
        $user = $request->user('sanctum');
        $data= Shipment::with(['awarded:id,name', 'awardedbid:id,amount','review:id,shipment_id,rating'])
                        ->where('user_id', $user->id)                       
                        ->where('status', 'COMPLETED')
                        ->paginate(10);      
            return $data;             

        
    }

    public function getUserShipment(Request $request, $id) {
        $user = $request->user('sanctum');
        $shipment = Shipment::where('user_id', $user->id)->find($id);
        $bids = $shipment->bids()->with(['transporter:id,name'])->limit(6)->get();
        $awarded = $shipment->awardedbid()->with(['transporter:id,name'])->first();
        $review = $shipment->review()->select('id', 'rating', 'review')->first();

        return ['data' => $shipment,'bids' => $bids, 'awarded' => $awarded, 'review' => $review];
    }

    public function getUserShipmentBids(Request $request, $id) {
        $user = $request->user('sanctum');
        return Shipment::where('user_id', $user->id)->find($id)->bids()->with(['transporter:id,name', 'shipment:id,title,status'])->paginate(10);
    }

    public function getUserShipmentBidData(Request $request, $id) {
        $user = $request->user('sanctum');
        return Bids::where('user_id', $user->id)->find($id);
    }

    public function getCouponCode(Request $request, MailController $mail){
        echo $request->email; 
        $subject = 'O seu código de desconto da Buscargo. Válido por 48 horas.';
        $message = 'Aqui tem o seu código de desconto ! Insira o mesmo na fase de pagamento e aproveite 5% de desconto no seu pedido de transporte.<br> 
            O código tem a duração de 48 horas! <br> Código do cupão: Bus5new';
        
        return $mail->sendMail($request->email, $subject, $message);
       // return $mail->sendMail('raksshalini@gmail.com', $subject, $message);
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
       //  echo  $shipment->awarded_bid;die;
         return $bid->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MailController $mail)
    {
          // echo "<pre>";
          // print_r($request->all());
          // die;

        $user = $request->user('sanctum');
        //
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'collection' => 'required',
            'delivery' => 'required',
            'delivery_date' => 'required',
            'delivery_size' => 'required',
            'budget' => 'required',
            'pickup_floor' => 'required',
            'pickup_lift' => 'required',
            'delivery_floor' => 'required',
            'delivery_lift' => 'required',
            'geometry' => 'required'
        ]);

       
        
        $subject = 'ANÚNCIO PUBLICADO!';
        $message = 'Parabéns, seu anuncio foi publicado com sucesso!<br />
                    Você será notificado em breve quando os motoristas
                    postarem seus orçamentos.<br />
                    Fique atento, pois as licitações tem prazo e podem expirar.
                    Você poderá acompanhar todas as propostas no painel da
                    sua conta e seu anúncio.<br />
                    No caso de alguma dúvida, poderá entrar em contato
                    conosco através de nosso e-mail, telefone ou redes sociais.<br/>
                    Entre agora na sua conta para acompanhar o seu pedido em: www.buscargo.pt ,
                    Após fazer o login, irá logo conseguir observar os seus pedidos.';
        $mail->sendMail($user->email, $subject, $message);

        $shipmentDetails = [
            'user_id' => $user->id,
            'title' => $request->title,
            'image' => $request->image,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'collection' => $request->collection,
            'delivery' => $request->delivery,
            'delivery_date' => $request->delivery_date,
            'delivery_size' => $request->delivery_size,
            'distance' => $request->distance,
            'budget' => $request->budget,
            'pickup_floor' => $request->pickup_floor,
            'pickup_lift' => $request->pickup_lift,
            'delivery_floor' => $request->delivery_floor,
            'delivery_lift' => $request->delivery_lift,
            'location_type' => (isset($request->location_type)) ? $request->location_type : '',
            'geometry' => $request->geometry,
            'status' => 'ACTIVE'
        ];

        $users= User::where('type', 'TRANSPORTER')->where('is_send_sms', 'YES')->get();
        $phone = array();
        $uname=array();
        foreach($users as $u){
            $phone[]="+351".$u->phone;
            $uname[]=$u->name;
        }


       $shipment = Shipment::create($shipmentDetails);

        //send sms  to client ************************
        $job_url='www.buscargo.pt/shipment/'.$shipment->id;
        $sms_message="Temos um novo serviço na plataforma: ".$job_url." \nLicite já!";
        $curl = curl_init();

            $headers = ["Content-Type: application/json",
                    "Accept: application/json",
                    "Authorization: Bearer 51adGRs5IjBgkgzS9OvDcpJ4nKZZSig0"];

            $params = [
                'to' => $phone,
                'bypass_optout' => true,
                'message' => $sms_message,
                'sender_id' => 'SMSBuscargo'];

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.sms.to/sms/send",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => json_encode($params),  
              CURLOPT_HTTPHEADER => $headers,
            ));

        $response = curl_exec($curl);
        curl_close($curl);

        return response()->json(['success'=>true, 'message' => 'Shipment Sucesfully Registered','data'=>$shipment,  'job_url'=>$job_url]);
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

    public function updateActualContact(Request $request, $id) {
        $user = $request->user('sanctum');
        $shipment = Bids::find($id);
        if($shipment->user_id == $user->id){
            $shipment->actual_details = $request->actualDetails;
            return $shipment->save();
        }else{
            abort(400, 'Access Denied');
        }
    }

    
  public function addDriverReview(Request $request) {
        $user = $request->user('sanctum');
       $request->validate([
            'review' => 'required',
            'rating' => 'required'
        ]);
      //     $da=$request->all();
      // print_r($da);die;

      //     $bid_id=$da['awardedbid']['id'];
        
         if(!empty($user->id)){

        $da=DriverReview::where('id',$request->review_id)
              ->update([                
                'review' => $request->review,
                'rating' => $request->rating
                
            ]);
           return  $da;
         }else{
            abort(400, 'Access Denied');
         }


    }


    public function addReview(Request $request) {
        $user = $request->user('sanctum');
        
           $da=$request->all();
          $bid_id=$da['awardedbid']['id'];
          $shipment_id=$da['id'];
         $driver_id=$da['awarded_to'];      
        $request->validate([
            'review' => 'required',
            'rating' => 'required'
        ]);
        if($user->id === $request->user_id && $request->status === 'COMPLETED'){
            $da=Review::where('bid_id',$bid_id)->where('driver_id',$driver_id)
              ->where('shipment_id',$shipment_id) 
              ->update([
                'driver_id' =>  $driver_id,
                'user_id' => $user->id,
                'shipment_id' => $shipment_id,
                'bid_id' => $bid_id,
                'review' => $request->review,
                'rating' => $request->rating,
                'status' => 'ACTIVE'
            ]);
           return  $da;
           
        }
        elseif($user->id === $request->user_id && $request->status === 'AWARDED'){
           // Mark shipment complete
           $da=Review::create([
                'driver_id' =>  $driver_id,
                'user_id' => $user->id,
                'shipment_id' => $shipment_id,
                'bid_id' => $bid_id,
                'review' => $request->review,
                'rating' => $request->rating,
                'status' => 'ACTIVE'
            ]);
            DriverReview::create([
                'driver_id' => $driver_id,
                'user_id' => $user->id,
                'shipment_id' => $shipment_id,
                'bid_id' => $bid_id,
                'review' => '',
                'rating' => 0,
                'status' => 'ACTIVE'
            ]);
            $shipment = Shipment::find($shipment_id);
            $shipment->status = "COMPLETED";
            $shipment->save();

            //Mark Bid complete
            $bid = Bids::find($bid_id);
            $bid->status = "COMPLETED";
            return $bid->save();  
        }
        else{
            abort(400, 'Access Denied');
        }
        
    } 

    public function getGuiaData(Request $request, $id){
        $user = $request->user('sanctum');
        $shipment = Shipment::with(['awarded:id,name,address', 'awardedbid:id,amount', 'user:id,name'])
                            ->where('id', $id)
                            ->where('awarded_to', $user->id)
                            ->where('status', 'AWARDED')
                            ->first();
        if($shipment){
            return $shipment;
        }else{
            abort(400, "Access Denied");
        }
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
            $shipment = Shipment::find($id);
            $shipment->description = $request->description;
            $shipment->budget = $request->budget;
            $shipment->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
     public function destroy($id)
    {
      // echo $id;die;
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
       Review::where('shipment_id',$id)->delete();       
       DriverReview::where('shipment_id',$id)->delete();       
     

        return $shipment->delete();
    }
}
