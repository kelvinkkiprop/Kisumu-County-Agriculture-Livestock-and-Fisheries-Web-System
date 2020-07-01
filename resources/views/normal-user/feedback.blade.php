@extends('layouts.auth')

<!-----------------------------Section---------------------------------->
@section('content')
       
    <!-----------------------------FEEDBACK---------------------------------->    
    <div id="feedback">

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                           <strong><i class="fas fa-envelope fa-2x">&nbsp;Feedback</i></strong></i>
                        </div>
                        <div class="col-md-2">
                          <a href="viewfeedbackreplys" class="fas fa-envelope-open-text ml-5">&nbsp;Inbox</a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="sentmail mr-5 ml-5">
                        <form method="POST" enctype="multipart/form-data" action="feedback">
                            @csrf        
                            <label for="subject">{{ __('Subject:') }}</label> 
                            <input id="subject" type="text" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject" >
                            @if ($errors->has('subject'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </span>
                            @endif
                            <p></p>
                            <label for="message">{{ __('Message:') }}</label> 
                            <textarea id="message" type="text" class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" name="message" 
                                rows="6"></textarea>
                            @if ($errors->has('message'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                            @endif
                            <p></p>

                            <button type="submit" class="btn btn-success form-control">
                                {{ __('Submit') }}
                            </button>                                
                        </form>
                    </div>
                </div>

                <div class="card-footer">
                    <p></p>
                </div>
            </div>
        </div>
    </div>
    <!-----------------------------./FEEDBACK---------------------------------->  

    @endsection
    <!-----------------------------./Section---------------------------------->
