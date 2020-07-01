<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Validator;
use App\Profile; 
use App\Location; 

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
         //Show profile info
        if (Auth::user()->type == 'Admin'){
            return redirect('/welcome');

        }else{

            $id = Auth::user()->id;   
            $profile = Profile::where('user_id', $id)->get()->first();
                //return $profile; 
            if (!$profile){
                $locations = Location::get();
                // return $locations;
                return view('normal-user.create-profile')->with([
                    'locations'=>$locations,

                ]);            
            }else{ 
                return view('normal-user.view-profile')->with('profile', $profile);
                
            }
        }
        
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('normal-user.create-profile');  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //print_r($request->input());
        
         //Validate input
         $this -> validate($request, [
            'dob'                   =>      'required|date|after_or_equal:today',
            'location'              =>      'required',         
            'gender'                =>      'required',
            'phone'                 =>      'required|max:12|min:10',
            'picture'               =>      'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
         ]);
         $picturename = '';
         if ($request->hasFile('picture')) {
             if($request->file('picture')->isValid()) {
                 try {
                     $file = $request->file('picture');
                     $picturename = time(). '.' . $file->getClientOriginalExtension();
                     $destinationPath = public_path('uploads/images');               
                     $request->file('picture')->move($destinationPath, $picturename);
                     // return redirect()->back()->with('info', 'Image uploaded');
                 } catch (Illuminate\Filesystem\FileNotFoundException $e) {
                     return redirect()->back()->with('erro', ''.$e);
                 }
             }
         }

         $profile = new Profile;
         $profile->user_id = Auth::user()->id;
         $profile->picture = $picturename;  
         $profile->dob = $request -> input('dob');
         $profile->gender = $request -> input('gender');
         $profile->phone = $request -> input('phone');
         $profile->location = $request -> input('location');
         $profile->save();
   
        return redirect()->back()->with('info', 'Profile created!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::find($id);
       // return $profile;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile =Profile::find($id);
        //return $profile;
        $locations = Location::get();
        // return $locations;
        return view('normal-user.edit-profile')->with([
            'locations'=>$locations,
            'profile'=> $profile

        ]);


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
        //Update profile
        $this -> validate($request, [
            'dob'                   =>      'required|date|after_or_equal:today',
            'location'              =>      'required',         
            'gender'                =>      'required',
            'phone'                 =>      'required|max:12|min:10',
            'picture'               =>      'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
         ]);
         $picturename = '';
         if ($request->hasFile('picture')) {
             if($request->file('picture')->isValid()) {
                 try {
                     $file = $request->file('picture');
                     $picturename = time(). '.' . $file->getClientOriginalExtension();
                     $destinationPath = public_path('uploads/images');               
                     $request->file('picture')->move($destinationPath, $picturename);
                     // return redirect()->back()->with('info', 'Image uploaded');
                 } catch (Illuminate\Filesystem\FileNotFoundException $e) {
                     return redirect()->back()->with('erro', ''.$e);
                 }
             }
         }
         $profile = Profile::find($id);
         $profile->user_id = Auth::user()->id;
         $profile->picture = $picturename;  
         $profile->dob = $request -> input('dob');
         $profile->gender = $request -> input('gender');
         $profile->phone = $request -> input('phone');
         $profile->location = $request -> input('location');
         $profile->save();
        return redirect('/profile')->with('info', 'Profile updated!');

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
    }
}
