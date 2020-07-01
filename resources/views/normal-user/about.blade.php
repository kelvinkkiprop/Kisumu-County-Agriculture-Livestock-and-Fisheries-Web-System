@extends('layouts.app')

<!-----------------------------Section---------------------------------->
    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong><i class="fas fa-info-circle fa-2x">&nbsp;About Us</i></strong></i>
                    </div>

                    <div class="card-body">
                            
                    <!-----------------------------------------About------------------------------------------------->
                    <div id="about">                             
                            
                        <div class="container">	<!--container -->
                            <h6><strong>Overview</strong></h6>
                            <p>{{config('app.name')}} was by Beryl Akoth Anyango 2019 with an aid of helping 
                            keep the records of transactions concerning the agricultural products, enable farmers 
                            to pay for these products and services efficiently and for the county government to keep 
                            up with the sales of goods and services offered by the ministry</p><br/>
                            
                            <h6><strong>Vision</strong></h6>
                            <p>Excellence in agricultural, livestock and fisheries services towards transformed livelihoods.</p><br/>

                            <h6><strong>Mission</strong></h6>
                            <p>To conduct delever the best services using technology and innovation to catalyse sustainable 
                                growth and development in agriculture livestock and fisharies Product Value Chains.</p><br/>
                                       
                        </div><!--/.container-->                
                            
                    </div><!-----------------------------------------./About------------------------------------------------->
            
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