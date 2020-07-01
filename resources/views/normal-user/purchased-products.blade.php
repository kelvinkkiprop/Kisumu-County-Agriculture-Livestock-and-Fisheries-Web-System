@extends('layouts.auth')

    @section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-m fa-2x">&nbsp;Purchased Products({{$products->count()}})</i>
                    </div>

                    <div class="card-body">                      
                                          
                            @if(count($products) > 0 )                             
                                @foreach($products as $product)                
                                    <div class="card mt-4">  
                                        <div class="row p-4">                                   
                                            <div class="col-md-4">                                             
                                                <h6><strong>Item:</strong></h6>                               
                                                <h6><strong>Quantity:</strong></h6>
                                                <h6><strong>Cost:</strong></h6>
                                                <h6><strong>Date:</strong></h6>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted">{{App\Stock::where('id', $product->item)->get()->first()->name}}</h6>
                                                <h6 class="text-muted">{{$product->quantity}}</h6> 
                                                <h6 class="text-muted">{{App\Stock::where('id', $product->item)->get()->first()->cost}}</h6>  
                                                <h6 class="text-muted"><small>{{$product->created_at}}</small></h6>                                       
                                            </div>
                                            <div class="col-md-2">
                                                <a href="#" class="btn btn-info">
                                                <i class="fas fa-newspaper fa-1x ">&nbsp;Print</i>
                                            </a>   
                                            </div>
                                        </div> 
                                    </div>                         
                                @endforeach                                
                            @else 
                                <div class="p-2">
                                    <h5 class="text-center text-black-50">You have 0 purchased items</h5>
                                </div>                                
                            @endif 

                        </div>
                     
                    <div class="card-footer">
                        <p></p>
                    </div>


                </div>
            </div>
        </div>
    </div>
    @endsection