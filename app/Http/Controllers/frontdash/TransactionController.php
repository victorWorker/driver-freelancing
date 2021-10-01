<?php

namespace App\Http\Controllers\frontdash;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Transaction;
use App\Http\Controllers\MailController; 
use App\User;
use App\Bids;
use App\Shipment;
use Session;


//use Srmklive\PayPal\Services\ExpressCheckout;
/** Paypal Details classes **/
   use PayPal\Rest\ApiContext;
   use PayPal\Auth\OAuthTokenCredential;
   use PayPal\Api\Amount;
   use PayPal\Api\Details;
   use PayPal\Api\Item;
   use PayPal\Api\ItemList;
   use PayPal\Api\Payer;
   use PayPal\Api\Payment;
   use PayPal\Api\RedirectUrls;
   use PayPal\Api\PaymentExecution;
   use PayPal\Api\Transaction as PaypalTransaction;

   use PayPal\Exception\PayPalConnectionException;
   use Exception;


class TransactionController extends Controller
{

    protected $apiUrl = "https://clientes.eupago.pt/clientes/rest_api"; 
    protected $key = "f418-a5ee-628c-b246-c053";
    private $api_context;

   public function __construct()
    {
      
        $paypal_configuration = \Config::get('paypal');
       // print_r($paypal_configuration['client_id']);die;
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
   

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getTransporterTransactions(Request $request){
        $user = $request->user('sanctum');
        return Transaction::where('user_id', $user->id)->orderBy('id', 'DESC')->paginate(10);
    }

    public function getPreviousSubscriptionTransaction(Request $request) {
        $user = $request->user('sanctum');
        return Transaction::where('user_id', $user->id)
                          ->where('type', 'SUBSCRIPTION')
                          ->orderBy('id', "DESC")
                          ->first();
    }

     public function loadlastshiptransaction(Request $request) {
        $user = $request->user('sanctum');
        $data = Transaction::where('user_id', $user->id)->orderBy('id', "DESC")->first();
        return $data; 
    }



    public function membershipTransaction(Request $request, MailController $mail) {

       
        $user = $request->user('sanctum');

        $payment_details = "";
        $amount = (isset($request->amount)) ? $request->amount : 5;
        $discount = (isset($request->discount)) ? $request->discount : 0;
        $type = (isset($request->type)) ? $request->type : 'SUBSCRIPTION';

        // Update shipment real address and contact
        $bidid=$request->bidid;
        $bid = Bids::find($request->bidid);
        if($type == 'SHIPMENT' && $request->paymentMethod != 'PayPal') {    

            $bid->status = "AWARDED";
            $bid->save();            
            $shipment = Shipment::where('user_id', $user->id)->find($bid->shipment_id);
            $shipment->actual_details = $request->actualDetails;
            $shipment->status = "AWARDED";
            $shipment->awarded_to = $bid->driver_id;
            $shipment->awarded_bid = $bidid;
            $shipment->save();
          }
            $bid_get = Bids::find($request->bidid);
            $driver_id = $bid_get->driver_id;
            $get_driver = User::where('id',$driver_id)->first();                 
            // $message1 = "<b>Dear, </b> ".$get_driver->name."<br />";
            // $message1 .= "<b>Client accept your bid</b><br/>";
            // $message1 .= "<b>Client Name:</b> ".$user->name."<br/>";
            // $message1 .= "<b>Client Email:</b> ".$user->email."<br/>";
            // $message1 .= "<b>Client Email:</b> ".$user->phone."<br/>";
            // $mail->sendMail($get_driver->email, "BID ACCEPT", $message1);





        if($request->paymentMethod === 'PayPal') {
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'type' => $type,
                'method' => $request->paymentMethod,
                'payment_details' => 'PayPal Express Checkout',
                'amount' => $amount,
                'discount' => $discount,
                'bid_id' => $bidid,
                'shipment_id' => $bid->shipment_id,
                'status' => 'PENDING'
            ]);
             $callbackID = ($type == 'SUBSCRIPTION') ? $transaction->id : $request->bidid;
           // $response = $this->createPaypalPayment($amount, $type, $callbackID, $transaction->id);
            $response = $this->createPayment($amount, $type, $callbackID, $transaction->id);
           
            return $response;
        }else{
            if($request->paymentMethod === 'Multibanco'){
                $payment_details = $this->createMultibancoPayment($amount, $user->name);
            }elseif($request->paymentMethod === 'MB Way'){
                 $payment_details = $this->createMBWayPayment($amount, $request->number, $user->name);
            }
            // $payment_details = $this->createMultibancoPayment($amount, "Test transporter");
            $response = json_decode($payment_details, true);
            
            if($response['estado']  === -1 || 
                $response['estado'] === -7 || 
                $response['estado'] === -8 || 
                $response['estado'] === -9 || 
                $response['estado'] === -10){
                    $status = "FAILED";
            }
            elseif($response['estado'] === 0) {
                $status = "PENDING";
               // $status = "SUCCESS";
            } 
 
            if($request->paymentMethod === 'Multibanco'){
                $message = "<b>Dear, </b> ".$user->name."<br />";
                $message .= "<b>Reference :</b> ".$response['referencia']."<br/>";
                $message .= "<b>Value :</b> ".$response['valor']."<br/>";
                $message .= "<b>Entity :</b> ".$response['entidade']."<br/>";
                $message .= "<b>Driver Details</b><br/>";
                $message .= "<b>Driver Name :</b> ".$get_driver->name."<br/>";
                $message .= "<b>Driver Email :</b> ".$get_driver->email."<br/>";
                $message .= "<b>Driver Phone :</b> ".$get_driver->phone."<br/>";
               // $mail->sendMail($user->email, "PAGAMENTO BUSCARGO", $message);

                $subject = 'A sua referência de pagamento!';
                $message1 = "   Olá,<br>
                        Não perca mais tempo, comece já a poupar.<br>
                        Enviamos a referência de pagamento da licitação que pretende aceitar:<br>
                        Referência:".$response['referencia']."<br>
                        Valor: €".$response['valor_minimo']."<br>
                        Entidade:".$response['entidade']."<br>
                         ";
                    $mail->sendMail($user->email, $subject, $message1);
 
               
            }elseif($request->paymentMethod === 'MB Way'){
                // $message = "<b>Dear, </b> ".$user->name."<br />";
                // $message .= "<b>Reference :</b> ".$response['referencia']."<br/>";
                // $message .= "<b>Driver Details</b><br/>";
                // $message .= "<b>Driver Name :</b> ".$get_driver->name."<br/>";
                // $message .= "<b>Driver Email :</b> ".$get_driver->email."<br/>";
                // $mail->sendMail($user->email, "PAGAMENTO BUSCARGO", $message);
            }


            // ######## code for send email to driver and client 2-02-2021 ################

            // $message_driver = "A sua licitação no pedido: ".$shipment->title." foi aceite! <br />";
            // $message_driver .= "Enviamos os detalhes do cliente: <br/><br/>";
            // $message_driver .= "<b>Nome do cliente :</b> ".$user->name."<br/>";
            // $message_driver .= "<b>Número de telemóvel :</b> ".$user->phone."<br/>";
            // $message_driver .= "<b>Email :</b> ".$user->email."<br/><br/>";
            // $message_driver .= "Obrigado!<br/>";
            // $mail->sendMailtwo($get_driver->email, "Licitação aceite!", $message_driver);





            

            // $message_client = "O seu pagamento foi confirmado! <br />";
            // $message_client .= "Enviamos agora os detalhes e número do motorista que irá realizar o transporte do seu pedido!<br/><br/>";
            // $message_client .= "<b>Nome do motorista :</b> ".$get_driver->name."<br/>";
            // $message_client .= "<b>Número de telemóvel :</b> ".$get_driver->phone."<br/>";
            // $message_client .= "<b>Email :</b> ".$get_driver->email."<br/><br/>";
            // $message_client .= "Foi prazer trabalhar consigo e não conseguimos esperar pela próxima vez!<br>Esperemos que o nosso serviço tenha sido do seu agrado e caso necessite de alguma coisa apenas necessita de nos contactar!<br/>";
            // $mail->sendMailtwo($user->email, "Pagamento confirmado!", $message_client);

            // #######################################


            $transaction = Transaction::create([
                'user_id' => $user->id,
                'type' => $type,
                'method' => $request->paymentMethod,
                'payment_details' => $response,
                'amount' => $amount,
                'discount' => $discount,
                'bid_id' => $bidid,
                'shipment_id' => $bid->shipment_id,
                'status' => $status
            ]);
        }

      
        
        $data['trans_id'] = $transaction->id;
        $data['payment_resp'] = $response;
        return $data;
    }

   

    protected function createMBWayPayment($amount, $phone, $transporter) {
        $url = $this->apiUrl.'/mbway/create';
        $data['chave'] = $this->key;
        $data['valor'] = $amount;       
        $data['id'] = "Payment for membership for transporter ".$transporter;
        $data['alias'] = $phone;
        $data['descricao'] = "Buscargo servicos da transporte";
        $resp = Http::post($url, $data);
        return $resp;
        //  $url = "https://clientes.eupago.pt/api/management/v1.02/references?status=pending";
        // $headers = [
        //     'Content-Type' => 'application/json',
        //     'Authorization' =>  'ApiKey '.$this->key
        // ];
        // $data['chave'] = $this->key;
        // $data['valor'] = $amount;
        // $data['alias'] = $phone;
        // $data['id'] = "Payment for membership for transporter ".$transporter;
        // $data['descricao'] = "Payment for membership for transporter ".$transporter;
        // $resp = Http::withToken('ApiKey '. $this->key)->get($url);
        // return $resp;
    }

    protected function createMultibancoPayment($amount, $transporter) {
        $url = $this->apiUrl.'/multibanco/create';
        $data['chave'] = $this->key;
        $data['valor'] = $amount;
        $data['valor_minimo'] = $amount;
        $data['valor_maximo'] = $amount;
        $data['id'] = "Payment for membership for transporter ".$transporter;
        $data['per_dup'] = 0;
        
        $resp = Http::post($url, $data);
        return $resp;
    }


    /** This method sets up the paypal payment.
     **/

    public function createPayment($price, $type="", $orderid, $trans_id)
    {
         $desc = ($type == 'SUBSCRIPTION') ? "Order ID #{$orderid} Invoice" : $trans_id;
          $url = ($type == 'SHIPMENT') ? 'https://www.buscargo.pt/user/dashboard/bid/award/'.$orderid : 'https://www.buscargo.pt/transporter/dashboard/subscribe';
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();

        $item_1->setName($type)
            ->setCurrency('EUR')
            ->setQuantity(1)
            ->setPrice($price);

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('EUR')
            ->setTotal($price);

        $transaction = new PaypalTransaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription($trans_id);

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl($url)
            ->setCancelUrl($url);

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));            
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error','Connection timeout');
                return $url;                
            } else {
                \Session::put('error','Some error occur, sorry for inconvenient');
                return $url;                
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        
     //   Session::put('paypal_payment_id', $payment->getId());

        if(isset($redirect_url)) {    
        // $da=array(
        //     'paypal_link'=>$redirect_url
        //     'paypal_link'=>$redirect_url
        // );        
          
            return $redirect_url ;
        }

        \Session::put('error','Unknown error occurred');
        return $url;
    }
  
    
    public function confirmPayPalPayment(Request $request)
    {        

      //echo "<pre>";
       
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            \Session::put('error','Payment failed');
             abort(400, "Error in completing the payment.");   
        }
        $payment_id = $request->input('paymentId'); 
        $payment = Payment::get($payment_id , $this->_api_context);        
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));        
        $result = $payment->execute($execution, $this->_api_context);
  
        if ($result->getState() == 'approved') {  
         
         $payment_id=$result->getId();
       
         $type=$result->transactions[0]->item_list->items[0]->name;

         $transaction_id=$result->transactions[0]->related_resources[0]->sale->id;
         $order_no=$result->transactions[0]->description;
        
         $data['payment_id'] =  $payment_id; 
         $data['transaction_id'] =  $transaction_id; 
         $data['state'] =  $result->transactions[0]->related_resources[0]->sale->state; 
         $data['amount'] =  $result->transactions[0]->related_resources[0]->sale->amount->total; 
         $data['currency'] =  $result->transactions[0]->related_resources[0]->sale->amount->currency;
         $data['shipping_address'] =  json_decode($result->transactions[0]->item_list->shipping_address,true);
         $data['shipping_address']=json_encode($data['shipping_address']);
         $user = $request->user('sanctum');
        
            // Save transaction data
            $trans_id = $order_no;
            $transaction = Transaction::find($trans_id);
           // print_r(json_encode($data));
            $transaction->status = "SUCCESS";
            $transaction->payment_details = json_encode($data);
            $transaction->save();

            // Subscribe the user
            if($type === 'SUBSCRIPTION') {
                $transporter = User::find($user->id);
                $transporter->membership = 1;
                $transporter->membership_status = 'ACTIVE';
                $transporter->membership_date = date('Y-m-d');
                return $transporter->save();
            }else{
                $bidid =  $transaction->bid_id;
                $bid = Bids::find($bidid);
                $bid->status = "AWARDED";
                $bid->save();
                $shipment = Shipment::where('user_id', $user->id)->find($bid->shipment_id);
                $shipment->status = "AWARDED";
                $shipment->awarded_to = $bid->driver_id;
                $shipment->awarded_bid = $bidid;
                return $shipment->save();
            }
         
        
            
        }

        \Session::put('error','Payment failed !!');
          
    }


    public function createPaypalPayment($amount, $type="", $orderid = 0, $trans_id= 0) {
      //  $provider = new ExpressCheckout; 
        $data = [];
        $desc = ($type == 'SUBSCRIPTION') ? "Order ID #{$orderid} Invoice" : $trans_id;
        $data['items'] = [
            [
                'name' => ucfirst($type),
                'price' => $amount,
                'desc'  => $desc,
                'qty' => 1,
                'trans' => $trans_id
            ]
        ];
         $url = ($type == 'SHIPMENT') ? 'http://www.buscargo.tk/user/dashboard/bid/award/'.$orderid : 'http://www.buscargo.tk/transporter/dashboard/subscribe';
        $data['invoice_id'] = $orderid;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = $url;
        $data['cancel_url'] = $url;
        $data['total'] = $amount;


        $response = $provider->setExpressCheckout($data);  
       // $response = $provider->setExpressCheckout($data, true);

        //print_r($response);die;
        return $response;
    }



    public function confirmPayPalPayment_pp(Request $request) {
        $user = $request->user('sanctum');
        $provider = new ExpressCheckout; 
        $transData = $provider->getExpressCheckoutDetails($request->token);
        $data = [];
        $data['items'] = [
            [
                'name' => $transData['L_NAME0'],
                'price' => $transData['L_AMT0'],
                'desc'  => $transData['L_DESC0'],
                'qty' => 1
            ]
        ];
        $data['total'] = $transData['L_AMT0'];
        $data['invoice_id'] = $transData['INVNUM'];
        $data['invoice_description'] = $transData['DESC'];
        $response = $provider->doExpressCheckoutPayment($data, $request->token, $request->PayerID);
        
        if($response['ACK'] === 'Success') {
            // Save transaction data
            $trans_id = ($transData['L_NAME0'] === 'SUBSCRIPTION') ? $transData['INVNUM'] : $transData['L_DESC0'];
            $transaction = Transaction::find($trans_id);
            $transaction->status = "SUCCESS";
            $transaction->payment_details = $response;
            $transaction->save();

            // Subscribe the user
            if($transData['L_NAME0'] === 'SUBSCRIPTION') {
                $transporter = User::find($user->id);
                $transporter->membership = 1;
                $transporter->membership_status = 'ACTIVE';
                $transporter->membership_date = date('Y-m-d');
                return $transporter->save();
            }else{
                $bidid = $transData['INVNUM'];
                $bid = Bids::find($bidid);
                $bid->status = "AWARDED";
                $bid->save();
                $shipment = Shipment::where('user_id', $user->id)->find($bid->shipment_id);
                $shipment->status = "AWARDED";
                $shipment->awarded_to = $bid->driver_id;
                $shipment->awarded_bid = $bidid;
                return $shipment->save();
            }
        }else{
            abort(400, "Error in completing the payment.");   
        }
    }


    public function checkMultibancoStatus(Request $request) {
        $url = $this->apiUrl.'/multibanco/info';
        $data['chave'] = $this->key;
        $data['referencia'] = $request->referencia;
        $data['entidade'] = $request->entidade;
        
        $resp = Http::post($url, $data);
        return $resp['estado_referencia'];
    }
}
