<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\User;
use App\Tender;
use App\Vacancy;
use App\Announcement;
use App\Updates;
use App\Order;
use App\Stock;
use App\Cart;
use App\Service;
use App\Location;
use App\Feedback;
use App\TenderApplication;
use App\Payment;
use App\VacancyApplication;
use App\Supply;
use App\DriverCharges;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function welcome()
    {
         if (Auth::user()->type == 'Admin' && Auth::user()->status == 1){
            $latestusers = User::orderBy('id','dsc')->get()->take(3);
            $users = User::orderBy('id','dsc')->get();
            $deliveredproducts = Order::where('status', 3)->get();
            $feedbacks = Feedback::orderBy('id','dsc')->get(); 
            $staffs = User::where('type', 'HR')->orwhere('type', 'Procurement')->orwhere('type', 'Driver')
                ->orwhere('type', 'Veterinary')->orwhere('type', 'Finance')
                ->orwhere('type', 'Agricultural Officer')->get();
            //return $staff;  
            return view('dashboard')->with([
                'latestusers' => $latestusers,
                'users' => $users,
                'feedbacks' => $feedbacks,
                'staffs' => $staffs,
                'deliveredproducts' => $deliveredproducts,
            ]);
        }else if (Auth::user()->type == 'Supplier' && Auth::user()->status == 1 ){
            $recentsupplies = Supply::orderBy('id','dsc')->get()->take(3);
            $supplies = Supply::orderBy('id','dsc')->get();    
            $approvedsupplies = Supply::orderBy('id','dsc')->where('status',1)->get(); 
            $pendingsupplies = Supply::orderBy('id','dsc')->where('status',0)->get();  
            $declinedsupplies = Supply::orderBy('id','dsc')->where('status',2)->get();            
            return view('supplier')->with([
                'recentsupplies' => $recentsupplies, 
                'supplies' => $supplies,
                'approvedsupplies' => $approvedsupplies, 
                'pendingsupplies' => $pendingsupplies,
                'declinedsupplies' => $declinedsupplies,
            ]);  
        }else if (Auth::user()->type == 'HR' && Auth::user()->status == 1){
            $feedbacks = Feedback::orderBy('id','dsc')->get();
            $updates = Updates::orderBy('id','dsc')->get();
            $announcements = Announcement::orderBy('id','dsc')->get();
            $vacancies = Vacancy::orderBy('id','dsc')->get();;
            $tenders = Tender::orderBy('id','dsc')->get();
            $vacanyapplications = VacancyApplication::orderBy('id','dsc')->get();
    
            return view('hr')->with([
                'feedbacks' => $feedbacks,
                'updates' => $updates,
                'announcements' => $announcements,
                'vacancies' => $vacancies,
                'tenders' => $tenders,
                'vacanyapplications' => $vacanyapplications,
            ]);

        }else if (Auth::user()->type == 'Procurement' && Auth::user()->status == 1){
            $tenderapplications = TenderApplication::orderBy('id','dsc')->get();
            $pendingsupplies = Supply::where('status',0)->get();
            $tenders = Tender::orderBy('id','dsc')->get(); 
            $supplies = Supply::orderBy('id','dsc')->get(); 
            $stocks = Stock::orderBy('id','dsc')->get(); 
            $latestsupplies =  Supply::orderBy('id','dsc')->get()->take(3);   
            return view('procurement')->with([
                'tenderapplications' => $tenderapplications,
                'tenders' => $tenders,
                'supplies' => $supplies,
                'pendingsupplies' => $pendingsupplies,
                'latestsupplies'=> $latestsupplies,
                'stocks'=> $stocks,
            ]);

        }else if (Auth::user()->type == 'Farmer' && Auth::user()->status == 1 ){
            // return $stocks;
            $products = Stock::orderBy('id','dsc')->where('status', 1)->where('quantity', '>', 0)->get();
            $carts = Cart::get()->where('user',Auth::user()->id);
            $locations = Location::get();
            return view('normal-user.products')->with([   
                'products' => $products,
                'carts' => $carts,
                'locations'=>$locations,
            ]);
       
        }else if (Auth::user()->type == 'Finance' && Auth::user()->status == 1 ){
            $availableproducts = Stock::orderBy('id','dsc')->paginate(3);
            $orders = Order::get();
            $supplies = Supply::get();
            $recentpayments = Order::get()->take(3);
            return view('finance')->with([   
                'availableproducts' => $availableproducts,
                'orders' => $orders,
                'supplies' => $supplies,
                'recentpayments' => $recentpayments,
            ]); 
            
        }else if (Auth::user()->type == 'Driver' && Auth::user()->status == 1 ){
            $recentorders = Order::orderBy('id','dsc')->where('driver_charges', DriverCharges::where('id', Auth::user()->id)
            ->get()->first()->charges)->get();
            $pendingproducts = Order::orderBy('id','dsc')->where('status',1)->where('delivery',0)
                ->where('driver_charges', DriverCharges::where('id', Auth::user()->id)->get()->first()->charges) ->get();
           //return $pendingproducts;
            $deliveredproducts = Order::orderBy('id','dsc')->where('status',1)->where('delivery',1)
                ->where('driver_charges', DriverCharges::where('id', Auth::user()->id)->get()->first()->charges)->get();
            return view('driver')->with([   
                'recentorders' => $recentorders,
                'pendingproducts' => $pendingproducts,
                'deliveredproducts' => $deliveredproducts,
            ]); 
            
        }else if (Auth::user()->type == 'Agricultural Officer' && Auth::user()->status == 1 ){
            $recentrequests = Service::orderBy('id','dsc')->where('service', 1)->get()->take(3);
            $requests = Service::orderBy('id','dsc')->where('service', 1)->get();
            $pendingservices = Service::where('status', 0)->where('service', 1)->orderBy('id','dsc')->get();
            $deliveredservices = Service::where('status', 1)->where('service', 1)->orderBy('id','dsc')->get();
            return view('agricultural-officer')->with([
                'recentrequests' => $recentrequests,                
                'requests' => $requests,
                'pendingservices' => $pendingservices,
                'deliveredservices' => $deliveredservices,
            ]);
 
            
        }
        else if (Auth::user()->type == 'Veterinary' && Auth::user()->status == 1 ){
            $recentrequests = Service::orderBy('id','dsc')->where('service', 2)->get()->take(3);
            $requests = Service::orderBy('id','dsc')->where('service', 2)->get();
            $pendingservices = Service::where('status', 0)->where('service', 2)->orderBy('id','dsc')->get();
            $deliveredservices = Service::where('status', 1)->where('service', 2)->orderBy('id','dsc')->get();
            return view('vertinary')->with([
                'recentrequests' => $recentrequests,                
                'requests' => $requests,
                'pendingservices' => $pendingservices,
                'deliveredservices' => $deliveredservices,
            ]);
 
            
        }
        else {
            return view('common.notyetapproved');
 
            
        }
    }





    public function acceptstock($id){
        $stock = Stock::find($id);
        $stock->status = 1;
        $stock->save();
        return redirect()->back()->with('success', 'Stock accepted!');        
    }
    
    public function declinestock($id){
        $stock = Stock::find($id);
        $stock->status = 3;
        $stock->save();
        return redirect()->back()->with('info', 'Stock declined!'); 
    }


}
