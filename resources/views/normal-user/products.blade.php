@extends('layouts.app')

<!-----------------------------Section---------------------------------->
    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 row">
                                <i class="fab fa-product-hunt fa-2x col-md-6">&nbsp;Available products</i>
                                <div class="text-center col-md-6">                                    
                                @if(Auth::user()->type=="Farmer" && $carts->count()>0)
                                    <a href="makeorder">
                                        <i class="fas fa-shopping-cart nr-auto">&nbsp;{{$carts->count()}}</i>
                                    </a>
                                @endif
                                </div>
                            </div>
                            <div class="col-md-2"></div>                             
                                @if(Auth::user()->type=="Farmer")                        
                                    <div class="col-md-4">
                                        <form method="POST" action="products">
                                            @csrf 
                                        <div class="input-group">
                                            <input type="text" placeholder="Search" id="search_term" type="text" class="form-control{{ $errors->has('search_term') ? ' is-invalid' : '' }}"
                                            name="search_term" value="{{ old('search_term') }}">                                    
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary form-control" type="submit">
                                                    <i class="fas fa-search fa-1x" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                            @if ($errors->has('search_term'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('search_term') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        </form>
                                    </div>
                                @endif
                        </div>
                    </div>

                    <div class="card-body">
                            
                    <!-----------------------------------------Products------------------------------------------------->
                    <div id="products">                             
                            
                        <div class="container-fluid">
                            <div class="card-columns">

                                @if(count($products) > 0 )                             
                                    @foreach($products as $product) 
                                        <div class="card p-3">
                                            <h5 class="text-center">{{$product->category}}</h5>
                                            <p class="text-center">
                                                <img class="img-fluid" height="105" width="105" src="/uploads/images/{{$product->image}}">
                                            </p>
                                            <h6>Cost:&nbsp;<span class="text-muted"> Ksh&nbsp;{{$product->cost/$product->quantity}}</span></h6>
                                            <p>Remaining:&nbsp;<span class="text-muted">{{$product->quantity}}</span></p>
                                            <p>{{$product->details}}</p>
                                            @if(Auth::user()->type=="Farmer")
                                                <p class="text-center"> <a href="#" class="btn btn-sm btn-info" data-toggle="modal" 
                                                        data-target="#addQuantity{{$product->id}}">Add to Cart</a></p>
                                            @endif
                                                
                                        <!-----------------------------Add Quantity---------------------------------->
                                        <div id="addQuantity{{$product->id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-md">
                                                <!-- Modal content-->
                                                <div class="modal-content"> 
                                                    <form method="POST" action="addproducttocart/{{$product->id}}">
                                                        @csrf    
                                                        <div class="modal-header bg-info text-white p-2">
                                                            <i class="fas fa-monument fa-1x" aria-hidden="true">&nbsp;Add Quantity</i>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>         
                                                        </div>
                                                        <div class="modal-body">   
                                                            <!-------------------------------Input------------------------------->
                                                            <div class="form-group row">
                                                                <label for="quantity" class="col-md-3 col-form-label text-md-right">{{ __('Quantity') }}</label>
                                                                <div class="col-md-7">
                                                                    <input id="quantity" type="number" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" 
                                                                    name="quantity" value="{{ old('quantity') }}">
                                                                    @if ($errors->has('quantity'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('quantity') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>                              
                                                            <!-------------------------------./Input------------------------------->
                                                        </div>
                                                        <div class="modal-footer bg-dark">
                                                            <button type="submit" class="btn btn-sm btn-secondary pull-right">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-----------------------------./Add Quantity---------------------------------->
                                        </div>                           
                                    @endforeach                                   
                                @else 
                                <div class="p-2">
                                    <h5 class="text-center text-black-50">No products are currently available</h5>
                                </div>                                
                                @endif

                                {{-- <div class="card text-center p-4">
                                    <p><i class="fas fa-shopping-bag fa-5x text-black-50"></i></p>
                                    <h2>Subsidized Fertilizers</h2>
                                    <p class="text-muted">I.e Ammonium nitrogen fertilizer,Nitrate nitrogen fertilizer and Phosphorus fertilizer.</p>
                                </div>
                                <div class="card text-center p-4">
                                    <p><i class="fas fa-bug fa-5x text-black-50"></i></p>
                                    <h2>Farm Chemicals</h2>
                                    <p class="text-muted">I.e Insecticides, Herbicides, Rodenticides, Bactericides,  Fungicides</p>
                                </div>
                                <div class="card text-center p-4">
                                    <p><i class="fas fa-tools fa-5x text-black-50"></i></p>
                                    <h2>Farm Tools</h2>
                                    <p class="text-muted">Cheap Panga, Jembe, Rake, Spade, Spring balance, Trowel,  Pruning hook</p>
                                </div>
                                <div class="card text-center p-4">
                                    <p><i class="fas fa-horse fa-5x text-black-50"></i></p>
                                    <h2>Animals</h2>
                                    <p class="text-muted">I.e Day old chicks, In-calf heifers, Fertilised eggs and Breeding bulls</p>
                                </div>
                                <div class="card text-center p-4">
                                        <p><i class="fas fa-seedling fa-5x text-black-50"></i></p>
                                    <h2>Planting materials</h2>
                                    <p class="text-muted">I.e Grasses, Barks, Woods, Gourds, Stems, Roots, and Seeds</p>
                                </div> --}}
                            </div>       
                        </div>              
                            
                    </div><!-----------------------------------------./Products------------------------------------------------->
            
                    </div>
                    <div class="card-footer">
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    <!-----------------------------./Section--------------------------------->