<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Updates;

class UpdatesController extends Controller
{
    public function storeupdate(Request $request)
    {
        $this->validate($request, [
            'caption' => 'required',
            'details' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
         $update = new Updates;
         $update->caption = $request->input('caption');
         $update->details = $request->input('details');
         $imagename = '';
        if ($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                try {
                    $file = $request->file('image');
                    $imagename = time(). '.' . $file->getClientOriginalExtension();
                    $destinationPath = public_path('uploads/images');               
                    $request->file('image')->move($destinationPath, $imagename);
                    // return redirect('/welcome')->with('info', 'Image uploaded');
                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
                    return redirect('welcome')->with('erro', ''.$e);
                }
            }
        }
         $update->image = $imagename;         
         $update->save();

         return redirect()->back()->with('success', 'Update added!');       
    }


    public function updateupdate(Request $request, $id)
    {
        $this->validate($request, [
            'caption' => 'required',
            'details' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
         $update = Updates::find($id);;
         $update->caption = $request->input('caption');
         $update->details = $request->input('details');
         $imagename = '';
        if ($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                try {
                    $file = $request->file('image');
                    $imagename = time(). '.' . $file->getClientOriginalExtension();
                    $destinationPath = public_path('uploads/images');               
                    $request->file('image')->move($destinationPath, $imagename);
                    // return redirect('/welcome')->with('info', 'Image uploaded');
                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
                    return redirect('welcome')->with('erro', ''.$e);
                }
            }
        }
         $update->image = $imagename;         
         $update->save();

         return redirect()->back()->with('info', 'Update saved!');       
    }

    public function deleteupdate($id)
    {
       $update = Updates::find($id);
       $update->delete();
       return redirect()->back()->with('error', 'Update deleted!'); 
    }

}