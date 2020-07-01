@extends('layouts.auth')

<!-------------------------------section------------------------------->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <form enctype="multipart/form-data" method="POST" action="{{ url('/profile') }}">
                @csrf     
                <div class="card-header"><i class="fas fa-pen fa-2x">&nbsp;{{ __('Create profile') }}</i></div>

                <div class="card-body">                       

                        <!-------------------------------Card Basic Info------------------------------->
                        <h5>Basic Info</h5>
                        <div class="card"> <p></p> 
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('DOB') }}</label>
                                    <div class="col-md-6">
                                        <input id="dob" type="date" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" 
                                        name="dob" value="{{ old('dob') }}">
                                        @if ($errors->has('dob'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('dob') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="picture" class="col-md-4 col-form-label text-md-right">{{ __('Profile picture') }}</label>
                                    <div class="col-md-6">
                                        <input id="picture" type="file" class="form-control-file{{ $errors->has('picture') ? ' is-invalid' : '' }}" 
                                        name="picture" value="{{ old('picture') }}">
                                        @if ($errors->has('picture'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('picture') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                                    <div class="col-md-6">
                                        <select id="gender" type="text" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" 
                                        name="gender" value="{{ old('gender') }}">
                                        <option>Male</option>
                                        <option>Female</option>
                                        <option>Other</option>
                                    </select>
                                        @if ($errors->has('gender'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('gender') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
      
                        </div>                         
                        </div><p></p><!-------------------------------./Card Basic Info------------------------------->

                         <!-------------------------------Contact Info------------------------------->
                         <h5>Contact Info</h5>
                         <div class="card"> <p></p> 
                         <div class="form-group row">
                             <div class="col-md-6">                                 
                                <div class="form-group row">
                                    <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                                    <div class="col-md-6">
                                        <input id="phone" type="number" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" 
                                        name="phone" value="{{ old('phone') }}">
                                        @if ($errors->has('phone'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                             </div>                             
                             <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>
                                    <div class="col-md-6">
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
                            </div>
       
                         </div>                         
                         </div><p></p><!-------------------------------./Contact Info------------------------------->
                        
                </div>
                <div class="card-footer"> 
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-info form-control">
                                {{ __('Save Profile') }}
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
