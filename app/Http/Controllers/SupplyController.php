<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Supply;
use App\TenderApplication;
use App\Tender;
use App\Stock;

class SupplyController extends Controller
{
    public function storesupply(Request $request)
    {
        $this->validate($request, [
            'category' => 'required',
            'cost' => 'required',
            'quantity' => 'required',
            'details' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $picturename = '';
        if ($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                try {
                    $file = $request->file('image');
                    $picturename = time(). '.' . $file->getClientOriginalExtension();
                    $destinationPath = public_path('uploads/images');               
                    $request->file('image')->move($destinationPath, $picturename);
                    // return redirect()->back()->with('info', 'Image uploaded');
                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
                    return redirect()->back()->with('erro', ''.$e);
                }
            }
        }
         $supply = new Supply;         
         $supply->category = $request->input('category');
         $supply->cost = $request->input('cost');         
         $supply->quantity = $request->input('quantity');
         $supply->details = $request->input('details');
         $supply->image = $picturename;         
         $supply->save();

         return redirect()->back()->with('success', 'Products added!');       
    }

    public function suppliersearchsupply(Request $request){
        $this->validate($request, [
            'search_term' => 'required',
        ]);  
        $term = $request->input('search_term');  
        $supplies =  Supply::where(function($query) use($term){
                $query->where('category','LIKE','%'.$term.'%');
                $query->orWhere('cost','LIKE','%'.$term.'%');
                $query->orWhere('quantity','LIKE','%'.$term.'%');
                $query->orWhere('details','LIKE','%'.$term.'%');
            })
            ->orderBy('id','desc')
            ->get();
            $recentsupplies = Supply::orderBy('id','asc')->get()->take(3);   
            $approvedsupplies = Supply::orderBy('id','asc')->where('status',1)->get(); 
            $pendingsupplies = Supply::orderBy('id','asc')->where('status',0)->get(); 
            $declinedsupplies = Supply::orderBy('id','asc')->where('status',2)->get();    
            return view('supplier')->with([
                'recentsupplies' => $recentsupplies, 
                'supplies' => $supplies,
                'approvedsupplies' => $approvedsupplies, 
                'pendingsupplies' => $pendingsupplies,
                'declinedsupplies' => $declinedsupplies,
                ]);
    }

    

    public function approvesupply($id)
    {
         $supply = Supply::find($id);
         //Get existing stock
        $stocks = Stock::where('category', $supply->category)->get()->first();
        $existingstock = Stock::where('category', $supply->category)->get()->first();
            // return $existingstock->id;
        if (!$stocks){
            //return redirect()->back()->with('success', 'haiko!'); 
            $stock = new Stock;         
            $stock->category = $supply->category;
            $stock->cost = $supply->cost;         
            $stock->quantity = $supply->quantity;
            $stock->details = $supply->details;
            $stock->image = $supply->image; 
            $stock->status = 1;         
            $stock->save();
            $supply->status = 1;
            $supply->save();
            return redirect()->back()->with('success', 'Supply approved...Stock added!');
         }else{
           //return redirect()->back()->with('info', 'iko!');
            $stock = Stock::find($existingstock->id);
            $stock->quantity = $existingstock->quantity+$supply->quantity;
            $stock->status = 1;  
            $stock->save(); 
            $supply->status = 1;
            $supply->save();
            return redirect()->back()->with('success', 'Supply approved...Stock increased!');
         }

    }

    public function declinesupply($id)
    {
        $supply = Supply::find($id);
        //Get existing stock
       $stocks = Stock::where('category', $supply->category)->get()->first();
       $existingstock = Stock::where('category', $supply->category)->get()->first();
           // return $existingstock->id;
       if (!$stocks){
           //return redirect()->back()->with('success', 'haiko!'); 
           $supply->status = 2;
           $supply->save();
           return redirect()->back()->with('danger', 'Supply declined!');
        }else{
          //return redirect()->back()->with('info', 'iko!');
           $stock = Stock::find($existingstock->id);
           $stock->quantity = $existingstock->quantity-$supply->quantity;
           $stock->save(); 
           $supply->status = 2;
           $supply->save();
           return redirect()->back()->with('warning', 'Supply decline...Stock reduced!');
        }    
    }



    public function procurementsearchsupply(Request $request){
        $this->validate($request, [
            'search_term' => 'required',
        ]);  
        $term = $request->input('search_term');  
        $supplies =  Supply::where(function($query) use($term){
                $query->where('category','LIKE','%'.$term.'%');
                $query->orWhere('cost','LIKE','%'.$term.'%');
                $query->orWhere('quantity','LIKE','%'.$term.'%');
                $query->orWhere('details','LIKE','%'.$term.'%');
            })
            ->orderBy('id','desc')
            ->get();

            $tenderapplications = TenderApplication::orderBy('id','dsc')->get();
            $pendingsupplies = Supply::where('status',0)->get();
            $tenders = Tender::orderBy('id','dsc')->get(); 
            $latestsupplies =  Supply::orderBy('id','dsc')->get()->take(3);   
            return view('procurement')->with([
                'tenderapplications' => $tenderapplications,
                'tenders' => $tenders,
                'supplies' => $supplies,
                'pendingsupplies' => $pendingsupplies,
                'latestsupplies'=> $latestsupplies,
            ]);

    }



}
