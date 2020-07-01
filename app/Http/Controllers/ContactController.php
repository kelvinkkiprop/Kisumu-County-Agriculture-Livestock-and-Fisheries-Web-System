<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    
    public function contact()
    {
      return view('normal-user.contact');
    }

    public function sendemail(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $data = [
          'no-reply' => 'contact-from-web@nomail.com',
          'admin'    => 'kelvinkiprop5@gmail.com',
          'name'    => $request->get('name'),
          'email'    => $request->get('email'),
          'subject'    => $request->get('subject'),
          'message'    => $request->get('message'),
      ];

      \Mail::send('normal-user.contact', ['data' => $data],
          function ($message) use ($data)
          {
              $message
                  ->from($data['no-reply'])
                  ->to($data['admin'])->subject('Some body wrote to you online')
                  ->to($data['email'])->subject('Your submitted information')
                  ->to('kelvinkiprop5@gmail.com', 'kelvinkiprop')->subject('Feedback');
          });

         return redirect()->back()->with('success', 'Tender added!');       
    }

}
