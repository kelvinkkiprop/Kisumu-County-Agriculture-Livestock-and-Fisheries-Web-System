@extends('layouts.app')

<!-----------------------------Section---------------------------------->
    @section('content')
    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header row">
                        <div class="col-md-10">
                            <i class="fas fa-truck fa-2x">
                            <strong>&nbsp;Tenders</strong></i>
                        </div>
                        <div class="col-md-2 text-center">
                            @if(Auth::user()->type=="Farmer")   
                                <a class="btn btn-link" href="applytender">Appy </a>  
                            @endif                           
                        </div>
                    </div>

                    <div class="card-body">
                            
                    <!-----------------------------------------Tenders------------------------------------------------->
                    <div id="tenders">                             
                            
                        <div class="container">
                            <!-----------------------------Tender Update---------------------------------->         
                                @if(count($tenders)>0)
                                    @foreach($tenders as $tender)
                                    <div class="card p-3">
                                        <h4><strong>{{$tender->title}}</strong></h4>
                                        <p>{{$tender->description}}</p>  
                                        <p><small class="text-muted">Closing date:
                                            <strong>{{Carbon\Carbon::parse($tender->closing_date)->format('d-m-Y h:ia')}}</strong></small></p>                                                            
                                    </div><br/>
                                    @endforeach
                                @else 
                                    <h6 class="text-black-50 text-center p-2">No tenders</h6>
                                @endif 
                            {{ $tenders->links() }}
                            <!-----------------------------./Tender Updats---------------------------------->      
                        </div>                
                            
                    </div><!-----------------------------------------./Tenders------------------------------------------------->
            
                    </div>
                    <div class="card-footer">
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    <!-----------------------------./Section---------------------------------->