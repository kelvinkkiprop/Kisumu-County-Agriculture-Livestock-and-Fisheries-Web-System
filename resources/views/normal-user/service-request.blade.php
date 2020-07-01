@extends('layouts.auth')

<!-------------------------------section------------------------------->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
            <form enctype="multipart/form-data" method="POST" action="{{ url('/requestservice') }}">
                @csrf     
                <div class="card-header"><i class="fas fa-pen fa-2x">&nbsp;{{ __('Request Service') }}</i></div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="service" class="col-md-3 col-form-label text-md-right">{{ __('Service') }}</label>
                        <div class="col-md-7">
                            <select id="service" type="text" class="form-control{{ $errors->has('service') ? ' is-invalid' : '' }}" 
                            name="service" value="{{ old('service') }}">
                            @foreach($offeringservices as $offeringservice)
                                <option></option>
                                <option value="{{$offeringservice->chargesperhour}}">{{$offeringservice->name}}</option>
                            @endforeach
                            </select>
                            <script type="text/javascript">
                                $("#service").on("change", function () {
                                    var chargesmoney=(Number($(this).val()));
                                    $("#chargesperhour").empty().val(chargesmoney);
                                });
                            </script>
                            @if ($errors->has('service'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('service') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>                        
                    <div class="form-group row">
                        <label for="chargesperhour" class="col-md-3 col-form-label text-md-right">{{ __('Charges per Hour (Ksh)') }}</label>
                        <div class="col-md-7">
                                <input id="chargesperhour" type="number" class="form-control{{ $errors->has('chargesperhour') ? ' is-invalid' : '' }}" 
                                name="chargesperhour" value="{{old('chargesperhour')}}" disabled>
                            @if ($errors->has('chargesperhour'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('chargesperhour') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="location" class="col-md-3 col-form-label text-md-right">{{ __('Location') }}</label>
                        <div class="col-md-7">
                            <select id="location" type="text" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" 
                            name="location" value="{{ old('location') }}">
                            @foreach($locations as $location)
                            <option>{{$location->name}}</option>
                            @endforeach
                        </select>
                            @if ($errors->has('location'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('location') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>                                 
                    <div class="form-group row">
                        <label for="comment" class="col-md-3 col-form-label text-md-right">{{ __('Comment') }}</label>
                        <div class="col-md-7">
                            <textarea id="comment" type="text" class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}" 
                            name="comment" value="{{ old('comment') }}" rows="4"></textarea>
                        </select>
                            @if ($errors->has('comment'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('comment') }}</strong>
                                </span>
                            @endif
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
                                    
                </div>   
                        
                <div class="card-footer"> 
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-info form-control">
                                {{ __('Submit Request') }}
                            </button>
                        </div>
                    </div>                   
                </div>
            </form> 
            </div>        
        </div>
    </div>
</div>
@endsection
<!-------------------------------./section------------------------------->
