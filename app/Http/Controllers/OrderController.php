<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\Cart;
use App\Location;
use App\Stock;
use App\DriverCharges;


class OrderController extends Controller
{
    
    public function addproducttocart(Request $request, $id)
    {
         //return $cartdata;
         $this -> validate($request, [
            'quantity'              =>      'required|integer|min:1',            
         ]);
        $product = Stock::find($id);
        $number = $request->input('quantity');
        if($product->quantity>0){
            // $product->number = $product->number-1;
            // $product->save();
           // return redirect()->back()->with('info', 'Product quantity reduced by one!');
            $cart = new Cart();
            $cart->user = Auth::user()->id;
            $cart->category = $product->category;
            $cart->cost = ($product->cost/$product->quantity) * $number;     
            $cart->quantity = $number;           
            $cart->details = $product->details;            
            $cart->image = $product->image;      
            $cart->save();
            return redirect()->back()->with('info', 'Item(s) added to cart!'); 
        }else{
            return redirect()->back()->with('error', 'Failed to add item to cart!'); 
        }
    }

    public function removeitemfromcart($id)
    {
        $item = Cart::find($id);
        $item->delete();
        return redirect()->back()->with('warning', 'Item removed from the cart!');
    }

    public function makeorder()
    {
        $carts = Cart::orderBy('user',Auth::user()->id)->get();
        $locations = Location::all();
        $drivers = DriverCharges::all();
        
    return view('normal-user.makeorder')->with([
        'carts' =>  $carts,
        'locations' =>  $locations,
        'drivers' =>  $drivers,
    ]);

    }

    public function storeorder(Request $request)
    {

        //return $cartdata;
        $this -> validate($request, [
            'driver'              =>      'required',
            'location'              =>      'required',   
            'mpesacode'              =>      'required',            
         ]);

         //Save order
        $cartdata = Cart::where('user', Auth::user()->id)->get();
        $receipt_no = time();
        //return $cartdata;
        $finalArray = array();
        foreach($cartdata as $key=>$value){
           array_push($finalArray, array(
                'user'=>Auth::user()->id,
                'category'=>$value['category'],
                'cost'=>$value['cost'],
                'quantity'=> $value['quantity'],                
                'details'=>$value['details'],
                'image'=> $value['image'],                
                'location'=> $request->input('location'),
                'status'=> 0, 
                'mpesacode'=> $request->input('mpesacode'),  
                'driver_charges'=> $request->input('driver'),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
                'receipt_no'=>$receipt_no,
                  )
           );

        }
        //return $finalArray;
        Order::insert($finalArray); 
       // Stock::where('category', $value['category'])->decrement('quantity');   
        
        //Delete cart data 
        Cart::where('user', Auth::user()->id)->delete();
        return redirect('products')->with('success', 'Order submitted for verification!');
    }


    public function confirmorderdelivered($id)
    {
        $delivered = Order::find($id);
        $delivered->delivery = 1;
        $delivered->save();
        return redirect()->back()->with('info', 'Confirmaton recorded!');
    }
    public function disconfirmorderdelivered($id)
    {
        $delivered = Order::find($id);
        $delivered->delivery = 0;
        $delivered->save();
        return redirect()->back()->with('info', 'Confirmaton undone!');
    }


    public function confirmdelivery()
    {
    $products = Order::where('user', Auth::user()->id)->where('status', 1)->where('delivery', 1)
        ->where('userconfirmdelivery', 0)->get();
     return view('normal-user.confirm-delivery')->with([
         'products'=>$products,
     ]);
    }
    
    public function userconfirmdelivery($id)
    {
        $delivered = Order::find($id);
        $delivered->userconfirmdelivery = 1;
        $delivered->save();
        return redirect()->back()->with('info', 'Delivery confirmed!');
    }
    
}

