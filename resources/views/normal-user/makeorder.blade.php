@extends('layouts.auth')

<!-------------------------------section------------------------------->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card"> 
                <form method="POST" action="storeorder">
                    @csrf

                <div class="card-header">
                    <i class="fas fa-cash fa-1x" aria-hidden="true">&nbsp;My Shopping List</i>
                </div>

                <div class="card-body">
                    @if(count($carts) > 0 )                             
                        @foreach($carts as $cart)
                            <div class="row p-2 mb-4">                                   
                                <div class="col-md-4">                                             
                                    <h6><strong>Item:</strong></h6>                               
                                    <h6><strong>Quantity:</strong></h6>
                                    <h6><strong>Cost:</strong></h6>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">{{$cart->category}}</h6>
                                    <h6 class="text-muted">{{$cart->quantity}}</h6> 
                                    <h6 class="text-muted">{{$cart->cost}}</h6>                                                                                  
                                </div>
                                <div class="col-md-2">
                                    <a href="removeitemfromcart/{{$cart->id}}" class="text-danger">
                                        <i class="fa fa-times" aria-hidden="true">&nbsp;Remove</i>
                                    </a>
                                </div>
                            </div> 
                            <hr>                         
                        @endforeach  
                        <div class="row p-2 mr-3">                                   
                             <div class="col-md-4">                               
                                <h5><strong>Product(s) Cost:</strong></h5>  
                            </div>
                            <div class="col-md-4">                               
                                <h5 class="text-muted"><strong>{{$carts->sum('cost')}}</strong></h5>  
                            </div>
                        </div>                                 
                    @else 
                    <div class="p-2">
                        <h5 class="text-center text-black-50">Your shopping list is empty</h5>
                    </div>                                
                    @endif

                    <div class="card-footer">
                            <div class="form-group row">
                                <label for="location" class="col-md-3 col-form-label text-md-right">{{ __('Delivery Location') }}</label>
                                <div class="col-md-7">
                                    <select id="location" type="text" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" 
                                        name="location" value="{{old('location')}}">
                                        @foreach($locations as $location)
                                            <option></option>
                                            <option>{{$location->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('location'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$errors->first('location')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 

                            <div class="form-group row">  
                            <label for="driver" class="col-md-3 col-form-label text-md-right">{{ __('Choose Driver') }}</label>
                            <div class="col-md-7">
                                <select id="driver" type="text" class="form-control{{ $errors->has('driver') ? ' is-invalid' : '' }}" 
                                name="driver" value="{{old('driver')}}">
                                    @foreach($drivers as $driver)
                                        <option></option>
                                        <option value="{{$driver->charges}}">{{App\User::where('id', $driver->id)->get()->first()->name}}</option>
                                    @endforeach
                                </select>
                                <script type="text/javascript">
                                    $("#driver").on("change", function () {                                        
                                        var totalmoney=(Number($(this).val()) + {{$carts->sum('cost')}});
                                        $("#totalcharges").empty().val(totalmoney);

                                        var drivermoney=(Number($(this).val()));
                                        $("#drivercharges").empty().val(drivermoney);

                                       //console.log(totalmoney);
                                    });
                                </script>
                                @if ($errors->has('driver'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('driver')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                       

                        <div class="form-group row">
                            <label for="drivercharges" class="col-md-3 col-form-label text-md-right">{{ __('Driver Charges (Ksh)') }}</label>
                            <div class="col-md-7">
                                <input id="drivercharges" type="text" class="form-control{{ $errors->has('drivercharges') ? ' is-invalid' : '' }}" 
                                    name="drivercharges" value="{{old('drivercharges')}}" disabled>
                            </div>
                        </div>                     

                        <div class="form-group row">
                            <label for="totalcharges" class="col-md-3 col-form-label text-md-right">{{ __('Total Charges (Ksh)') }}</label>
                            <div class="col-md-7">
                                <input id="totalcharges" type="text" class="form-control{{ $errors->has('totalcharges') ? ' is-invalid' : '' }}" 
                                    name="totalcharges" value="{{old('totalcharges')}}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mpesacode" class="col-md-3 col-form-label text-md-right">{{ __('Mpesa Code') }}</label>
                            <div class="col-md-7">
                                <input id="mpesacode" type="text" class="form-control{{ $errors->has('mpesacode') ? ' is-invalid' : '' }}" 
                                    name="mpesacode" value="{{old('mpesacode')}}">
                                @if ($errors->has('mpesacode'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('mpesacode')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <p class="text-danger"><strong>Important:</strong>
                            <i>Pay total charges (Products cost + Driver charges)</i></p>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm">Submit Order</button>
                </div>

                </form>
            </div>
        </div>
    </div>
@endsection
<!-------------------------------./section------------------------------->
