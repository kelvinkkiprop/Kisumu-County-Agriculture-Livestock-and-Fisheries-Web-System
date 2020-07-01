<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Service;
use App\OfferingService;
use App\Location;
use App\Order;

class ServicesController extends Controller
{

    public function services()
    {
       return view('normal-user.services');
    }

    public function requestedservices()
    {
        $services = Service::orderBy('id','dsc')->where('user', Auth::user()->id)->get();
        return view('normal-user.requested-services')->with([
            'services' =>  $services,
           ]);
    }

    public function requestservice()
    {
       
        $offeringservices = OfferingService::get();
        $locations = Location::get();
        if(Auth::user()->type!="Farmer"){
            return redirect()->back();
        }
        return view('normal-user.service-request')->with([
            'offeringservices' =>  $offeringservices,
            'locations' =>  $locations,
           ]);
    }

    public function storeservicerequest (Request $request)
    {
         $this -> validate($request, [
            'location'              =>      'required',         
            'service'               =>      'required',
            'comment'               =>      'required',
            'mpesacode'               =>      'required',
            
         ]);
         $service = new Service;
         $service->user = Auth::user()->id;
         $service->status = 0;  
         $service->service = OfferingService::where('chargesperhour', $request->input('service'))->first()->id; 
         $service->cost = OfferingService::where('chargesperhour', $request->input('service'))->first()->chargesperhour;  
         $service->location = $request -> input('location');
         $service->details = $request -> input('comment');
         $service->mpesacode = $request -> input('mpesacode');
         $service->save();
   
        return redirect()->back()->with('info', 'Service request submitted!');

    }



    public function updateservice ($id)
    {
         $service = Service::find($id);
         $service->status = 1;  
         $service->save();
   
        return redirect()->back()->with('info', 'Service updated!');

    }




}