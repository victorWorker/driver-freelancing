<?php

namespace App\Http\Controllers\frontdash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Message;
use App\Subject;
use App\Events\MessageEvent;
use App\Events\GeneralEvent;
use App\Bids;
use App\Shipments;
use App\Http\Controllers\MailController;
use App\User;
class MessageController extends Controller
{

    public function sendMessage(Request $request, MailController $mail) {
        $user = $request->user('sanctum');
        $request->validate([
            'to_id' => 'required',
            'shipment_id' => 'required',
            'subject_id' => 'required',
            'messagebody' => 'required'
        ]);
        $x = preg_replace('/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/i','(Contact sharing is probihited. You will be blocked if you continue to share such messages.)',$request->messagebody); // extract email
        $x = preg_replace('/(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?/','(Contact sharing is probihited. You will be blocked if you continue to share such messages.)',$x); // extract phone
        $message = Message::create([
            'from_id' => $user->id,
            'to_id' => $request->to_id,
            'shipment_id' => $request->shipment_id,
            'subject_id' => $request->subject_id,
            'message' => $x,
            'addedd_by'=> "client",
        ]);
        $user = User::where('id', $request->to_id)->first();
        if($user->type="TRANSPORTER"){
            $button_url='https://www.buscargo.pt/transporter/dashboard/messages';
        }else{
            $button_url='https://www.buscargo.pt/user/dashboard/messages';
        }
        $subject = "Recebeu uma mensagem! ";
        $mailmessage = '<p>Acabou de receber uma mensagem na nossa plataforma! <br/> 
        Por favor, entre na sua conta em www.buscargo.pt e veja as suas mensagens no seus Dashboard!</p>
        <p style="text-align:center;margin-top:20px;"><button type="button" style="background:orange;color:white;padding:10px;border:0;">
            <a href="'.$button_url.'" style="text-decoration:none;color:white">Entrar na conta e ver mensagem</a></button></p>';
        $mail->sendMailtwo('raksshalini@gmail.com',$subject,$mailmessage);
        broadcast(new MessageEvent($message))->toOthers();
        $data = (object) [
            'user_id' => $request->to_id,
            'type' => 'new_message'
        ];
        broadcast(new GeneralEvent($data))->toOthers();
        return $message;
    }

    public function createdriverSubject(Request $request)
    {
        $user = $request->user('sanctum');
        $request->validate([
            'subject' => 'required',
            'message' => 'required'
        ]);

        $subject = Subject::create([
            'user_id' => $request->user_id,
            'driver_id' => $request->driver_id,
            'shipment_id' => $request->shipment_id,
            'title' => $request->subject,
            'addedd_by'=> "driver",
        ]);

        $x = preg_replace('/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/i','(Contact sharing is probihited. You will be blocked if you continue to share such messages.)',$request->message); // extract email
        $x = preg_replace('/(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?/','(Contact sharing is probihited. You will be blocked if you continue to share such messages.)',$x); // extract phone
        $message = Message::create([
            'from_id' => $request->driver_id,
            'to_id' => $request->user_id,
            'shipment_id' => $request->shipment_id,
            'subject_id' => $subject->id,
            'message' => $x
        ]);

        $bid = Bids::find($request->id);
        $bid->subject_id = $subject->id;
        return $bid->save();
    }

    public function createSubject(Request $request) {
        $user = $request->user('sanctum');
        $request->validate([
            'subject' => 'required',
            'message' => 'required'
        ]);

        $subject = Subject::create([
            'user_id' => $user->id,
            'driver_id' => $request->driver_id,
            'shipment_id' => $request->shipment_id,
            'title' => $request->subject,
            'addedd_by'=> $user->id,
        ]);
        
        $x = preg_replace('/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/i','(Contact sharing is probihited. You will be blocked if you continue to share such messages.)',$request->message); // extract email
        $x = preg_replace('/(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?/','(Contact sharing is probihited. You will be blocked if you continue to share such messages.)',$x); // extract phone
        $message = Message::create([
            'from_id' => $user->id,
            'to_id' => $request->driver_id,
            'shipment_id' => $request->shipment_id,
            'subject_id' => $subject->id,
            'message' => $x
        ]);

        $bid = Bids::find($request->bid_id);
        $bid->subject_id = $subject->id;
        return $bid->save();
    }

    public function getUnreadMessages(Request $request) {
       $user = $request->user('sanctum');
       
       $count = Message::where('to_id', $user->id)
                         ->where('status', 'UNREAD')
                         ->count(); 
       return $count;
    }

    public function setMessagesRead(Request $request) {
        $user = $request->user('sanctum');
        return Message::where('subject_id', $request->subject_id)
                 ->where('to_id', $user->id)
                 ->update([
                     'status' => 'READ'
                 ]);
    }

    public function getSubjects(Request $request) {
        $user = $request->user('sanctum');
        $subjects = Subject::with(['user:id,name', 'transporter:id,name'])
        ->where('driver_id', $user->id)
        ->orderBy('id','DESC')
        ->get();
        foreach($subjects as $key => $subject){
            $count = Message::where('subject_id', $subject->id)->where('to_id', $user->id)->where('status', 'UNREAD')->count();
            $checksendbyclient = Message::where('subject_id', $subject->id)->where('from_id', $subject->user_id)->count();
            $subject['count'] = $count;
            $subject['checksendbyclient'] = $checksendbyclient;
        }
        foreach($subjects as $key => $subject){
            $checkaward = Bids::where('driver_id', $subject->driver_id)->where('shipment_id', $subject->shipment_id)->get();
            $subject['checkaward'] = $checkaward;
        }
        return $subjects;
    }

    public function getUserSubjects(Request $request) {
        $user = $request->user('sanctum');
        $subjects = Subject::with(['user:id,name', 'transporter:id,name'])->where('user_id', $user->id)->orderBy('id','DESC')->get();
        foreach($subjects as $key => $subject){
            $count = Message::where('subject_id', $subject->id)->where('to_id', $user->id)->where('status', 'UNREAD')->count();
            $subject['count'] = $count;
        }
        foreach($subjects as $key => $subject){
            $checkaward = Bids::where('driver_id', $subject->driver_id)->where('shipment_id', $subject->shipment_id)->get();
            $subject['checkaward'] = $checkaward;
        }
        return $subjects;
    }

    public function getMessages(Request $request) {
        $user = $request->user('sanctum');
        $messages = Message::with(['fromUser:id,name', 'toUser:id,name', 'shipment:id,title'])
                            ->orderBy('id', 'ASC')
                            ->where('subject_id', $request->subject_id)
                            // ->where([
                            //     ['from_id','=', $user->id],
                            //     ['to_id','=',$request->to_id]
                            // ])->orWhere([
                            //     ['from_id','=', $request->to_id],
                            //     ['to_id','=',$user->id]
                            // ])
                            ->get();
        return $messages;
    }
}
