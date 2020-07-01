@extends('layouts.auth')

<!-------------------------------section------------------------------->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
            <form enctype="multipart/form-data" method="POST" action="{{ url('/applytender') }}">
                @csrf     
                <div class="card-header">
                    <i class="fas fa-pen fa-2x">&nbsp;{{ __('Apply tender') }}</i>
                </div>

                <div class="card-body">                       
                    <div class="form-group row">
                        <label for="service" class="col-md-4 col-form-label text-md-right">{{ __('Tender') }}</label>
                        <div class="col-md-6">
                            <select id="tender" type="text" class="form-control{{ $errors->has('tender') ? ' is-invalid' : '' }}" 
                            name="tender" value="{{ old('tender') }}">
                            @foreach($availabletenders as $availabletender)
                                <option>{{$availabletender->title}}</option>
                            @endforeach
                            </select>
                            @if ($errors->has('tender'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tender') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>                                                     
                    <div class="form-group row">
                        <label for="certificate" class="col-md-4 col-form-label text-md-right">{{ __('Company Certificate') }}</label>
                        <div class="col-md-6">
                            <input id="certificate" type="file" class="form-control-file{{ $errors->has('certificate') ? ' is-invalid' : '' }}" 
                            name="certificate" value="{{ old('certificate') }}">
                            @if ($errors->has('certificate'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('certificate') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                     
                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Brief Description') }}</label>
                        <div class="col-md-6">
                            <textarea id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" 
                            name="description" value="{{ old('description') }}" rows="4"></textarea>
                        </select>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
       
                </div>                        
                        
                <div class="card-footer"> 
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-info form-control">
                                {{ __('Apply Tender') }}
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
