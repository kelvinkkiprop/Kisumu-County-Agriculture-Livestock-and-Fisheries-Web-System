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
                            <a class="nav-link" data-toggle="tab" href="#supply">
                            <i class="fas fa-warehouse">&nbsp;Supplies</i></a>
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
                                <div class="col-md-3">
                                    <div class="stat-box">
                                        <h2><i class="fas fa-warehouse fa-1x">&nbsp;{{$supplies->count()}}</i></h2>
                                        <h4>Total Supplies</h4>	
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-box">
                                        <h2><i class="fas fa-arrow-circle-up fa-1x">&nbsp;{{$approvedsupplies->count()}}</i></h2>
                                        <h4>Approved Supplies</h4>	
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-box">
                                        <h2><i class="fas fa-arrows-alt-v fa-1x">&nbsp;{{$pendingsupplies->count()}}</i></h2>
                                        <h4>Pending Supplies</h4>	
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-box">
                                        <h2><i class="fas fa-arrow-circle-down fa-1x">&nbsp;{{$declinedsupplies->count()}}</i></h2>
                                        <h4>Declined Supplies</h4>	
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--./Overview-->
                        <!--Recent orders-->
                        <div class="card">
                            <div class="card-header">
                                <h5>Recent Supplies</h5>
                            </div>					
                            <div class="card-body">
                                @if(count($recentsupplies)>0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        @foreach($recentsupplies as $recentsupply)
                                        <tr>
                                            <td>{{$recentsupply->category}}</td>
                                            <td>{{$recentsupply->cost}}</td>
                                            <td>{{$recentsupply->quantity}}</td>                                            
                                            <td>{{$recentsupply->location}}</td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>                
                                @else
                                    <h6 class="text-center text-black-50 p-3">No recent supplies</h6>                
                                @endif
                            </div>	
                        </div>
                        <!--/.Recent orders-->        
                        </div>
                    </div>
                    <!-----------------------------./Analytics---------------------------------->

                    <!-----------------------------Supply---------------------------------->
                    <div id="supply" class="tab-pane fade">
                        <h3>SUPPLIES</h3>
                        <!--search-->
                            <form method="POST" action="suppliersearchupply">
                                @csrf 
                            <div class="row">
                                <div class="col-md-8">                            
                                    <h4>TOTAL:&nbsp;<strong>{{$supplies->count()}}</strong></h4>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" placeholder="Search" id="search_term" type="text" class="form-control{{ $errors->has('search_term') ? ' is-invalid' : '' }}"
                                        name="search_term" value="{{ old('search_term') }}">                                    
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary form-control" type="submit">
                                                <i class="fas fa-search fa-1x" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        @if ($errors->has('search_term'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('search_term') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            </form><!--./search-->
                            <hr/>
                        <div class="well">
                            @if(count($supplies)>0)  
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                            <th>Item</th>
                                            <th>Cost</th>
                                            <th>Quantity</th>
                                            <th>Details</th>
                                            <th>Image</th>
                                            <th>Added On</th>
                                            <th>Status</th>
                                        </tr>
                                        @foreach($supplies as $supply)
                                        <tr>
                                            <td>{{$supply->category}}</td>
                                            <td>{{$supply->cost}}</td>
                                            <td>{{$supply->quantity}}</td>                                            
                                            <td>{{$supply->details}}</td> 
                                            <td><img class="img-fluid" height="75" width="75" src="/uploads/images/{{$supply->image}}"></td>    
                                            <td>{{Carbon\Carbon::parse($supply->created_at)->format('d-m-Y h:ia')}}</td> 
                                            <td>
                                                @if($supply->status==0)                                                    
                                                    <p class="text-primary"><strong>Pending</strong></p>
                                                @elseif($supply->status==1)
                                                    <p class="text-success"><strong>Approved</strong></p>
                                                @else
                                                    <p class="text-danger"><strong>Declined</strong></p>
                                                @endif
                                            </td>                                                     
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            @else
                                <h6 class="text-center text-black-50 p-3">You have 0 supplies</h6>                
                            @endif
                        </div>
                    </div><!-----------------------------./Supply---------------------------------->

                </div>
                <!-----------------------------./Tab panes---------------------------------->

                    
                </div>
                <!-----------------------------./HERO---------------------------------->

            </div>
            <!-----------------------------./col-md-10---------------------------------->

        </div>
        <!-----------------------------./row---------------------------------->

    
    <!-----------------------------storesupply---------------------------------->
    <div id="addSupply" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content"> 
                <form enctype="multipart/form-data" method="POST" action="/storesupply">
                    @csrf    
                    <div class="modal-header bg-info text-white p-2">
                        <i class="fas fa-warehouse fa-1x" aria-hidden="true">&nbsp;Add Supply</i>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>         
                    </div>
                    <div class="modal-body">   
                        <div class="form-group row">
                            <label for="category" class="col-md-3 col-form-label text-md-right">{{ __('Category') }}</label>
                            <div class="col-md-7">
                                <select id="category" type="text" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" 
                                name="category" value="{{ old('category') }}">
                                <option>Fertilizers</option>
                                <option>Maize seeds</option>
                                <option>Insecticides</option>
                                <option>Herbicides</option>
                                <option>Plow/Plough</option>
                                <option>Seeders</option>
                                <option>Spade</option>
                                @if ($errors->has('category'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                                </select>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="quantity" class="col-md-3 col-form-label text-md-right">{{ __('Quantity/No.') }}</label>
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
                            <label for="cost" class="col-md-3 col-form-label text-md-right">{{ __('Cost per Each (Ksh)') }}</label>
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
                            <label for="details" class="col-md-3 col-form-label text-md-right">{{ __('Details') }}</label>
                            <div class="col-md-7">
                                <textarea id="details" type="details" class="form-control{{ $errors->has('details') ? ' is-invalid' : '' }}" 
                                name="details" value="{{ old('details') }}" cols="4" placeholder="Enter brief description"></textarea>
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
                        <button type="submit" class="btn btn-sm btn-secondary pull-right">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-----------------------------./storesupply---------------------------------->
        
@endsection
<!-----------------------------./Section---------------------------------->