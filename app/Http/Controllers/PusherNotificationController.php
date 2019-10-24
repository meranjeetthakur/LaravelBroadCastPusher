<?php

namespace App\Http\Controllers;
use Pusher;
use App\User;
use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PusherNotificationController extends Controller
{
    public function sendNotification()
    {
        $article_title =  str_random(10) ;
        $article = new Article;
        $article->title = $article_title;
        $article->save();
        $options = [
            'cluster' => 'ap2',
            'encrypted' => true
            ];

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'), $options
        );

        $message= $article_title . "record is created successfully!";
//        
        $logged_in_user = Auth::user();
        $users = User::all();
//        dd($users);
        foreach($users as $user)
        {
            if($user->id == 2)
            {
                $pusher->trigger('notification'.$user->id, 'notification-event', $message);
                return "A notification has been created successfully for". $logged_in_user->name;
            }
        }
        
//        $pusher->trigger('notification', 'notification-event', $message);
        return "A notification has been created successfully for ";
    }
    
    public function notification()
    {
        return view('notification');
    }
}
