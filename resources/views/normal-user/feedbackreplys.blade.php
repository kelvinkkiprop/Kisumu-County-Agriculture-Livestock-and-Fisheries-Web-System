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
                            <strong><i class="fas fa-envelope-open-text fa-2x">&nbsp;Inbox</i></strong></i>
                        </div>
                        <div class="col-md-2">
                            <a href="feedback" class="fas fa-arrow-left ml-5">&nbsp;Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    @if(count($feedbacks) > 0 )                            
                        @foreach($feedbacks as $feedback) 
                        <div class="card-header p-3 mb-3"> 
                            <div class="form-group row">
                                <div class="col-md-6"> 
                                        <div class="bg-warning card p-3">                                        
                                            <p class="user"><i class="fa fa-user-circle fa-1x" aria-hidden="true">                                
                                            {{ App\User::where('id', $feedback->sender)->get()->first()->name}}</i></p>
                                            <p>{{$feedback->message}}</p> 
                                            <p class="text-muted text-right">Sent:&nbsp;<small>{{Carbon\Carbon::parse($feedback->created_at)->format('d-m-Y h:ia')}}</small></p>                                      
                                        </div>
                                </div>                                
                                <div class="col-md-6">
                                </div> 
                            </div> 
                        
                            <div class="form-group row">
                                <div class="col-md-6">
                                </div>                                
                                <div class="col-md-6">  
                                    <div class="bg-info card p-3">                                                                 
                                        @if($feedback->status==1)                                        
                                            <p><i class="fa fa-user-circle fa-1x" aria-hidden="true">&nbsp;{{Auth::user()->name}}</i></p>
                                            <p>{{App\Message::where('feedback', $feedback->id)->get()->first()->message}}</p> 
                                            <p class="text-muted text-right">Received:&nbsp;<small>{{Carbon\Carbon::parse(App\Message::where('feedback', $feedback->id)->get()->first()->created_at)->format('d-m-Y h:ia')}}</small></p>                                      
                                        @else 
                                        <p class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i>
                                            <span class="sr-only">Loading...</span></p>
                                        @endif
                                    </div>
                                </div> 
                            </div>
                        </div>

                        @endforeach
                    @else 
                        <div class="p-3">
                            <h5 class="text-center">No messages</h5>
                        </div>                                
                        @endif 
                    <p></p> 
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
