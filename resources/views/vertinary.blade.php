@extends('layouts.admin')

<!-----------------------------Section---------------------------------->
@section('content')

    <!-----------------------------DASHBOARD---------------------------------->
    <section id="dashboard">

        <!-----------------------------row---------------------------------->
        <div class="row">

            <!-----------------------------col-md-2---------------------------------->
            <div class="col-md-2"> 
                <!-----------------------------MENU---------------------------------->
                <div class="menu">

                    <!-----------------------------------------Navbar--------------------------------------------------->
                    <nav class="navbar-expand-sm navbar-light">

                    <!-- Toggler button -->
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#mynavbar" aria-controls="mynavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>


                    <!-- Navbar collapse -->
                    <div class="collapse navbar-collapse" id="mynavbar">
               
                    <!-----------------------------Nav tabs---------------------------------->
                    <ul class="nav nav-tabs flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#analytics">
                            <i class="fas fa-database">&nbsp;Analytics</i></a>
                        </li>      
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#pending">
                            <i class="fas fa-truck-loading">&nbsp;Pending</i></a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#delivered">
                            <i class="fas fa-truck">&nbsp;Delivered</i></a>
                        </li> 
                    </ul>
                    <!-----------------------------./Nav tabs---------------------------------->

                    </div>

                    </nav>

                </div>
                <!-----------------------------MENU---------------------------------->
            </div>
            <!-----------------------------./col-md-2---------------------------------->

            <!-----------------------------col-md-10---------------------------------->
            <div class="col-md-10">

                <!-----------------------------HERO---------------------------------->
                <div class="hero">

                <!-----------------------------Tab panes---------------------------------->
                <div class="tab-content">

                <!-----------------------------Messages---------------------------------->
                @include('common.messages')
                <!-----------------------------./Messages---------------------------------->

                <!-----------------------------./Modal Errors---------------------------------->
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-lebel="close">&times;</a>  
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>                            
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-----------------------------./Modal Errors---------------------------------->

                    <!-----------------------------Analytics---------------------------------->
                    <div id="analytics" class="tab-pane active">
                        <h3>ANALYTICS</h3>
                        <div class="well">            
                        <!--Overview-->
                        <div class="card mb-2">
                            <div class="card-header">
                                <h5>Overview</h5>
                            </div>
                            <div class="card-body row">
                                <div class="col-md-6">
                                    <div class="stat-box">
                                        <h2><i class="fas fa-truck fa-1x">&nbsp;{{$deliveredservices->count()}}</i></h2>
                                        <h4>Delivered</h4>	
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="stat-box">
                                        <h2><i class="fas fa-truck-loading fa-1x">&nbsp;{{$pendingservices->count()}}</i></h2>
                                        <h4>Pending</h4>	
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--./Overview-->
                         <!--Recent orders-->
                         <div class="card">
                            <div class="card-header">
                                <h5>Recent requests</h5>
                            </div>					
                            <div class="card-body">
                                @if(count($recentrequests)>0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        @foreach($recentrequests as $recentrequest)
                                        <tr>
                                            <td>{{App\OfferingService::where('id', $recentrequest->service)->get()->first()->name}}</td>
                                            <td>{{$recentrequest->cost}}</td>
                                            <td>{{$recentrequest->location}}</td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>                
                                @else
                                    <h6 class="text-center text-black-50 p-3">No recent orders</h6>                
                                @endif
                            </div>	
                        </div>
                        <!--/.Recent orders-->        
                        </div>
                    </div>
                    <!-----------------------------./Analytics---------------------------------->

                    <!-----------------------------Waiting---------------------------------->
                    <div id="pending" class="tab-pane fade">
                        <h3>PENDING SERVICES</h3>
                        <h4>TOTAL:&nbsp;<strong>{{$pendingservices->count()}}</strong></h4>
                        <div class="well">
                            @if(count($pendingservices)>0)  
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th>Service</th>
                                        <th>Cost</th>                                  
                                        <th>Details</th>
                                        <th>User</th>
                                        <th>Location</th>
                                        <th>Ordered On</th>
                                        <th>Status</th>
                                    </tr>
                                        @foreach($pendingservices as $pendingservice)
                                            <tr>
                                                <td>{{App\OfferingService::where('id', $pendingservice->service)->get()->first()->name}}</td>
                                                <td>{{$pendingservice->cost}}</td>
                                                <td>{{$pendingservice->details}}</td> 
                                                <td>{{App\User::where('id', $pendingservice->user)->get()->first()->name}}</td>                                            
                                                <td>{{$pendingservice->location}}</td>
                                                <td>{{$pendingservice->updated_at}}</td>
                                                <td>
                                                    @if($pendingservice->status==0)
                                                        <a href="updateservice/{{$pendingservice->id}}">
                                                        <button type="submit" class="btn btn-sm btn-warning w-10">Update</i></button></a>
                                                    @else
                                                        <a href="#">
                                                        <button type="submit" class="btn btn-sm btn-info w-10"> </button></a>
                                                    @endif
                                                </td> 
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>                                            
                            @else
                                <h6 class="text-center text-black-50 p-3">No pending requests</h6>                
                            @endif
                        </div>
                    </div><!-----------------------------./Waitig---------------------------------->

                    <!-----------------------------delivered---------------------------------->
                    <div id="delivered" class="tab-pane fade">
                            <h3>DELIVERED SERVICES</h3>
                            <h4>TOTAL:&nbsp;<strong>{{$deliveredservices->count()}}</strong></h4>
                            <div class="well">
                                @if(count($deliveredservices)>0)  
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <tr>                                            
                                            <th>Service</th>
                                            <th>Cost</th>                                  
                                            <th>Details</th>
                                            <th>User</th>
                                            <th>Location</th>
                                            <th>Ordered On</th>
                                        </tr>
                                        @foreach($deliveredservices as $deliveredservice)
                                            <tr>
                                                <td>{{App\OfferingService::where('id', $deliveredservice->service)->get()->first()->name}}</td>
                                                <td>{{$deliveredservice->cost}}</td>
                                                <td>{{$deliveredservice->details}}</td> 
                                                <td>{{App\User::where('id', $deliveredservice->user)->get()->first()->name}}</td>                                            
                                                <td>{{$deliveredservice->location}}</td>
                                                <td>{{$deliveredservice->updated_at}}</td> 
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                                                
                                @else
                                    <h6 class="text-center text-black-50 p-3">No delivered orders</h6>                
                                @endif
                        </div><!-----------------------------./delivered---------------------------------->

                
                    </div>
                <!-----------------------------./Tab panes---------------------------------->

                    
                </div>
                <!-----------------------------./HERO---------------------------------->

            </div>
            <!-----------------------------./col-md-10---------------------------------->

        </div>
        <!-----------------------------./row---------------------------------->

        
@endsection
<!-----------------------------./Section---------------------------------->