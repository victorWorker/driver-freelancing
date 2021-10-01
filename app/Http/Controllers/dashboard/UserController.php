<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use Illuminate\Http\Request;
use App\User;
use App\Transaction;
use App\Bids;

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
        return User::paginate(10);
    }

    public function getUsers() {
        return User::where('type', 'USER')->paginate(10);
    }
    public function getUser($id) {
        $user = User::find($id);
        $listing = $user->listings()->limit(5)->get();
        return ['details' => $user, 'listings' => $listing];
    }
    public function getTransporter($id) {
        $transporter = User::find($id);
        $bids = $transporter->bids()->limit(5)->get();
        return ['details' => $transporter, 'bids' => $bids];
    }
    public function get_user_by_id($userid){
          return User::where('id',$userid)->get();
        //return $user;
    }
    public function getTransporters() {
        return User::where('type', 'TRANSPORTER')->paginate(10);
    }
    public function getTransportersNoDocuments() {
        return User::where('type', 'TRANSPORTER')->whereNull('documents')->paginate(10);
    }
    public function banUser($id){
        $user = User::find($id);
        $user->status = 'UNAPPROVED';
        return $user->save();
    }
    public function setUserSms($id){
        $user = User::find($id);
        $user->is_send_sms = 'YES';
        return $user->save();
    }
    public function unsetUserSms($id){
        $user = User::find($id);
        $user->is_send_sms = 'NO';
        return $user->save();
    }
    public function sendCancelAccountEmail(MailController $mail){

        $users=User::where('type', 'TRANSPORTER')->whereNull('documents')->whereNull('cancel_account_email')->limit(6)->offset(0)->orderBy('id', 'DESC')->get();
        $subject='Notificação de cancelamento de conta';
        foreach($users as $user){
            $message='Ola '.$user->name. 
                    '<br><br>Se você não enviar seus documentos o mais rápido possível, sua conta será cancelada.';
            $send=$mail->sendMail('raksshalini@gmail.com', $subject, $message);
                if($send){
                    $user = User::find($user->id);
                    $user->cancel_account_email = 'send';
                    return $user->save();
                }else{
                    return false;
            }

        }
    }
    public function approveUser($id ,MailController $mail){
        $user = User::find($id);
        $subject = "Olá " . $user->name;
        $message = "Obrigado por se cadastrar no Buscargo. <br>De agora em diante, você receberá os melhores empregos em sua conta";
        $send=$mail->sendMail($user->email, $subject, $message);
        if($send){
            $user->status = 'APPROVED';
            return $user->save();
        }else{
            return false;
        }
        
    }

    public function updateUserBadge(Request $request) {

       $changes = [
                'badge' => $request->badge
            ];
        return User::where('id', $request->id)->update($changes);
    }

    public function searchUser(Request $request) {
        $user = User::select('name', 'email')->where('name', "LIKE", "%{$request->name}%")->where('type', '!=', 'ROOT')->get();
        return $user;
    }

    public function sendEmail(Request $request, MailController $mail) {
        $subject = $request->subject;
        $message = $request->message;
        $emails = $request->emails;
        foreach($emails as $email){
            // $messageHTML = $mail->setHTMLTemplate($subject, $message);
            $mail->sendMail($email['email'], $subject, $message);
        }
        return true;
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

       $user=User::find($id);
       $t1=Transaction::where('user_id',$id)->get();
       if($t1->count()){
        Transaction::where('user_id',$id)->delete();
       }
        $b1=Bids::where('driver_id',$id)->get();
       if($b1->count()){
        Bids::where('driver_id',$id)->delete();
       }
       return $user->delete();
    }
}
