<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Announcement;

class AnnouncementController extends Controller
{
    
    public function storeannouncement(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'shouter' => 'required',
            'description' => 'required',
            'expiry_date' => 'required|date|after_or_equal:today',
        ]);
         $announcement = new Announcement;
         $announcement->title = $request->input('title');
         $announcement->shouter = $request->input('shouter');
         $announcement->description = $request->input('description');
         $announcement->expiry_date = $request->input('expiry_date');         
         $announcement->save();

         return redirect()->back()->with('success', 'Announcement added!');       
    }


    public function updateannouncement(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'shouter' => 'required',
            'expiry_date' => 'required|date|after_or_equal:today',
        ]);
         $announcement = Announcement::find($id);;
         $announcement->title = $request->input('title');
         $announcement->shouter = $request->input('shouter');
         $announcement->description = $request->input('description');
         $announcement->expiry_date = $request->input('expiry_date');         
         $announcement->save();

         return redirect()->back()->with('info', 'Announcement updated!');       
    }

    public function deleteannouncement($id)
    {
       $announcement = Announcement::find($id);
       $announcement->delete();
       return redirect()->back()->with('error', 'Announcement deleted!'); 
    }
}
