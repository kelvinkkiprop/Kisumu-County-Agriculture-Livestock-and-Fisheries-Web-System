<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Stock;
use App\Cart;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function products()
    {
        $carts = Cart::orderBy('user',Auth::user()->id)->get();
        $products = Stock::orderBy('id','dsc')->where('status', 1)->where('quantity', '>', 0)->get();
        //return $products;
 
       return view('normal-user.products')->with([
        'products' =>  $products,
        'carts' =>  $carts,
       ]);

    }


    public function searchproducts(Request $request){
        $this->validate($request, [
            'search_term' => 'required',
        ]);  
        $term = $request->input('search_term');  
        $products =  Stock::where('status', 1)->where(function($query) use($term){
                $query->where('category','LIKE','%'.$term.'%');
                $query->orWhere('cost','LIKE','%'.$term.'%');
                $query->orWhere('details','LIKE','%'.$term.'%');
            })
            ->orderBy('id','desc')
            ->get();
            $carts = Cart::orderBy('user',Auth::user()->id)->get();
            
            return view('normal-user.products')->with([
                'products' => $products,
                'carts' =>  $carts,
                ]);
    }
    
}