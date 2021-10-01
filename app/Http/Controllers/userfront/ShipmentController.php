<?php

namespace App\Http\Controllers\userfront;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateShipment;
use Illuminate\Http\Request;
use App\Shipment;
use App\Category;
use App\Vehicle;
use App\Bids;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Hash;
use App\User;
use Carbon\Carbon;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipments= Shipment::where('status', 'ACTIVE')->orderBy('id','desc')->paginate(25);
         foreach($shipments as $key => $shipment){
            $bidcount = Bids::where('shipment_id',$shipment->id)->count();
            $shipment['bidcount'] = $bidcount;
        }
        return $shipments;
    }
    public function total_bids($id)
    {
        return Bids::where('shipment_id',$id)->count();
    }
    public function getCategories(){
        return Category::get();
    }

    public function getVehicles(){
        return Vehicle::get();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }
    public function search(Request $request){

      // echo "<pre>";
      //  print_r($request->filters['category_id']);

      // die;
        $query = Shipment::where('status', 'ACTIVE')
                       ->where('collection',$request->form['collection'])
                       ->where('delivery',$request->form['delivery']);  
               if(!empty($request->filters['category_id'])) {
                   $query->whereIn('category_id',$request->filters['category_id']);
                }  
                if(!empty($request->filters['delivery_size'])) {
                   $query->whereIn('delivery_size',$request->filters['delivery_size']);
                } 
                 if(!empty($request->filters['location'])) {
                   $query->whereIn('location_type',$request->filters['location']);
                } 
        $shipments= $query->orderBy('id','desc')->paginate(1);
            foreach($shipments as $key => $shipment){
            $bidcount = Bids::where('shipment_id',$shipment->id)->count();
            $shipment['bidcount'] = $bidcount;
            }
        return $shipments;
       
        
    }

    public function submitBid(Request $request, MailController $mail){
                  
        $transporter = $request->user('sanctum');
        $shipment = Shipment::find($request->sid);
        $check = Bids::where('driver_id',$transporter->id)->where('shipment_id',$shipment->id)->count();
        if($check >= 1){
            // abort('402','Multiple Bid Attempt-'.$transporter->id);
            abort('402','Multiple Bid Attempt');
        }else{
            if($transporter->type == 'TRANSPORTER'){

                //send sms  to client ************************

                $phone = array();
                $phone = "+351".$shipment->user->phone;
                $sms_message="Olá! \nRecebeu uma licitação no seu serviço! \nFaça o login em www.buscargo.pt , converse com o motorista e aceite a licitação com 5% de desconto. \nAté já!";
                    
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

            $subject2 = 'Um motorista superou a sua licitacão';
            $message2 = 'Caro motorista,<br /><br />
            A sua licitação num serviço foi superada por outro motorista.<br />
            Faça o login no nosso site para editar a sua licitação e ficar com o trabalho: www.buscargo.pt';


            $dvrs = Bids::where('shipment_id',$shipment->id)->where('amount','<',$request->amount)->get();
               
                if($dvrs->count()>0){
                   foreach ($dvrs as  $da) {
                    $driver_id=$da->driver_id;
                    $user1=User::find($driver_id);
                    $mail->sendMail($user1->email, $subject2, $message2);
                    }
                }       
               

            $bidDetails = [
                "driver_id" => $transporter->id,
                "user_id" => $shipment->user_id,
                "shipment_id" => $request->sid,
                "amount" => $request->amount,
                "proposal" => $request->proposal,
                "status" => "ACTIVE",
                "expiration" => $request->expiry
            ];

        
            $bids = Bids::create($bidDetails);
            $message_client_amount=$request->amount+(($request->amount*20)/100);
            $message_client_afterbid_received= '
            <p><b>Olá outra vez!<br>O seu pedido na www.buscargo.pt já teve um orçamento!
            </b></p>

            <p><p style="width:20%;float:left;"><img src="https://www.buscargo.pt/dashboard/assets/images/faces/face8.jpg" width="60px" style="border-radius:50%;"></p><p style="width:80%;float:right;"><b>'.$shipment->title.'</b><br><b style="background:green;padding:5px;color:white;font-size:10px;">'.$shipment->status.'</b> &nbsp;&nbsp;valor de licitação: €'.$message_client_amount.'</p></p>

            <p style="width:100%;">
            <button type="button" style="background:orange;color:white;padding:10px;">
            <a href="https://www.buscargo.pt/user/dashboard/messages" style="text-decoration:none;color:white">Enviar mensagem ao motorista</a></button>&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="button" style="background:green;color:white;padding:10px;">
            <a href="https://www.buscargo.pt/user/dashboard/bid/award/'.$bids->id.'" style="text-decoration:none;color:white">Aceitar orçamento</a></button>
            </p>

            <p>Entre na sua conta, observe se o valor é compatível e reserve logo essa licitação pagando 20% do valor.</p>
            <p>Mediaremos o transporte e garantiremos que sua experiência com nossa plataforma seja incrível.</p>
            <p>No caso de alguma dúvida, poderá entrar em contato através de nosso e-mail, telefone ou redes sociais.</p>
            <p>Obrigado e até já,</p><p> Equipa Buscargo.</p>';
            $mail->sendMailtwo($shipment->user->email, 'Recebeu um orçamento para o seu pedido!', $message_client_afterbid_received);
            return $bids;

            }else{
                abort(400, 'Access Denied');
            }
        }        
    }

public function shipment(Request $request, MailController $mail){
    //dd($request->all());
    //$locale = App::currentLocale();

    if(isset($request->shipid) && $request->shipid != ''){
        $reqUsrId = $request->userid;
        $shipid = $request->shipid;


        $subject = 'ANÚNCIO PUBLICADO!';
        $message = 'Parabéns, seu anuncio foi publicado com sucesso!<br />
                    Você será notificado em breve quando os motoristas
                    postarem seus orçamentos.<br />
                    Fique atento, pois as licitações tem prazo e podem expirar.
                    Você poderá acompanhar todas as propostas no painel da
                    sua conta e seu anúncio.<br />
                    No caso de alguma dúvida, poderá entrar em contato
                    conosco através de nosso e-mail, telefone ou redes sociais.';
        //$mail->sendMail($request->email, $subject, $message);
        $user= User::find($reqUsrId);
        $user->name = ($request->name) ? $request->name : '';
        $user->email = ($request->email) ? $request->email : '';
        $user->phone = ($request->phone) ? $request->phone : '';
        $user->password = ($request->password) ? Hash::make($request->password) : '';
        $user->address = ($request->address) ? $request->address : '';
        $user->type = "USER";
        $user->state = ($request->state) ? $request->state : '';
        $user->country = ($request->country) ? $request->country : '';
        $user->zip = ($request->zip) ? $request->zip : '';
        $user->save();

        $user_id = $user->id;

       // $shipmentImage = '';
        //if ($image = $request->file('image')) {
           // $destinationPath = '/var/www/buscargo.pt/data/www/buscargo.pt/public/shipments/';
           // $shipmentImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            //$image->move($destinationPath, $shipmentImage);            
        //}


        $shipmentDetails = [
            'user_id' => $user_id,
            'collection' => ($request->collection) ? $request->collection : '',
            'delivery' => ($request->delivery) ? $request->delivery : '',
            'title' => ($request->title) ? $request->title : '',
            'description' => ($request->description) ? $request->description : '0',
            'pickup_floor' => ($request->pickup_floor) ? $request->pickup_floor : '0',
            'pickup_lift' => ($request->pickup_lift) ? $request->pickup_lift : '0',
            'delivery_floor' => ($request->delivery_floor) ? $request->delivery_floor : '0',
            'delivery_lift' => ($request->delivery_lift) ? $request->delivery_lift : '0',
            'delivery_date' => ($request->delivery_date) ? $request->delivery_date : '2021-06-09 08:54:51',
            'budget' => ($request->budget) ? $request->budget : '0',
            'geometry' => '',
            'distance' => ($request->distance) ? $request->distance : '0',
            'image' => ($request->image) ? $request->image : '',
            'status' => 'ACTIVE',
            'category_id' => ($request->category) ? $request->category : '',
            'delivery_size' => ($request->delivery_size) ? $request->delivery_size : '0',
            'created_at' => now()
        ];

        // $shipment = Shipment::create($shipmentDetails);
        $cdate = now();
        

        $ship= Shipment::find($shipid);

        $ship->user_id = $user_id;
        $ship->collection = ($request->collection) ? $request->collection : '';
        $ship->delivery = ($request->delivery) ? $request->delivery : '';
        $ship->title = ($request->title) ? $request->title : '';
        $ship->description = ($request->description) ? $request->description : ' ';
        $ship->pickup_floor = ($request->pickup_floor) ? $request->pickup_floor : '0';
        $ship->pickup_lift = ($request->pickup_lift) ? $request->pickup_lift : '0';
        $ship->delivery_floor = ($request->delivery_floor) ? $request->delivery_floor : '0';
        $ship->delivery_lift = ($request->delivery_lift) ? $request->delivery_lift : '0';
        $ship->delivery_date = ($request->delivery_date) ? $request->delivery_date : $cdate;
        $ship->budget = ($request->budget) ? $request->budget : '0';
        $ship->geometry = '';
        $ship->distance = '';
        $ship->image = ($shipmentImage) ? $shipmentImage : '';
        $ship->status = 'ACTIVE';
        $ship->category_id = ($request->category) ? $request->category : '';
        $ship->delivery_size = ($request->delivery_size) ? $request->delivery_size : '0';
        $ship->created_at = $cdate;

        $ship->save();

        
         $message = 'Thank you for registering with us, Please <a href="https://buscargo.pt/" target="_self">click here</a> to login';

       return response()->json(['success'=>true, 'message' => 'Shipment Sucesfully Register1','data'=>$ship]);

    }else{

        $password = ($request->password) ? Hash::make($request->password) : '';
        $cdate = now();
        $dlvDate = date('Y-m-d', strtotime($cdate. ' + 25 days'));
        



        $usr = User::where('email', $request->email)->first();
        if($usr){
            $user_id = $usr->id;
            $pass = Hash::make($request->password);
            User::where('email', $request->email)->update(array('password' => $pass));
            $actn = 'update';
        }else{

            $user = new User();
            $user->name = ($request->name) ? $request->name : '';
            $user->email = ($request->email) ? $request->email : '';
            $user->phone = ($request->phone) ? $request->phone : '';
            $user->password = $password;
            $user->address = ($request->address) ? $request->address : '';
            $user->type = "USER";
            $user->state = '';
            $user->country = ($request->country) ? $request->country : '';
            $user->zip = ($request->zip) ? $request->zip : '';
            $user->save();
            $user_id = $user->id;
            $actn = 'insert';
        }

        //$shipmentImage = '';
        //if ($image = $request->file('image')) {
            //$destinationPath = '/var/www/buscargo.pt/data/www/buscargo.pt/public/shipments/';
            //$shipmentImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            //$image->move($destinationPath, $shipmentImage);            
        //}
        


        $shipmentDetails = [
            'user_id' => $user_id,
            'collection' => ($request->collection) ? $request->collection : '',
            'delivery' => ($request->delivery) ? $request->delivery : '',
            'title' => ($request->title) ? $request->title : '',
            'description' => ($request->description) ? $request->description : 'NA',
            'pickup_floor' => ($request->pickup_floor) ? $request->pickup_floor : '0',
            'pickup_lift' => ($request->pickup_lift) ? $request->pickup_lift : '0',
            'delivery_floor' => ($request->delivery_floor) ? $request->delivery_floor : '0',
            'delivery_lift' => ($request->delivery_lift) ? $request->delivery_lift : '0',
            'delivery_date' => ($request->delivery_date) ? $request->delivery_date : $dlvDate,
            'budget' => ($request->budget) ? $request->budget : '0',
            'geometry' => '',
            'distance' => ($request->distance) ? $request->distance : '0',
            'image' => ($request->image) ? $request->image : '',
            'status' => 'ACTIVE',
            'category_id' => ($request->category) ? $request->category : '',
            'delivery_size' => ($request->delivery_size) ? $request->delivery_size : '0',
            'created_at' => now()
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

        $message = 'Thank you for registering with us, Please <a href="https://buscargo.pt/" target="_self">click here</a> to login';


        $subject = 'ANÚNCIO PUBLICADO!';
        $message = 'Parabéns, seu anuncio foi publicado com sucesso!<br />
                    Você será notificado em breve quando os motoristas
                    postarem seus orçamentos.<br />
                    Fique atento, pois as licitações tem prazo e podem expirar.
                    Você poderá acompanhar todas as propostas no painel da
                    sua conta e seu anúncio.<br />
                    No caso de alguma dúvida, poderá entrar em contato
                    conosco através de nosso e-mail, telefone ou redes sociais.<br><br>Email :'.$request->email.'<br> Password :'.$request->password;
        $mail->sendMail($request->email, $subject, $message);
        

       return response()->json(['success'=>true, 'message' => 'Shipment Sucesfully Registered','data'=>$shipment, 'actiontype'=>$actn, 'job_url'=>$job_url]);
    }


}


    // public function submitShipment(Request $request, MailController $mail){
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required | unique:users',
    //         'phone' => 'required',
    //         'address' => 'required',
    //         'country' => 'required',
    //         'state' => 'required',
    //         'password' => 'required',
    //         'zip' => 'required'
    //     ]);


    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'phone' => $request->phone,
    //         'password' => Hash::make($request->password),
    //         'address' => $request->address,
    //         'type' => "USER",
    //         'status' => 'APPROVED',
    //         'country' => $request->country,
    //         'state' => $request->state,
    //         'zip' => $request->zip,
    //     ]);
    //     $subject = 'Bem vindo a Buscargo!';
    //             $message = 'Olá!<br /><br />
    //             Muito obrigado por se cadastrar em nosso site, você pode criar anuncios e ter diferentes
    //             opções de preços, de motoristas diferentes, mais baixos do que o mercado convencional.<br /><br />
    //             Use fotos, descreva o que deseja transportar e suas dimensões, para facilitar no
    //             orçamento do motorista.<br /><br />
    //             Acompanhe o andamento de seu anuncio através de sua caixa de entrada de e-mail e
    //             através da plataforma no painel de usuário.<br /><br />
    //             No caso de alguma dúvida, poderá entrar em contato conosco, respondendo esse e-mail
    //             ou através de nosso telefone.</br/>Entre agora na sua conta em: http://www.buscargo.pt e fazer';
    //     $mail->sendMail($request->email, $subject, $message);
    //     $request->validate([
    //         'title' => 'required',
    //         'category_id' => 'required',
    //         'description' => 'required',
    //         'collection' => 'required',
    //         'delivery' => 'required',
    //         'delivery_date' => 'required',
    //         'delivery_size' => 'required',
    //         'budget' => 'required',
    //         'pickup_floor' => 'required',
    //         'pickup_lift' => 'required',
    //         'delivery_floor' => 'required',
    //         'delivery_lift' => 'required',
    //         'geometry' => 'required'
    //     ]);
           
    //     return Shipment::create([
    //         'user_id' => $user->id,
    //         'title' => $request->title,
    //         'image' => $request->image,
    //         'category_id' => $request->category_id,
    //         'description' => $request->description,
    //         'collection' => $request->collection,
    //         'delivery' => $request->delivery,
    //         'delivery_date' => $request->delivery_date,
    //         'delivery_size' => $request->delivery_size,
    //         'distance' => $request->distance,
    //         'budget' => $request->budget,
    //         'pickup_floor' => $request->pickup_floor,
    //         'pickup_lift' => $request->pickup_lift,
    //         'delivery_floor' => $request->delivery_floor,
    //         'delivery_lift' => $request->delivery_lift,
    //         'geometry' => $request->geometry,
    //         'status' => 'ACTIVE'
    //     ]);
    // }



    public function submitShipment(Request $request, MailController $mail){

        if(isset($request->shipid) && $request->shipid != ''){

            $reqUsrId = $request->userid;
            $shipid = $request->shipid;

            // $request->validate([
            //     'name' => 'required',
            //     'email' => 'required',
            //     'phone' => 'required',
            //     'address' => 'required',
            //     'country' => 'required',
            //     'state' => 'required',
            //     'password' => 'required',
            //     'zip' => 'required'
            // ]);


            $user= User::find($reqUsrId);
            $user->name = ($request->name) ? $request->name : '';
            $user->email = ($request->email) ? $request->email : '';
            $user->phone = ($request->phone) ? $request->phone : '';
            $user->password = ($request->password) ? Hash::make($request->password) : '';
            $user->address = ($request->address) ? $request->address : '';
            $user->type = "USER";
            $user->state = ($request->state) ? $request->state : '';
            $user->country = ($request->country) ? $request->country : '';
            $user->zip = ($request->zip) ? $request->zip : '';
            $user->save();

            $user_id = $user->id;

            $subject = 'ANÚNCIO PUBLICADO!';
            $message = 'Parabéns, seu anuncio foi publicado com sucesso!<br />
                        Você será notificado em breve quando os motoristas
                        postarem seus orçamentos.<br />
                        Fique atento, pois as licitações tem prazo e podem expirar.
                        Você poderá acompanhar todas as propostas no painel da
                        sua conta e seu anúncio.<br />
                        No caso de alguma dúvida, poderá entrar em contato
                        conosco através de nosso e-mail, telefone ou redes sociais.';
            $mail->sendMail($request->email, $subject, $message);


            // $request->validate([
            //     'title' => 'required',
            //     'category_id' => 'required',
            //     'description' => 'required',
            //     'collection' => 'required',
            //     'delivery' => 'required',
            //     'delivery_date' => 'required',
            //     'delivery_size' => 'required',
            //     'budget' => 'required',
            //     'pickup_floor' => 'required',
            //     'pickup_lift' => 'required',
            //     'delivery_floor' => 'required',
            //     'delivery_lift' => 'required',
            //     'geometry' => 'required'
            // ]);


            $cdate = now();
            $ship= Shipment::find($shipid);
            $ship->user_id = $user_id;
            $ship->collection = ($request->collection) ? $request->collection : '';
            $ship->delivery = ($request->delivery) ? $request->delivery : '';
            $ship->title = ($request->title) ? $request->title : '';
            $ship->description = ($request->description) ? $request->description : ' ';
            $ship->pickup_floor = ($request->pickup_floor) ? $request->pickup_floor : '0';
            $ship->pickup_lift = ($request->pickup_lift) ? $request->pickup_lift : '0';
            $ship->delivery_floor = ($request->delivery_floor) ? $request->delivery_floor : '0';
            $ship->delivery_lift = ($request->delivery_lift) ? $request->delivery_lift : '0';
            $ship->delivery_date = ($request->delivery_date) ? $request->delivery_date : $cdate;
            $ship->budget = ($request->budget) ? $request->budget : '0';
            $ship->geometry = '';

            if(isset($request->distance) && $request->distance != ''){
                $ship->distance = $request->distance;
            }

            
             //$ship->image = ($shipmentImage) ? $shipmentImage : '';
            $ship->image = $request->image;
            $ship->status = 'ACTIVE';
            // $ship->category_id = ($request->category) ? $request->category : 0;
            $ship->delivery_size = ($request->delivery_size) ? $request->delivery_size : '0';
            $ship->created_at = $cdate;
            $ship->save();

        }else{
            $request->validate([
                'name' => 'required',
                'email' => 'required | unique:users',
                'phone' => 'required',
                'address' => 'required',
                'country' => 'required',
                'state' => 'required',
                'password' => 'required',
                'zip' => 'required'
            ]);


            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'address' => $request->address,
                'type' => "USER",
                'status' => 'APPROVED',
                'country' => $request->country,
                'state' => $request->state,
                'zip' => $request->zip,
            ]);
            $subject = 'Bem vindo a Buscargo!';
                    $message = 'Olá!<br /><br />
                    Muito obrigado por se cadastrar em nosso site, você pode criar anuncios e ter diferentes
                    opções de preços, de motoristas diferentes, mais baixos do que o mercado convencional.<br /><br />
                    Use fotos, descreva o que deseja transportar e suas dimensões, para facilitar no
                    orçamento do motorista.<br /><br />
                    Acompanhe o andamento de seu anuncio através de sua caixa de entrada de e-mail e
                    através da plataforma no painel de usuário.<br /><br />
                    No caso de alguma dúvida, poderá entrar em contato conosco, respondendo esse e-mail
                    ou através de nosso telefone.</br/>Entre agora na sua conta em: http://www.buscargo.pt e fazer';
            $mail->sendMail($request->email, $subject, $message);
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
               
            return Shipment::create([
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
                'geometry' => $request->geometry,
                'status' => 'ACTIVE'
            ]);

        }

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
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shipment = Shipment::find($id);
        $awarded = $shipment->awarded()->first();    
        $awardedbid = $shipment->awardedbid()->first();  
        $bids = $shipment->bids()->with(['transporter:id,name,image'])->get();    
        $bidcount = $bids->count();
        $average = round($bids->avg('amount'), 2);

        return [
            "data" => $shipment,
            "awarded" => $awarded,
            "awardedbid" => $awardedbid,
            "bids" => $bids,
            "bidcount" => $bidcount,
            "average" => $average
        ];
    }
    public function shipmentAutoBid($id, Request $request){
        $shipment = Shipment::find($id);
        
        $divers= User::where('type', 'TRANSPORTER')->inRandomOrder()->first();

        $dateTmp = date('Y-m-d');
        $expiryDate = date('Y-m-d', strtotime($dateTmp. ' + 10 days'));
        $bidDetails = [
            "driver_id" => $divers->id,
            "user_id" => $shipment->user_id,
            "shipment_id" => $id,
            "amount" => rand(10,100),
            "proposal" => 'I can do it, I have good experience in the project fields',
            "status" => "ACTIVE",
            "expiration" => $expiryDate,
        ];

        $bids = $shipment->bids()->get();    
        $bidcount = $bids->count();
        if($bidcount < 15) {
            $createdBid = Bids::create($bidDetails);
        }
        


        $bidcount = $divers->count();

        $transporter = $request->user('sanctum');
        $awarded = $shipment->awarded()->first();    
        $awardedbid = $shipment->awardedbid()->first();  
        // $bids = $shipment->bids()->with(['transporter:id,name,image,badge,profileimage'])->get();    
        $bids = $shipment->bids()->with(['transporter:id,name,image,badge'])->get();    
        // $bidcount = $bids->count();
        $average = round($bids->avg('amount'), 2);
        $transporters = array();
        $ratings = array();
        // $collection = collect($bids->toArray());
        // $test = $collection->each(function($item,$key){
        //     $toparray->push($item['transporter']['id']);
        // });
        foreach($bids as $key => $value){
            $transporters[$key] = $value['transporter']['id'];
        }
        foreach($transporters as $key => $id){
            $ratingcount = User::find($id)->reviews->count() * 5;
            if($ratingcount !== 0){
                $receivedrating = User::find($id)->reviews->sum('rating');
                $rating = ($receivedrating * 5) / $ratingcount;
                $ratings[$key] = $rating;
            }else{
                $ratings[$key] = 0;
            }
        }
        

        if($transporter){
            $mybid = $shipment->bids()->where('shipment_id',$id)->where('driver_id',$transporter->id)->with(['transporter:id,name,image'])->first();
        }else{
            $mybid = []; 
        }
        
        // foreach($user as $key => $value){
        //     $transporters[$key] = $value['transporter']['id'];
        // }
        return [
            "data" => $shipment,
            "awarded" => $awarded,
            "awardedbid" => $awardedbid,
            "bids" => $divers,
            "bidcount" => $bidcount,
            "average" => $average,
            "mybid" => $mybid,
            "ratings" => $ratings
        ];
    }
    public function shipmentwithbid($id,Request $request)
    {
        $transporter = $request->user('sanctum');
        $shipment = Shipment::find($id);
        $awarded = $shipment->awarded()->first();    
        $awardedbid = $shipment->awardedbid()->first();  
        // $bids = $shipment->bids()->with(['transporter:id,name,image,badge,profileimage'])->get();    
        $bids = $shipment->bids()->with(['transporter:id,name,image,badge'])->get();    
        $bidcount = $bids->count();
        $average = round($bids->avg('amount'), 2);
        $transporters = array();
        $ratings = array();
        // $collection = collect($bids->toArray());
        // $test = $collection->each(function($item,$key){
        //     $toparray->push($item['transporter']['id']);
        // });
        foreach($bids as $key => $value){
            $transporters[$key] = $value['transporter']['id'];
        }
        foreach($transporters as $key => $id){
            $ratingcount = User::find($id)->reviews->count() * 5;
            if($ratingcount !== 0){
                $receivedrating = User::find($id)->reviews->sum('rating');
                $rating = ($receivedrating * 5) / $ratingcount;
                $ratings[$key] = $rating;
            }else{
                $ratings[$key] = 0;
            }
        }
        

        if($transporter){
            $mybid = $shipment->bids()->where('shipment_id',$id)->where('driver_id',$transporter->id)->with(['transporter:id,name,image'])->first();
        }else{
            $mybid = []; 
        }
        

        return [
            "data" => $shipment,
            "awarded" => $awarded,
            "awardedbid" => $awardedbid,
            "bids" => $bids,
            "bidcount" => $bidcount,
            "average" => $average,
            "mybid" => $mybid,
            "ratings" => $ratings
        ];
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
// Create a shipment from the form
    public function createShipment(CreateShipment $req) {
        $user = null;
        if(isset($req->email) && isset($req->password)) {
            // Create user
            $user = User::create([
                'name' => $req->name,
                'email' => $req->email,
                'phone' => $req->phone,
                'password' => Hash::make($req->password),
                'address' => 'address',
                'type' => "USER",
                'status' => 'APPROVED',
                'country' => 'country',
                'state' => 'state',
                'zip' => 'zip code',
            ]);
        }
        // Create Shipment
        return Shipment::create([
            'user_id' => isset($user) ? $user->id : $req->userid,
            'title' => $req->title,
            'image' => $req->image,
            'category_id' => 1,
            'description' => $req->description,
            'collection' => $req->collection,
            'delivery' => $req->delivery,
            'delivery_date' => Carbon::now()->addDays(21),
            'delivery_size' => '0',
            'distance' => $req->distance,
            'budget' => '0',
            'pickup_floor' => '0',
            'pickup_lift' => '0',
            'delivery_floor' => '0',
            'delivery_lift' => '0',
            'geometry' => $req->geometry,
            'status' => 'ACTIVE'
        ]);
    }
}
