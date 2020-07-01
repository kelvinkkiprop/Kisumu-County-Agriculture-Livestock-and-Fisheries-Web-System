@extends('layouts.app')

<!-----------------------------Section---------------------------------->
    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-star fa-2x" aria-hidden="true">
                        <strong>&nbsp;Our Services</strong></i></div>

                    <div class="card-body">
                            
                    <!-----------------------------------------Products------------------------------------------------->
                    <div id="products">                             
                            
                        <div class="container-fluid">
                            <div class="card-columns">                                                                                                
                                <div class="card text-center p-4">
                                    <p class="text-muted"><i class="fas fa-horse fa-4x"></i></p>
                                    <h2>Veterinary services </h2>                    
                                </div>                                                                                                
                                <div class="card text-center p-4">
                                    <p class="text-muted"><i class="fas fa-map fa-4x"></i></p>
                                    <h2>Farm visits</h2>
                                </div>
                            </div>       
                        </div>              
                            
                    </div><!-----------------------------------------./Products------------------------------------------------->
            
                    </div>
                    <div class="card-footer">
                        @if(Auth::user()->type=="Farmer")
                            <p>
                                <a href="requestservice" class="btn btn-sm btn-warning">
                                    <i class="fas fa-pen fa-1x">&nbsp;Make request</i></a> 
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    <!-----------------------------./Section---------------------------------->