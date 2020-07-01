<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Stock;
use App\TenderApplication;
use App\Tender;

class StockController extends Controller
{
    public function storestock(Request $request)
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
         $stock = new Stock;         
         $stock->category = $request->input('category');        
         $stock->quantity = $request->input('quantity');
         $stock->cost = $request->input('quantity') * $request->input('cost'); 
         $stock->details = $request->input('details');
         $stock->image = $picturename;         
         $stock->save();

         return redirect()->back()->with('success', 'Stock added!');       
    }


    // public function updatestock(Request $request, $id)
    // {
    //     $this->validate($request, [
    //         'category' => 'required',
    //         'cost' => 'required',
    //         'quantity' => 'required',
    //         'details' => 'required',
    //         'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     $picturename = '';
    //     if ($request->hasFile('image')) {
    //         if($request->file('image')->isValid()) {
    //             try {
    //                 $file = $request->file('image');
    //                 $picturename = time(). '.' . $file->getClientOriginalExtension();
    //                 $destinationPath = public_path('uploads/images');               
    //                 $request->file('image')->move($destinationPath, $picturename);
    //                 // return redirect()->back()->with('info', 'Image uploaded');
    //             } catch (Illuminate\Filesystem\FileNotFoundException $e) {
    //                 return redirect()->back()->with('erro', ''.$e);
    //             }
    //         }
    //     }
    //      $stock = Stock::find($id);         
    //      $stock->category = $request->input('category');
    //      $stock->cost = $request->input('cost');         
    //      $stock->quantity = $request->input('quantity');
    //      $stock->details = $request->input('details');
    //      $stock->image = $picturename;         
    //      $stock->save();

    //      return redirect()->back()->with('success', 'Stock updated!');       
    // }



    public function procurementsearchstock(Request $request){
        $this->validate($request, [
            'search_term' => 'required',
        ]);  
        $term = $request->input('search_term');  
        $stocks =  Stock::where(function($query) use($term){
                $query->where('category','LIKE','%'.$term.'%');
                $query->orWhere('cost','LIKE','%'.$term.'%');
                $query->orWhere('quantity','LIKE','%'.$term.'%');
                $query->orWhere('details','LIKE','%'.$term.'%');
            })
            ->orderBy('id','desc')
            ->get();
            $tenderapplications = TenderApplication::orderBy('id','dsc')->get();
            $tenders = Tender::orderBy('id','dsc')->get();   
            return view('procurement')->with([
                'tenderapplications' => $tenderapplications,
                'tenders' => $tenders,
                'stocks' => $stocks,
                ]);
    }


    public function suppliersearchstock(Request $request){
        $this->validate($request, [
            'search_term' => 'required',
        ]);  
        $term = $request->input('search_term');  
        $stocks =  Stock::where(function($query) use($term){
                $query->where('category','LIKE','%'.$term.'%');
                $query->orWhere('cost','LIKE','%'.$term.'%');
                $query->orWhere('quantity','LIKE','%'.$term.'%');
                $query->orWhere('details','LIKE','%'.$term.'%');
            })
            ->orderBy('id','desc')
            ->get();
            $recentstocks = Stock::orderBy('id','asc')->get()->take(3);   
            $approvedstocks = Stock::orderBy('id','asc')->where('status',1)->get(); 
            $pendingstocks = Stock::orderBy('id','asc')->where('status',0)->get();    
            return view('supplier')->with([
                'recentstocks' => $recentstocks, 
                'stocks' => $stocks,
                'approvedstocks' => $approvedstocks, 
                'pendingstocks' => $pendingstocks,
                ]);
    }
                

}
