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
                            <a class="nav-link" data-toggle="tab" href="#waiting">
                            <i class="fas fa-truck-loading">&nbsp;Waiting</i></a>
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
                                        <h2><i class="fas fa-truck fa-1x">&nbsp;{{$deliveredproducts->count()}}</i></h2>
                                        <h4>Delivered</h4>	
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="stat-box">
                                        <h2><i class="fas fa-truck-loading fa-1x">&nbsp;{{$pendingproducts->count()}}</i></h2>
                                        <h4>Pending</h4>	
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--./Overview-->
                         <!--Recent orders-->
                         <div class="card">
                            <div class="card-header">
                                <h5>Recent Orders</h5>
                            </div>					
                            <div class="card-body">
                                @if(count($recentorders)>0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        @foreach($recentorders as $recentorder)
                                        <tr>
                                            <td>{{$recentorder->category}}</td>
                                            <td>{{$recentorder->cost}}</td>
                                            <td>{{$recentorder->number}}</td>
                                            <td>{{$recentorder->variety}}</td>                                            
                                            <td>{{$recentorder->location}}</td>
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
                    <div id="waiting" class="tab-pane fade">
                        <h3>IN-WAIT DELIVERIES</h3>
                        <h4>TOTAL:&nbsp;<strong>{{$pendingproducts->count()}}</strong></h4>
                        <div class="well">
                            @if(count($pendingproducts)>0)  
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th>Item</th>
                                        <th>Cost</th>                                  
                                        <th>Number</th>
                                        <th>User</th>
                                        <th>Ordered On</th>
                                        <th>Location</th>
                                        <th>Action</th>
                                    </tr>
                                        @foreach($pendingproducts as $pendingproduct)
                                            <tr>
                                                <td>{{$pendingproduct->category}}</td>
                                                <td>{{$pendingproduct->cost}}</td>
                                                <td>{{$pendingproduct->number}}</td> 
                                                <td>{{App\User::where('id', $pendingproduct->user)->get()->first()->name}}</td> 
                                                <td>{{$pendingproduct->updated_at}}</td>                                            
                                                <td>{{$pendingproduct->location}}</td>
                                                <td>
                                                    @if($pendingproduct->delivery==1)
                                                        <a class="btn btn-sm btn-danger" href="disconfirmorderdelivered/{{$pendingproduct->id}}">Undo Confirmirmation</a>
                                                    @else
                                                        <a class="btn btn-sm btn-warning" href="confirmorderdelivered/{{$pendingproduct->id}}">Confirm delivered</a>
                                                    @endif
                                                </td> 
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>                                            
                            @else
                                <h6 class="text-center text-black-50 p-3">No waiting orders</h6>                
                            @endif
                        </div>
                    </div><!-----------------------------./In payments---------------------------------->

                    <!-----------------------------deliveredgoods---------------------------------->
                    <div id="delivered" class="tab-pane fade">
                            <h3>DELIVERED GOODS</h3>
                            <h4>TOTAL:&nbsp;<strong>{{$deliveredproducts->count()}}</strong></h4>
                            <div class="well">
                                @if(count($deliveredproducts)>0)  
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <tr>
                                            <th>Item</th>
                                            <th>Cost</th>                                  
                                            <th>Number</th>
                                            <th>User</th>
                                            <th>Ordered On</th>
                                            <th>Location</th>
                                        </tr>
                                        @foreach($deliveredproducts as $deliveredproduct)
                                            <tr>
                                                <td>{{$deliveredproduct->category}}</td>
                                                <td>{{$deliveredproduct->cost}}</td>
                                                <td>{{$deliveredproduct->quantity}}</td> 
                                                <td>{{App\User::where('id', $deliveredproduct->user)->get()->first()->name}}</td> 
                                                <td>{{$deliveredproduct->updated_at}}</td>                                            
                                                <td>{{$deliveredproduct->location}}</td> 
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                                                
                                @else
                                    <h6 class="text-center text-black-50 p-3">No delivered orders</h6>                
                                @endif
                        </div><!-----------------------------./deliveredgoods---------------------------------->

                </div>
                <!-----------------------------./Tab panes---------------------------------->

                    
                </div>
                <!-----------------------------./HERO---------------------------------->

            </div>
            <!-----------------------------./col-md-10---------------------------------->

        </div>
        <!-----------------------------./row---------------------------------->

    
    <!-----------------------------Add Stock---------------------------------->
    <div id="addStock" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content"> 
                <form enctype="multipart/form-data" method="POST" action="/storestock">
                    @csrf    
                    <div class="modal-header bg-info text-white p-2">
                        <i class="fas fa-store fa-1x" aria-hidden="true">&nbsp;Add Stock</i>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>         
                    </div>
                    <div class="modal-body">   
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label for="quantity" class="col-md-3 col-form-label text-md-right">{{ __('Quantity (Per Kg/Litre)') }}</label>
                            <div class="col-md-7">
                                <input id="quantity" type="number" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" 
                                name="quantity" value="{{ old('quantity') }}">
                                @if ($errors->has('quantity'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label for="cost" class="col-md-3 col-form-label text-md-right">{{ __('Cost (Per Kg/Litre(Ksh))') }}</label>
                            <div class="col-md-7">
                                <input id="cost" type="number" class="form-control{{ $errors->has('cost') ? ' is-invalid' : '' }}" 
                                name="cost" value="{{ old('cost') }}">
                                @if ($errors->has('cost'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cost') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                           
                        <div class="form-group row">
                            <label for="variety" class="col-md-3 col-form-label text-md-right">{{ __('Variety') }}</label>
                            <div class="col-md-7">
                                <input id="variety" type="text" class="form-control{{ $errors->has('variety') ? ' is-invalid' : '' }}" 
                                name="variety" value="{{ old('variety') }}" placeholder="E.g Indigenous">
                                @if ($errors->has('variety'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('variety') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="details" class="col-md-3 col-form-label text-md-right">{{ __('Details') }}</label>
                            <div class="col-md-7">
                                <textarea id="details" type="details" class="form-control{{ $errors->has('details') ? ' is-invalid' : '' }}" 
                                name="details" value="{{ old('details') }}" cols="4"></textarea>
                                @if ($errors->has('details'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('details') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>    
                        <div class="form-group row">
                            <label for="image" class="col-md-3 col-form-label text-md-right">{{ __('Image') }}</label>
                            <div class="col-md-7">
                                <input id="image" type="file" class="form-control-file{{ $errors->has('image') ? ' is-invalid' : '' }}" 
                                name="image" value="{{ old('image') }}">
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>  
                    </div>
                    <div class="modal-footer bg-dark">
                        <button type="submit" class="btn btn-sm btn-secondary pull-right">Add Stock</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-----------------------------./Add Stock---------------------------------->
        
@endsection
<!-----------------------------./Section---------------------------------->