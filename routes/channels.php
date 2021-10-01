<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('chat.{subject_id}', function ($user, $subject_id) {
    // if( Auth::check()){
        // var_dump($subject_id);
        return ['id' => $user->id,'name' => $user->name];
    // }   
});

Broadcast::channel('general.{user_id}', function ($user, $user_id) {
    // if( Auth::check()){
        // var_dump($subject_id);
        return ['id' => $user->id,'name' => $user->name];
    // }   
});