@extends('layouts.auth')

    @section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-praying-hands fa-2x">&nbsp;Confirmed Products Delivery({{$products->count()}})</i>
                    </div>

                    <div class="card-body">                      
                                          
                            @if(count($products) > 0 )                  
                            <div class="card mt-4">  
                            <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <tr>
                                            <th>Item</th>
                                            <th>Cost</th>                                  
                                            <th>Number</th>
                                            <th>User</th>
                                            <th>Ordered On</th>
                                            <th>Location</th>
                                            <th>Action</th>
                                        </tr>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{$product->category}}</td>
                                            <td>{{$product->cost}}</td>
                                            <td>{{$product->quantity}}</td> 
                                            <td>{{App\User::where('id', $product->user)->get()->first()->name}}</td> 
                                            <td>{{$product->updated_at}}</td>                                            
                                            <td>{{$product->location}}</td>
                                            <td>
                                             <a class="btn btn-sm btn-warning" href="userconfirmdelivery/{{$product->id}}">Confirm Delivery</a>                                            </td> 
                                        </tr>
                                    @endforeach
                                </table> 
                            </div>
                            </div>                                
                            @else 
                                <div class="p-2">
                                    <h5 class="text-center text-black-50">You have no unconfirmed deliveries</h5>
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