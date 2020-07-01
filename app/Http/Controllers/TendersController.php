<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tender;
use App\TenderApplication;
use Auth;

class TendersController extends Controller
{
    
    public function storetender(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'closing_date' => 'required|date|after_or_equal:today',
        ]);
         $tender = new Tender;
         $tender->title = $request->input('title');
         $tender->description = $request->input('description');
         $tender->closing_date = $request->input('closing_date');         
         $tender->save();

         return redirect()->back()->with('success', 'Tender added!');       
    }


    public function updatetender(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'closing_date' => 'required|date|after_or_equal:today',
        ]);
         $tender = Tender::find($id);;
         $tender->title = $request->input('title');
         $tender->description = $request->input('description');
         $tender->closing_date = $request->input('closing_date');         
         $tender->save();

         return redirect()->back()->with('info', 'Tender updated!');       
    }

    public function deletetender($id)
    {
       $tender = Tender::find($id);
       $tender->delete();
       return redirect()->back()->with('error', 'Tender deleted!'); 
    }


    public function tenders()
    {
        $tenders = Tender::paginate(5);

        return view('normal-user.tenders')->with([
            'tenders' => $tenders,
        ]);
        
    }


    public function applytender()
    {
        $availabletenders = Tender::all();
        return view('normal-user.apply-tender')->with([
            'availabletenders' => $availabletenders,
        ]);
    }



    public function tenderapplication(Request $request)
    {
        //Update profile
        $this -> validate($request, [
            'tender'                 =>      'required',         
            'description'            =>      'required',
            'certificate'            =>      'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
         ]);
         $picturename = '';
         if ($request->hasFile('certificate')) {
             if($request->file('certificate')->isValid()) {
                 try {
                     $file = $request->file('certificate');
                     $picturename = time(). '.' . $file->getClientOriginalExtension();
                     $destinationPath = public_path('uploads/images');               
                     $request->file('certificate')->move($destinationPath, $picturename);
                     // return redirect()->back()->with('info', 'Image uploaded');
                 } catch (Illuminate\Filesystem\FileNotFoundException $e) {
                     return redirect()->back()->with('erro', ''.$e);
                 }
             }
         }
         $tender = new TenderApplication;
         $tender->user = Auth::user()->id;
         $tender->certificate = $picturename;  
         $tender->description = $request -> input('description');
         $tender->tender = $request -> input('tender');
         $tender->save();
        return redirect()->back()->with('success', 'Tender application success!');

    }

    public function approvetender($id){
        $tender1 = TenderApplication::find($id);
        $tender1->status = 1;
        $tender1->save();
        return redirect()->back()->with('success', 'Tender approved!');        
    }
    
    public function disapprovetender($id){
        $tender2 = TenderApplication::find($id);
        $tender2->status = 0;
        $tender2->save();
        return redirect()->back()->with('error', 'Tender disapproved!'); 
    }

}
