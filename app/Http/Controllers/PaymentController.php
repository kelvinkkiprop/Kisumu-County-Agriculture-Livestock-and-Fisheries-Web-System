<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Stock;
use App\Cart;
use App\Location;
use App\Payment;
use App\Service;
use App\Order;

class PaymentController extends Controller
{
    public function approvepayment($id)
    {
        $payment = Order::find($id);
        $stock = Stock::where('category', $payment->category)->get()->first();        
        $stock->quantity = $stock->quantity - $payment->quantity;
        $stock->save();
        $payment->status = 1;
        $payment->save();
        return redirect()->back()->with('info', 'Payment approved!');
        
    }

    public function disapprovepayment($id)
    {
        $payment = Order::find($id);
        $stock = Stock::where('category', $payment->category)->get()->first();        
        $stock->quantity = $stock->quantity + $payment->quantity;
        $stock->save();
        $payment->status = 0;
        $payment->save();
        return redirect()->back()->with('info', 'Payment dispproved!');
        
    }



    public function receipts()
    {
        $productsreceipts = Order::where('user', Auth::user()->id)->get();
        //return $productsreceipts;
        $receipts = Order::where('user', Auth::user()->id)
        ->select('id','receipt_no','category')->groupBy('receipt_no')->get();
        //return $receipts;
        $servicereceipts = Service::where('user', Auth::user()->id)->get();
        return view('normal-user.receipts')->with([
            'servicereceipts' =>  $servicereceipts,
            'productsreceipts' =>  $productsreceipts,
            'receipts' =>  $receipts,
           ]); 
    }


    public function printreceiptproduct($id)
    {
        $products = Order::where('receipt_no', $id)->get();
       // return $product;
        return view('normal-user.single-receipt')->with([
            'products'=>$products,
        ]);
    }

    public function printreceiptservice($id)
    {
        $service = Service::find($id);
        //return $receipt;
        return view('normal-user.single-receipt-service')->with([
            'service'=>$service,
        ]);
    }

    
}
