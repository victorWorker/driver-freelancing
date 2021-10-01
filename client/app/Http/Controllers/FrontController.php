<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Route;
use App\Models\Category;
use App\Models\User;
use App\Models\Shipment;
use Hash;
use Illuminate\Support\Facades\App;
use json;
use App\Http\Controllers\MailController;

class FrontController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $locale = App::currentLocale();
       
        $categories = Category::all();
        return view('client_registration.index',compact('categories', 'locale'));
    }

    public function submitStep1(Request $request)
    {
        $locale = App::currentLocale();
        $transport = $request->transport;
        $from = $request->from;
        $to = $request->To;


        return view('client_registration.step2',compact('transport', 'from', 'to', 'locale'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function driverRegistration()
    {           
        $locale = App::currentLocale();
        return view('driver_registration.index', compact('locale'));
    }

    public function submitDriverRegistration(Request $request){
        $locale = App::currentLocale();

        $validator = $request->validate([
            'name' => 'required',
            'email' => 'required | unique:users',
            'phone' => 'required',
            'address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'password' => 'required',
            'zip' => 'required'
        ]);

        if (!$validator) {
            $messages = $validator->messages();
            return Redirect::to('driver_registration')->withErrors($validator);         
        }

        $subject = 'ANÚNCIO PUBLICADO!';
        $message = 'Parabéns, seu anuncio foi publicado com sucesso!<br />
                    Você será notificado em breve quando os motoristas
                    postarem seus orçamentos.<br />
                    Fique atento, pois as licitações tem prazo e podem expirar.
                    Você poderá acompanhar todas as propostas no painel da
                    sua conta e seu anúncio.<br />
                    No caso de alguma dúvida, poderá entrar em contato
                    conosco através de nosso e-mail, telefone ou redes sociais.';
        // $mail->sendMail($request->email, $subject, $message);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'type' => "TRANSPORTER",
            'country' => $request->country,
            'state' => $request->state,
            'zip' => $request->zip,
        ]);


        // Destroy all sessions
       //session_destroy();

        if($locale=='pt'){
             //$message = 'Obrigado por se registrar conosco, Por favor <a href="https://buscargo.pt/" target="_self">Clique aqui</a> Entrar';
             $message = ' obrigado. Espera para motoristas fazer cotacao';
        } else {
             $message = 'Thank you for registering with us, Please <a href="https://buscargo.pt/" target="_self">click here</a> to login';
        }
       $categories = Category::all();
        return view('driver_registration.index', compact('message','locale','categories'));

    }


    public function submitShipmentDetails(Request $request, MailController $mail){
        $locale = App::currentLocale();


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


        $user = new User();
        $user->name = ($request->name) ? $request->name : '';
        $user->email = ($request->email) ? $request->email : '';
        $user->phone = ($request->phone) ? $request->phone : '';
        $user->password = ($request->password) ? Hash::make($request->password) : '';
        $user->address = ($request->address) ? $request->address : '';
        $user->type = "USER";
        $user->state = '';
        $user->country = ($request->country) ? $request->country : '';
        $user->zip = ($request->zip) ? $request->zip : '';
        $user->save();

        $user_id = $user->id;

        $shipmentImage = '';
        if ($image = $request->file('image')) {
            $destinationPath = '/var/www/buscargo.pt/data/www/buscargo.pt/public/shipments/';
            $shipmentImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $shipmentImage);            
        }


        $shipmentDetails = [
            'user_id' => $user_id,
            'collection' => ($request->collection) ? $request->collection : '',
            'delivery' => ($request->delivery) ? $request->delivery : '',
            'title' => ($request->title) ? $request->title : '',
            'description' => ($request->description) ? $request->description : '',
            'pickup_floor' => ($request->pickup_floor) ? $request->pickup_floor : '',
            'pickup_lift' => ($request->pickup_lift) ? $request->pickup_lift : '',
            'delivery_floor' => ($request->delivery_floor) ? $request->delivery_floor : '',
            'delivery_lift' => ($request->delivery_lift) ? $request->delivery_lift : '',
            'delivery_date' => ($request->delivery_date) ? $request->delivery_date : '',
            'budget' => ($request->budget) ? $request->budget : '',
            'geometry' => '',
            'distance' => '',
            'image' => ($shipmentImage) ? $shipmentImage : '',
            'status' => 'ACTIVE',
            'category_id' => ($request->category) ? $request->category : '',
            'delivery_size' => ($request->delivery_size) ? $request->delivery_size : '',
            'created_at' => now()
        ];

        $shipment = Shipment::create($shipmentDetails);

        if($locale=='pt'){
             //$message = 'Obrigado por se registrar conosco, Por favor <a href="https://buscargo.pt/" target="_self">Clique aqui</a> Entrar';
             $message = ' obrigado. Espera para motoristas fazer cotacao';
        } else {
             $message = 'Thank you for registering with us, Please <a href="https://buscargo.pt/" target="_self">click here</a> to login';
        }

        $categories = Category::all();;
        return view('client_registration.index', compact('message', 'categories','locale'));

    }


    public function checkUserEmail(Request $request){
        $email = $request->email;
     
        $userCount = User::where('email', $email);
        if ($userCount->count()) {
            return json_encode(array('msg' => 'true'));
        } else {
            return json_encode(array('msg' => 'false'));
        }
    }


    //   public function shipment(Request $request, MailController $mail){
    //     $locale = App::currentLocale();


    //     $subject = 'ANÚNCIO PUBLICADO!';
    //     $message = 'Parabéns, seu anuncio foi publicado com sucesso!<br />
    //                 Você será notificado em breve quando os motoristas
    //                 postarem seus orçamentos.<br />
    //                 Fique atento, pois as licitações tem prazo e podem expirar.
    //                 Você poderá acompanhar todas as propostas no painel da
    //                 sua conta e seu anúncio.<br />
    //                 No caso de alguma dúvida, poderá entrar em contato
    //                 conosco através de nosso e-mail, telefone ou redes sociais.';
    //     $mail->sendMail($request->email, $subject, $message);


    //     $user = new User();
    //     $user->name = ($request->name) ? $request->name : '';
    //     $user->email = ($request->email) ? $request->email : '';
    //     $user->phone = ($request->phone) ? $request->phone : '';
    //     $user->password = ($request->password) ? Hash::make($request->password) : '';
    //     $user->address = ($request->address) ? $request->address : '';
    //     $user->type = "USER";
    //     $user->state = '';
    //     $user->country = ($request->country) ? $request->country : '';
    //     $user->zip = ($request->zip) ? $request->zip : '';
    //     $user->save();

    //     $user_id = $user->id;

    //     $shipmentImage = '';
    //     if ($image = $request->file('image')) {
    //         $destinationPath = '/var/www/buscargo.pt/data/www/buscargo.pt/public/shipments/';
    //         $shipmentImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
    //         $image->move($destinationPath, $shipmentImage);            
    //     }


    //     $shipmentDetails = [
    //         'user_id' => $user_id,
    //         'collection' => ($request->collection) ? $request->collection : '',
    //         'delivery' => ($request->delivery) ? $request->delivery : '',
    //         'title' => ($request->title) ? $request->title : '',
    //         'description' => ($request->description) ? $request->description : '0',
    //         'pickup_floor' => ($request->pickup_floor) ? $request->pickup_floor : '0',
    //         'pickup_lift' => ($request->pickup_lift) ? $request->pickup_lift : '0',
    //         'delivery_floor' => ($request->delivery_floor) ? $request->delivery_floor : '0',
    //         'delivery_lift' => ($request->delivery_lift) ? $request->delivery_lift : '0',
    //         'delivery_date' => ($request->delivery_date) ? $request->delivery_date : '2021-06-09 08:54:51',
    //         'budget' => ($request->budget) ? $request->budget : '0',
    //         'geometry' => '',
    //         'distance' => '',
    //         'image' => ($shipmentImage) ? $shipmentImage : '',
    //         'status' => 'ACTIVE',
    //         'category_id' => ($request->category) ? $request->category : '',
    //         'delivery_size' => ($request->delivery_size) ? $request->delivery_size : '0',
    //         'created_at' => now()
    //     ];

    //     $shipment = Shipment::create($shipmentDetails);

    //     if($locale=='pt'){
    //          //$message = 'Obrigado por se registrar conosco, Por favor <a href="https://buscargo.pt/" target="_self">Clique aqui</a> Entrar';
    //          $message = ' obrigado. Espera para motoristas fazer cotacao';
    //     } else {
    //          $message = 'Thank you for registering with us, Please <a href="https://buscargo.pt/" target="_self">click here</a> to login';
    //     }

    //    return response()->json(['success'=>true, 'message' => 'Shipment Sucesfully Register1','data'=>$shipment]);

    // }

   


public function shipment(Request $request, MailController $mail)
{
    dd($request->all());
    $locale = App::currentLocale();

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

        if($locale=='pt'){
             //$message = 'Obrigado por se registrar conosco, Por favor <a href="https://buscargo.pt/" target="_self">Clique aqui</a> Entrar';
             $message = ' obrigado. Espera para motoristas fazer cotacao';
        }else{
             $message = 'Thank you for registering with us, Please <a href="https://buscargo.pt/" target="_self">click here</a> to login';
        }

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

        $shipment = Shipment::create($shipmentDetails);

        if($locale=='pt'){
             //$message = 'Obrigado por se registrar conosco, Por favor <a href="https://buscargo.pt/" target="_self">Clique aqui</a> Entrar';
             $message = ' obrigado. Espera para motoristas fazer cotacao';
        } else {
            $message = 'Thank you for registering with us, Please <a href="https://buscargo.pt/" target="_self">click here</a> to login';
        }


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
        

       return response()->json(['success'=>true, 'message' => 'Shipment Sucesfully Registered','data'=>$shipment, 'actiontype'=>$actn]);
    }


}

}