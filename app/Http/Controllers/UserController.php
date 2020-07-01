<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\User;
use App\Feedback;
use App\Order;

class UserController extends Controller
{
    public function registersuccess(){
        Auth::logout();
        return redirect('/login')->with('success', 'Registration successful!');
     }

    
    
     public function storeuser(Request $request)
     {
         $this->validate($request, [
             'name' => 'required',
             'phone' => 'required|max:12|min:10',
             'type' => 'required',
             'email' => 'required|email',
             'password' => 'required',
         ]);
          $user = new User;
          $user->status = 0;
          $user->type = $request->input('type');
          $user->name = $request->input('name');
          $user->email = $request->input('email');         
          $user->phone_number = $request->input('phone');
          $user->is_super = 'N';
          $user->password = Hash::make($request->input('password'));
          $user->remember_token = sha1(time());         
          $user->save();
 
          return redirect()->back()->with('success', 'User added!');       
     }
 
 
     public function updateuser(Request $request, $id)
     {
         $this->validate($request, [
          'name' => 'required',
          'phone' => 'required|max:12|min:10',
          'type' => 'required',
          'email' => 'required|email',
          'password' => 'required',
      ]);
       $user = User::find($id);
       $user->name = $request->input('name');
       $user->email = $request->input('email');
       $user->phone_number = $request->input('phone');
       $user->type = $request->input('type');
       $user->password = Hash::make($request->input('password'));         
       $user->save();
 
       return redirect()->back()->with('success', 'User updated!');       
     }
 

     public function adminsearchuser(Request $request){
        $this->validate($request, [
            'search_term' => 'required',
        ]);  
        $term = $request->input('search_term');  
        $users =  User::where('type', 'HR')->orwhere('type', 'Driver')->orwhere('type', 'Procurement')->orwhere('type', 'Agricultural Officer')
            ->orwhere('type', 'Finance')->orwhere('type', 'Veterinary')->where(function($query) use($term){
                $query->where('name','LIKE','%'.$term.'%');
                $query->orWhere('phone_number','LIKE','%'.$term.'%');
                $query->orWhere('email','LIKE','%'.$term.'%');
                $query->orWhere('type','LIKE','%'.$term.'%');
            })
            ->orderBy('id','desc')
            ->get();
            
            $latestusers = User::orderBy('id','dsc')->get()->take(3);
            $feedbacks = Feedback::orderBy('id','dsc')->get(); 
            $deliveredproducts = Order::where('status', 3)->get();
            $staffs = $users;
            return view('dashboard')->with([
                'latestusers' => $latestusers,
                'users' => $users,
                'feedbacks' => $feedbacks,
                'staffs' => $staffs,
                'deliveredproducts' => $deliveredproducts,
                ]);
    }

     public function deleteuser($id)
     {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('error', 'User deleted!'); 
     }
 
     public function blockuser($id){
         $user = User::find($id);    
         if($user->is_super =='Y'){
             return redirect()->back()->with('error', 'Limited privilages to block this user');
         }else{
             $user->status = 0;
             $user->save();
             return redirect()->back()->with('success', 'User disapproved!');        
         }
     }
     
     public function unblockuser($id){
         $user = User::find($id);
         if($user->is_super =='Y'){
             return redirect()->back()->with('error', 'Limited privilages to unblock this user');
         }else{    
         $user->status = 1;
         $user->save();
         return redirect()->back()->with('info', 'User approved!');
         }
     }
}
