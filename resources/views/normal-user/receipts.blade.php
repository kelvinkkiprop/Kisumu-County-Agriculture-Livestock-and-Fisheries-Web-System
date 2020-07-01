@extends('layouts.auth')

    @section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                    <div class="card-header">
                            <i class="fas fa-m fa-2x">&nbsp;Services({{$servicereceipts->count()}})</i>
                        </div>
                        <div class="card-body mb-3">                      
                                            
                            @if(count($servicereceipts) > 0 )                             
                                @foreach($servicereceipts as $service)                
                                    <div class="card mt-4">  
                                        <div class="row p-4">                                   
                                            <div class="col-md-4">  
                                                <h6><strong>Organization:</strong></h6> 
                                                <h6><strong>Service:</strong></h6>                                
                                                <h6><strong>Cost:</strong></h6>                               
                                                <h6><strong>Location:</strong></h6>
                                                <h6><strong>Date/Time of issue:</strong></h6>
                                                <h6><strong>Status:</strong></h6>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-muted">{{config('app.name')}}</h6>
                                                <h6 class="text-muted">{{App\OfferingService::where('id', $service->service)->get()->first()->name}}</h6>
                                                <h6 class="text-muted">{{$service->cost}}</h6>  
                                                <h6 class="text-muted">{{$service->location}}</h6> 
                                                <h6 class="text-muted"><small>{{$service->created_at}}</small></h6>
                                                <h6 class="text-muted">
                                                    @if($service->status==1)
                                                        Approved
                                                    @else
                                                        Pending
                                                    @endif
                                                </h6>                                                                                               
                                            </div>
                                            <div class="col-md-2">
                                                <a href="printreceiptservice/{{$service->id}}" class="btn btn-info">
                                                    <i class="fas fa-eye fa-1x ">&nbsp;View more</i>
                                                </a>
                                            </div>
                                        </div> 
                                    </div>                         
                                @endforeach                                
                            @else 
                                <div class="p-2">
                                    <h5 class="text-center text-black-50">You have 0 service receipts</h5>
                                </div>                                
                            @endif 

                        </div>



                        <div class="card-header">
                                <i class="fas fa-m fa-2x">&nbsp;Products({{$receipts->count()}})</i>
                            </div>
                            <div class="card-body mb-3">                      
                                                
                                @if(count($receipts) > 0 )                             
                                    @foreach($receipts as $receipt)                
                                        <div class="card mt-4">  
                                            <div class="row p-4">                                   
                                                <div class="col-md-4">  
                                                    <h6><strong>Receipt No:</strong></h6>   
                                                    <h6><strong>Organization:</strong></h6> 
                                                    @php $eachproducts = DB::table('orders')->where('receipt_no', $receipt->receipt_no)->get()@endphp
                                                    @foreach($eachproducts as $eachproduct)
                                                        <ul type="none"> 
                                                            <li><small><strong>Product:</strong></small></li> 
                                                            <li><small><strong>Quantity:</strong></small></li> 
                                                            <li><small><strong>Cost:</strong></small></li> 
                                                        </ul>                                                                                                                                                                      
                                                    @endforeach 
                                                    <h6><Strong>Delivery charges:</strong></h6>                             
                                                    <h6><strong>Total Cost:</strong></h6>                               
                                                    <h6><strong>Delivery Location:</strong></h6> 
                                                    <h6><strong>Driver:</strong></h6>
                                                    <h6><strong>Date:</strong></h6>
                                                    <h6><strong>Payment Confirmation:</strong></h6>
                                                    <h6><strong>Delivery:</strong></h6>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 class="text-muted">{{$receipt->receipt_no}}</h6>
                                                    <h6 class="text-muted">{{config('app.name')}}</h6>                                                    
                                                @php $eachproducts = DB::table('orders')->where('receipt_no', $receipt->receipt_no)->get()@endphp
                                                @foreach($eachproducts as $eachproduct)   
                                                        <ul type="none"> 
                                                            <li class="text-muted"><small><strong>Ksh.&nbsp;{{$eachproduct->category}}</strong></small></li> 
                                                            <li class="text-muted"><small><strong>{{$eachproduct->quantity}}</strong></small></li> 
                                                            <li class="text-muted"><small><strong>Ksh.&nbsp;{{$eachproduct->cost}}</strong></small></li> 
                                                        </ul>                                                                                                                                                                      
                                                @endforeach                                                 
                                                {{-- @foreach($products as $product)       --}}
                                                <h6 class="text-muted">Ksh.&nbsp;{{$eachproduct->driver_charges}}</h6>                                                  
                                                    <h6 class="text-muted">Ksh.&nbsp;{{$eachproducts->sum('cost')+$eachproduct->driver_charges}}</h6> 
                                                    <h6 class="text-muted">{{$eachproduct->location}}</h6>  
                                                    <h6 class="text-muted">{{App\User::where('id', App\DriverCharges::where('charges', $eachproduct->driver_charges)->get()->first()->id)->get()->first()->name}}</h6> 
                                                    <h6 class="text-muted"><small>{{$eachproduct->created_at}}</small></h6>   
                                                     <h6 class="text-muted">
                                                        @if($eachproduct->status==1)
                                                            Approved
                                                        @else
                                                           Pending
                                                        @endif
                                                    </h6> 
                                                    <h6 class="text-muted">
                                                        @if($eachproduct->delivery==1)
                                                            Deliverd
                                                        @else
                                                            Pending
                                                        @endif
                                                    </h6>                                                                                     
                                                </div>
                                                <div class="col-md-2">
                                                    <a href="printreceiptproduct/{{$receipt->receipt_no}}" class="btn btn-info">
                                                    <i class="fas fa-eye fa-1x ">&nbsp;View more</i>
                                                </a> 
                                                </div>
                                            </div> 
                                        </div>                         
                                    @endforeach                                
                                @else 
                                    <div class="p-2">
                                        <h5 class="text-center text-black-50">You have 0 product receipts</h5>
                                    </div>                                
                                @endif 
    
                            </div>

            </div>
        </div>
    </div>
    @endsection