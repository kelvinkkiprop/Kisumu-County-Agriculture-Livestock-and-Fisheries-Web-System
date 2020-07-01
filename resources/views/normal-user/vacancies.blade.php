@extends('layouts.app')

<!-----------------------------Section---------------------------------->
    @section('content')
    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-list-alt fa-2x">
                        <strong>&nbsp;Vacancies</strong></i></div>

                    <div class="card-body">
                            
                    <!-----------------------------------------Vacancies------------------------------------------------->
                    <div id="vacancies">                             
                            
                        <div class="container">
                            <!-----------------------------vacancy Update---------------------------------->         
                                @if(count($vacancies)>0)
                                    @foreach($vacancies as $vacancy)
                                    <div class="card p-3">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <h4><strong>{{$vacancy->position}}&nbsp;({{$vacancy->number}})</strong></h4>
                                                </div>
                                                <div class="col-md-2">
                                                    @if(Auth::user()->type=="Farmer")
                                                        <a href="applyvacancy" class="text-danger wow infinite flash">&nbsp;<strong>Apply Now</strong></a>
                                                    @endif
                                                </div>
                                            </div>
                                        <p>{{$vacancy->description}}</p>  
                                        <p><small class="text-muted">Closing date:
                                            <strong>{{Carbon\Carbon::parse($vacancy->closing_date)->format('d-m-Y h:ia')}}</strong></small></p>                                                            
                                    </div><br/>
                                    @endforeach
                                @else 
                                    <h6 class="text-black-50 text-center p-2">No vacancies at the moment</h6>
                                @endif 
                            {{ $vacancies->links() }}
                            <!-----------------------------./vacancy Updats---------------------------------->      
                        </div>                
                            
                    </div><!-----------------------------------------./Vacancies------------------------------------------------->
            
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