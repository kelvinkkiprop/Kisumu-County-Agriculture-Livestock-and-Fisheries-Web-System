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
                            <a class="nav-link" data-toggle="tab" href="#supplies">
                            <i class="fas fa-warehouse">&nbsp;Supplies</i></a>
                        </li>                        
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#stock">
                            <i class="fas fa-store">&nbsp;Stock</i></a>
                        </li>                        
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tenders">
                            <i class="fas fa-truck">&nbsp;Tenders</i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tendersapplications">
                            <i class="fas fa-list-alt">&nbsp;Tenders Applications</i></a>
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
                                        <h2><i class="fas fa-warehouse fa-1x">&nbsp;{{$pendingsupplies->count()}}</i></h2>
                                        <h4>New supplies</h4>	
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="stat-box">
                                        <h2><i class="fas fa-list-alt fa-1x">&nbsp;{{$tenderapplications->count()}}</i></h2>
                                        <h4>Tender Applications</h4>	
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--./Overview-->
                        <!--Latest -->
                        <div class="card">
                            <div class="card-header">
                                <h5>Latest Supplies</h5>
                            </div>					
                            <div class="card-body">
                                @if(count($latestsupplies)>0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        @foreach($latestsupplies as $latestsupply)
                                        <tr>
                                            <td>{{$latestsupply->category}}</td>
                                            <td>{{$latestsupply->cost}}</td>
                                            <td>{{$latestsupply->quantity}}</td>                                            
                                            <td>{{$latestsupply->details}}</td> 
                                            <td>{{$latestsupply->created_at}}</td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>                
                                @else
                                    <h6 class="text-center text-black-50 p-3">No recent tender applications</h6>                
                                @endif
                            </div>	
                        </div>
                        <!--/.Latest-->        
                        </div>
                    </div>
                    <!-----------------------------./Analytics---------------------------------->

                <!-----------------------------supplies---------------------------------->
                <div id="supplies" class="tab-pane fade">
                    <h3>SUPPLIES</h3>
                    <!--search-->
                    <form method="POST" action="procurementsearchsupply">
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
                                    <th>Status</th>
                                    <th>Added On</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($supplies as $supply)
                                <tr>
                                    <td>{{$supply->category}}</td>
                                    <td>{{$supply->cost}}</td>
                                    <td>{{$supply->quantity}}</td>                                             
                                    <td>{{$supply->details}}</td> 
                                    <td><img class="img-fluid" height="75" width="75" src="/uploads/images/{{$supply->image}}"></td>    
                                    <td>
                                        @if($supply->status == 0)
                                            <label class="text-primary">New</label>
                                        @elseif($supply->status == 1)
                                            <label class="text-success">Approved</label>
                                        @elseif($supply->status == 2)
                                        <label class="text-danger">Declined</label>
                                        @endif
                                    </td>
                                    <td>{{Carbon\Carbon::parse($supply->created_at)->format('d-m-Y h:ia')}}</td>  
                                    <td>
                                        @if($supply->status==0)
                                            <a class="btn btn-sm btn-danger" href="/declinesupply/{{$supply->id}}">Decline Supply</a>
                                            <a class="btn btn-sm btn-success" href="/approvesupply/{{$supply->id}}">Approve Supply</a>
                                        @elseif($supply->status==1)
                                            <a class="btn btn-sm btn-warning" href="/declinesupply/{{$supply->id}}">Disapprove Supply</a>
                                        @elseif($supply->status==2)
                                            <a class="btn btn-sm btn-success" href="/approvesupply/{{$supply->id}}">Approve Supply</a>
                                        @endif
                                    </td>                 
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        @else
                            <h6 class="text-center text-black-50 p-3">No supplies</h6>                
                        @endif
                    </div>
                </div><!-----------------------------./supplies---------------------------------->


                  <!-----------------------------stock---------------------------------->
                  <div id="stock" class="tab-pane fade">
                        <h3>STOCK</h3>
                        <div class="well">
                            @if(count($stocks)>0)  
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                            <th>Item</th>
                                            <th>Cost</th>
                                            <th>Remaining</th>
                                            <th>Details</th>
                                            <th>Image</th>
                                            <th>Added On</th>
                                        </tr>
                                        @foreach($stocks as $stock)
                                        <tr>
                                            <td>{{$stock->category}}</td>
                                            <td>{{$stock->cost}}</td>
                                            <td>{{$stock->quantity}}</td>                                            
                                            <td>{{$stock->details}}</td> 
                                            <td><img class="img-fluid" height="75" width="75" src="/uploads/images/{{$stock->image}}"></td>    
                                            <td>{{Carbon\Carbon::parse($stock->created_at)->format('d-m-Y h:ia')}}</td>                                                     
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            @else
                                <h6 class="text-center text-black-50 p-3">You have 0 stock</h6>                
                            @endif
                        </div>
                    </div><!-----------------------------./stock---------------------------------->


                <!-----------------------------Tenders---------------------------------->
                <div id="tenders" class="tab-pane fade">
                    <h3>TENDERS</h3>
                    <h4>TOTAL:&nbsp;<strong>{{$tenders->count()}}</strong></h4>
                        <div class="well"> 
                            @if(count($tenders)>0)
                            <div class="table-responsive">                            
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Date Created</th>
                                    <th colspan="3" class="text-center">Action</th>
                                </tr>
                                @foreach($tenders as $tender)
                                <tr>
                                    <td>{{$tender->title}}</td>
                                    <td>{{$tender->description}}</td>
                                    <td>{{Carbon\Carbon::parse($tender->created_at)->format('d-m-Y h:ia')}}</td>
                                    <td><a href="#" class="btn btn-sm btn-secondary w-100"
                                        data-toggle="modal" data-target="#editTenderModal{{$tender->id}}">Edit</a></td>
                                    <td><a href="deletetender/{{$tender->id}}" class="btn btn-sm btn-warning w-75">Delete</a></td>
                                    <!-----------------------------Edit Tender---------------------------------->
                                    <div id="editTenderModal{{$tender->id}}" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-md">
                                            <!-- Modal content-->
                                            <div class="modal-content"> 
                                                <form method="POST" action="/updatetender/{{$tender->id}}">
                                                    @csrf    
                                                    <div class="modal-header bg-info text-white p-2">
                                                        <i class="fa fa-pencil fa-1x" aria-hidden="true">&nbsp;Edit Tender</i>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>         
                                                    </div>
                                                    <div class="modal-body">   
                                                        <div class="form-group row">
                                                            <label for="title" class="col-md-3 col-form-label text-md-right">{{ __('Title') }}</label>
                                                            <div class="col-md-7">
                                                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" 
                                                                name="title" value="{{$tender->title}}">
                                                                @if ($errors->has('title'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('title') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="description" class="col-md-3 col-form-label text-md-right">{{ __('Description') }}</label>
                                                            <div class="col-md-7">
                                                                <textarea id="description" type="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" 
                                                                name="description" value="{{ old('description') }}" cols="4">{{$tender->description}}</textarea>
                                                                @if ($errors->has('description'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('description') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>    
                                                        <div class="form-group row">
                                                            <label for="closing_date" class="col-md-3 col-form-label text-md-right">{{ __('Closing Date') }}</label>
                                                            <div class="col-md-7">
                                                                <input id="password" type="date" class="form-control{{ $errors->has('closing_date') ? ' is-invalid' : '' }}" 
                                                                name="closing_date" value="{{$tender->closing_date}}">
                                                                @if ($errors->has('closing_date'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('closing_date') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>  
                                                    </div>
                                                    <div class="modal-footer bg-dark">
                                                        <button type="submit" class="btn btn-sm btn-secondary pull-right">Update Tender</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-----------------------------./Edit Tender---------------------------------->
                            </tr>  
                                @endforeach   
                            </table>
                            </div>                                                                             
                            @else
                                <h6 class="text-center text-black-50 p-3">No Tenders</h6>                
                            @endif
                        </div>
                </div><!-----------------------------./Tenders---------------------------------->


                <!-----------------------------tendersapplication---------------------------------->
                <div id="tendersapplications" class="tab-pane fade">
                    <h3>TENDER APPLICATIONS</h3>
                    <h4>TOTAL:&nbsp;<strong>{{$tenderapplications->count()}}</strong></h4>
                        <div class="well"> 
                            @if(count($tenderapplications)>0)
                            <div class="table-responsive">                            
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>Tender</th>
                                    <th>User</th>
                                    <th>Description</th>
                                    <th>Date Created</th>
                                    <th colspan="3" class="text-center">Action</th>
                                </tr>
                                
                                @foreach($tenderapplications as $tenderapplication)
                                <tr>
                                    <td>{{$tenderapplication->tender}}</td>
                                    <td>{{App\User::where('id', $tenderapplication->user)->get()->first()->name}}</td>
                                    <td>{{$tenderapplication->description}}</td>
                                    <td>{{Carbon\Carbon::parse($tenderapplication->created_at)->format('d-m-Y h:ia')}}</td>
                                    <td>
                                        @if($tenderapplication->status==1)
                                        <a class="btn btn-sm btn-info w-100" href="#" data-toggle="modal" 
                                        data-target="#viewcertificatemodal{{$tenderapplication->id}}">View certificate</a> 
                                        @else
                                        <a class="btn btn-sm btn-info w-100" href="#" data-toggle="modal" 
                                        data-target="#viewcertificatemodal{{$tenderapplication->id}}">View certificate</a> 
                                        @endif

                                        <!-----------------------------Viewcert modal---------------------------------->
                                        <div id="viewcertificatemodal{{$tenderapplication->id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-md">
                                                <!-- Modal content-->
                                                <div class="modal-content">      
                                                    @csrf    
                                                    <div class="modal-header bg-info text-white p-2">
                                                        <i class="fas fa-certificate fa-1x" aria-hidden="true">&nbsp;Company Cerificate</i>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>         
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="uploads/images/{{$tenderapplication->certificate}}" alt="{{$tenderapplication->certificate}}" width="100%" height="333">                 
                                                    </div>
                                                    <div class="modal-footer bg-dark">
                                                        @if($tenderapplication->status==1)
                                                            <a href="disapprovetender/{{$tenderapplication->id}}">
                                                            <button type="submit" class="btn btn-sm btn-warning w-10">Disapprove</i></button></a>
                                                        @else
                                                            <a href="approvetender/{{$tenderapplication->id}}">
                                                            <button type="submit" class="btn btn-sm btn-secondary w-10">Approve</button></a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-----------------------------./Viewcert modal---------------------------------->

                                    </td>
                                </tr>
                                @endforeach
                            </table>
                            </div>
                            @else
                                <h6 class="text-center text-black-50 p-3">No tenders</h6>                
                            @endif
                        </div>
                </div><!-----------------------------./tendersapplication---------------------------------->
        
                    
            </div>
            <!-----------------------------./Tab panes---------------------------------->

                                
                            </div>
                            <!-----------------------------./HERO---------------------------------->

                        </div>
                        <!-----------------------------./col-md-10---------------------------------->

                    </div>
                    <!-----------------------------./row---------------------------------->




                <!-----------------------------Add Tender---------------------------------->
                <div id="addTender" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-md">
                        <!-- Modal content-->
                        <div class="modal-content"> 
                            <form method="POST" action="/storetender">
                                @csrf    
                                <div class="modal-header bg-info text-white p-2">
                                    <i class="fa fa-car fa-1x" aria-hidden="true">&nbsp;Add Tender</i>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>         
                                </div>
                                <div class="modal-body">   
                                    <div class="form-group row">
                                        <label for="title" class="col-md-3 col-form-label text-md-right">{{ __('Title') }}</label>
                                        <div class="col-md-7">
                                            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" 
                                            name="title" value="{{ old('title') }}">
                                            @if ($errors->has('title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-md-3 col-form-label text-md-right">{{ __('Description') }}</label>
                                        <div class="col-md-7">
                                            <textarea id="description" type="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" 
                                            name="description" value="{{ old('description') }}" cols="4"></textarea>
                                            @if ($errors->has('description'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>    
                                    <div class="form-group row">
                                        <label for="closing_date" class="col-md-3 col-form-label text-md-right">{{ __('Closing Date') }}</label>
                                        <div class="col-md-7">
                                            <input id="closing_date" type="date" class="form-control{{ $errors->has('closing_date') ? ' is-invalid' : '' }}" 
                                            name="closing_date" value="{{ old('closing_date') }}">
                                            @if ($errors->has('closing_date'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('closing_date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>  
                                </div>
                                <div class="modal-footer bg-dark">
                                    <button type="submit" class="btn btn-sm btn-secondary pull-right">Add Tender</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-----------------------------./Add Tender---------------------------------->
                

@endsection
<!-----------------------------./Section---------------------------------->