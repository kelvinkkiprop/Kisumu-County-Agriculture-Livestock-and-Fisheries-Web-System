<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Feedback;
use App\Message;

class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function feedback()
    {
        if(Auth::user()->type=="Farmer"){
            return view('normal-user.feedback');
        }else{
            return redirect()->back();
        }
    }

    public function storefeedback(Request $request)
    {
        $this -> validate($request, [
            'subject'              =>      'required',
            'message'               =>      'required',
            
         ]);
         $feedback = new Feedback;
         $feedback->sender = Auth::user()->id;
         $feedback->email = Auth::user()->email;
         $feedback->subject = $request -> input('subject');
         $feedback->message = $request -> input('message');
         $feedback->save();
        return redirect()->back()->with('success', 'Feedback sent!');
    }


    public function viewfeedbackreplys()
    {
        $feedbacks = Feedback::orderBy('id', 'dsc')->where('sender', Auth::user()->id)->get();
        return view('normal-user.feedbackreplys')->with([
            'feedbacks'=>$feedbacks,
        ]);
    }
}
