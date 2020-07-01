@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="fas fa-user fa-2x">&nbsp;Profile</i></div>

                <div class="card-body">
                        
                    <!-----------------------------PROFILE---------------------------------->
                    <div id="profile">
                        
                        <!-----------------------------Container---------------------------------->
                        <div class="container">  
                   
                            <!-----------------------------Picture info---------------------------------->
                            <div class="card p-3 text-center">
                                <p><img class="img-fluid img-circle" width="150" src="uploads/images/{{$profile->picture}}"></p> 
                                <h4><strong>{{Auth::user()->name}}</strong> </h4>        
                            </div><br/>
                            <!-----------------------------./Picture info---------------------------------->
                            
                            <!-----------------------------Basic info---------------------------------->
                            <h5>Basic info</h5>
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-6">                                        
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Gender:') }}</label>
                                            <div class="col-md-6 col-form-label">
                                                <strong>{{$profile->gender}}</strong>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label text-md-right">{{ __('DOB:') }}</label>
                                            <div class="col-md-6 col-form-label">
                                                <strong>{{Carbon\Carbon::parse($profile->dob)->format('d-m-Y') }}</strong>
                                            </div>
                                        </div>              
                                    </div>


                                    <div class="col-md-6"> 
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Location:') }}</label>
                                            <div class="col-md-6 col-form-label">
                                                <strong>{{$profile->location}}</strong>
                                            </div>
                                        </div> 
                                    </div>                                    
                                </div>
                            </div><br/>
                             <!-----------------------------./Basic info---------------------------------->

                            <!-----------------------------Contact info---------------------------------->
                            <h5>Contact info</h5>
                            <div class="card"> 
                                <p></p> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Email:') }}</label>
                                            <div class="col-md-6 col-form-label">
                                                <strong>{{Auth::user()->email}}</strong>
                                            </div>
                                        </div>                                                        
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Phone:') }}</label>
                                            <div class="col-md-6 col-form-label">
                                                <strong>{{$profile->phone}}</strong>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                            </div><br/>
                             <!-----------------------------./Contact info---------------------------------->
                                 
                             <!-----------------------------Account info---------------------------------->
                            <h5>Account info</h5>
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label text-md-right">{{ __('Account Type:') }}</label>
                                            <div class="col-md-6 col-form-label">
                                                <strong>{{Auth::user()->type}}</strong>
                                            </div>
                                        </div>               
                                    </div>
                                    <div class="col-md-6"> 
                                    </div>                                    
                                </div>
                            </div><br/>
                             <!-----------------------------./Account info---------------------------------->

                        </div>
                        <!-----------------------------./Container---------------------------------->

                    </div>
                    <!-----------------------------./PROFILE---------------------------------->

                </div>

                <div class="card-footer">
                    <a href="/profile/{{$profile->id}}/edit" class="btn btn-sm btn-warning">
                        <i class="fas fa-pen fa-1x">&nbsp;Edit</i></a>             
                </div>
            </div>
        </div>
    </div>
</div>
@endsection