<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\MailController;
use App\User;

class RegisterController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MailController $mail)
    {
        //
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
        
        $subject = "BEM VINDO/A À BUSCARGO!";
        $message = 'Muito obrigado por se registar no nosso site, a partir 
					de agora poderá criar anúncios e ter diferentes opções 
					de preços, que serão sempre mais baixos do que o mercado 
					convencional.<br />
                    Utilize fotos, descreva o que deseja transportar e as suas 
					dimensões, para facilitar no orçamento do motorista.
                    Acompanhe o seu anúncio através da sua caixa de entrada de 
					e-mail e através da plataforma no painel de utilizador.<br />
                    No caso de alguma dúvida, poderá entrar em contato
                    conosco através de nosso e-mail, telefone ou redes sociais.<br />
					<br />
					 Entre agora na sua conta em: <a href="https://www.buscargo.pt">www.buscargo.pt</a> e fazer ';
        // $mail->sendMail($request->email,$subject,$message);

        //send sms  to driver ************************
        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //   CURLOPT_URL => 'https://api.sms.to/sms/send?api_key=51adGRs5IjBgkgzS9OvDcpJ4nKZZSig0&to=+917905107964&message=This%20is%20test%20and%20%250A%20this%20is%20a%20new%20line&sender_id=smsto',
        //   CURLOPT_RETURNTRANSFER => true,
        //   CURLOPT_ENCODING => '',
        //   CURLOPT_MAXREDIRS => 10,
        //   CURLOPT_TIMEOUT => 0,
        //   CURLOPT_FOLLOWLOCATION => true,
        //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //   CURLOPT_CUSTOMREQUEST => 'GET',
        // ));

        // $response = curl_exec($curl);

        // curl_close($curl);
        //echo $response;

        return User::create([
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
