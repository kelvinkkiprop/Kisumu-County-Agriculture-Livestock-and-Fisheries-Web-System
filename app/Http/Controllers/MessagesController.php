<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Message;
use App\Feedback;

class MessagesController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sendmessage(Request $request, $recipient, $feedback)
    {
        //Update profile
        $this -> validate($request, [
            'message'              =>      'required',         
            
         ]);
 
         $message = new Message();
         $message->sender = Auth::user()->id;
         $message->recipient = $recipient;
         $message->feedback = $feedback;

         $feedback = Feedback::find($feedback);
         $feedback->status = 1;
         $feedback->save();

         $message->message = $request -> input('message');
         $message->save();
         return redirect()->back()->with('success', 'Message sent!');

    }

}
