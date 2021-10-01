<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Http\Controllers\MailController;

class LoginController extends Controller
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

    public function existEmail($email) {
        $get = User::where('email',$email)->first();
        return response(isset($get) ? 1 : 0);
    }

    public function login(Request $request){


        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return 'error';
        }
     //   echo "<pre>";
      //  print_r($user);die;
        if($user->type == 'TRANSPORTER'){
            $permission = 'transporter';
        }elseif($user->type == 'USER') {
            $permission = 'user';
        }elseif($user->type == 'ROOT'){
            $permission = 'admin';
        }
        $token =  $user->createToken('token-name',array($permission));
        return ($token == 'error') ? 'error' : ['token'=> $token->plainTextToken, 'user' => $user];
    }

    public function forgetpass(Request $request, MailController $mail){
        $user = User::where('email', $request->email)->first();

        if (! $user ) {
            return 'error';
        }
        if($user->type == 'TRANSPORTER'){
            $permission = 'transporter';
        }elseif($user->type == 'USER') {
            $permission = 'user';
        }elseif($user->type == 'ROOT'){
            $permission = 'admin';
        }
        $token =  $user->createToken('token-name',array($permission));
        $arr=explode("|",$token->plainTextToken);
        $message="";
        $message .= "<b>Email:</b> ".$request->email."<br />";
        $message .= "<b>Reset Password Link:</b><a style='color:white;' href='https://www.buscargo.pt/reset-password/".$arr[1]."'> https://www.buscargo.pt/reset-password/".$arr[1]."</a><br />";
        $mail->sendMail($request->email, "RESET YOUR PASSWORD", $message); 
        $user->remember_token=$arr[1];
        $user->save();
        return ($token == 'error') ? 'error' : ['token'=> $token->plainTextToken, 'user' => $user];
    }

    public function resetpass(Request $request){
        $user = User::where('remember_token', $request->id)->first();

        if (! $user) {
            return 'error';
        }
        if($request->password!=$request->cpassword){
            return 'error';
        }
        
        if($user->type == 'TRANSPORTER'){
            $permission = 'transporter';
        }elseif($user->type == 'USER') {
            $permission = 'user';
        }elseif($user->type == 'ROOT'){
            $permission = 'admin';
        }
        
        $token =  $user->createToken('token-name',array($permission));
        $user->password=Hash::make($request->password);
        $user->save();
        return ($token == 'error') ? 'error' : ['token'=> $token->plainTextToken, 'user' => $user];
    }


    public function logout(Request $request){
        return $request->user('sanctum')->currentAccessToken()->delete();
    }
}
