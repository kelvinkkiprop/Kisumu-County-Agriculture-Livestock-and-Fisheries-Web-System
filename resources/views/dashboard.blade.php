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
                            <a class="nav-link" data-toggle="tab" href="#users">
                            <i class="fas fa-users">&nbsp;Users</i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#feedbacks">
                            <i class="fas fa-envelope" aria-hidden="true">&nbsp;Feedbacks</i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#deliveredproducts">
                            <i class="fas fa-praying-hands" aria-hidden="true">&nbsp;Delivered products</i></a>
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
                                <div class="col-md-4">
                                    <div class="stat-box">
                                        <h2><i class="fas fa-users fa-1x">&nbsp;{{$users->count()}}</i></h2>
                                        <h4>Users</h4>	
                                    </div>
                                </div>                               
                                <div class="col-md-4">
                                    <div class="stat-box">
                                        <h2><i class="fas fa-envelope fa-1x">&nbsp;{{$feedbacks->count()}}</i></h2>
                                        <h4>Feedbacks</h4>	
                                    </div>
                                </div>                                                               
                                <div class="col-md-4">
                                    <div class="stat-box">
                                        <h2><i class="fas fa-praying-hands fa-1x">&nbsp;{{$deliveredproducts->count()}}</i></h2>
                                        <h4>Delivered Products</h4>	
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--./Overview-->
                        <!--Latest Users-->
                        <div class="card">
                            <div class="card-header">
                                <h5>Latest Users</h5>
                            </div>					
                            <div class="card-body">
                                @if(count($latestusers)>0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        @foreach($latestusers as $latestuser)
                                        <tr>
                                            <td>{{$latestuser->name}}</td>
                                            <td>{{$latestuser->email}}</td>
                                            <td>{{$latestuser->type}}</td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>                
                                @else
                                    <h6 class="text-center text-black-50 p-3">No users</h6>                
                                @endif
                            </div>	
                        </div>
                        <!--/.Latest Users-->        
                        </div>
                    </div>
                    <!-----------------------------./Analytics---------------------------------->

                     <!-----------------------------Users---------------------------------->
                     <div id="users" class="tab-pane fade">
                        <h3>USERS</h3>                    
                        <!--search-->
                        <form method="POST" action="adminsearchuser">
                            @csrf 
                        <div class="row">
                            <div class="col-md-8">                            
                                <h4>TOTAL:&nbsp;<strong>{{$users->count()}}</strong></h4>
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

                     <!-----------------------------Accordion---------------------------------->                        
                     <div id="accordion-area">   
                        <button class="accordion">Farmers&nbsp;<strong>({{$users->where('type', 'Farmer')->count()}})
                        </strong></button>
                        <div class="panel">
                            <div class="well p-3">
                                @if(count($users->where('type', 'Farmer'))>0)  
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <tr>
                                            <th>Name</th>  
                                            <th>Type</th>                                  
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            {{-- <th>Joined</th> --}}
                                            <th colspan="3" class="text-center">Action</th>
                                        </tr>
                                        @foreach($users->where('type', 'Farmer') as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>   
                                            <td>{{$user->type}}</td>                                        
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->phone_number}}</td>
                                            <td>
                                                @if($user->status==1)
                                                    <label class="text-success">Approved</label>
                                                @else
                                                    <label class="text-danger">Pending</label>
                                                @endif
                                            </td>
                                            {{-- <td><small>{{Carbon\Carbon::parse($user->created_at)->format('d-m-Y h:ia')}}</small></td> --}}
                                            <td>
                                                @if($user->status==1 && $user->type != 'Admin')
                                                    <a href="blockuser/{{$user->id}}">
                                                    <button type="submit" class="btn btn-sm btn-warning w-10">Disapprove</i></button></a>
                                                @elseif($user->status==0 && $user->type != 'Admin')
                                                    <a href="unblockuser/{{$user->id}}">
                                                    <button type="submit" class="btn btn-sm btn-info w-10">Approve</button></a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->type !='Admin') 
                                                    <a class="btn btn-sm btn-dark w-100" href="#" data-toggle="modal" 
                                                    data-target="#editusermodal{{$user->id}}">Edit</a>                                                
                                                @endif
                                            <td>
                                                @if($user->type!='Admin')
                                                    <a class="btn btn-sm btn-danger w-100" href="deleteuser/{{$user->id}}">Delete</a>
                                                @else 
                                                {{-- <a class="btn btn-sm btn-danger w-100" href="#">Delete</a>                                              --}}
                                                @endif
                                            </td> 
    
                                            <!-----------------------------Edit User modal---------------------------------->
                                            <div id="editusermodal{{$user->id}}" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-md">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">                                                              
                                                    <form method="POST" action="updateuser/{{$user->id}}">
                                                        @csrf    
                                                        <div class="modal-header bg-info text-white p-2">
                                                            <i class="fas fa-pen fa-1x" aria-hidden="true">&nbsp;Edit User</i>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>         
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group row">
                                                                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>
                                                                <div class="col-md-7">
                                                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                                                    name="name" value="{{$user->name}}">
                                                                    @if ($errors->has('name'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('name') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="phone" class="col-md-3 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                                                                <div class="col-md-7">
                                                                    <input id="phone" type="number" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" 
                                                                    name="phone" value="{{ $user->phone_number }}">
                                                                    @if ($errors->has('phone'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="type" class="col-md-3 col-form-label text-md-right">{{ __('Account Type') }}</label>
                                                                <div class="col-md-7">
                                                                    <select id="type" type="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" 
                                                                    name="type" value="{{ old('type') }}">  
                                                                        <option>{{$user->type}}</option>                              
                                                                        <option>Agricultural Officer</option>
                                                                        <option>Driver</option>
                                                                        <option>Finance</option>
                                                                        <option>HR</option>
                                                                        <option>Procurement</option>
                                                                        <option>Supplier</option>
                                                                        <option>Veterinary</option>
                                                                    </select>
                                                                    @if ($errors->has('type'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('type') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>
                                                                <div class="col-md-7">
                                                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                                                    name="email" value="{{$user->email}}">
                                                                    @if ($errors->has('email'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('email') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>                            
                                                            <div class="form-group row">
                                                                <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>
                                                                <div class="col-md-7">
                                                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                                                                    name="password" value="{{$user->password}}">
                                                                    @if ($errors->has('password'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('password') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>                  
                                                        </div>
                                                        <div class="modal-footer bg-dark">
                                                            <button type="submit" class="btn btn-sm btn-secondary pull-right">Update User</button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-----------------------------./Edit User modal---------------------------------->
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                                @endif
                            </div>                            
                        </div>
                        
                        <button class="accordion">Staff&nbsp;<strong>({{$staffs->count()}})
                        </strong></button>
                        <div class="panel">
                            <div class="well p-3">
                                @if(count($staffs)>0)  
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <tr>
                                            <th>Name</th>  
                                            <th>Type</th>                                  
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            {{-- <th>Joined</th> --}}
                                            <th colspan="3" class="text-center">Action</th>
                                        </tr>
                                        @foreach($staffs as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>   
                                            <td>{{$user->type}}</td>                                        
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->phone_number}}</td>
                                            <td>
                                                @if($user->status==1)
                                                    <label class="text-success">Approved</label>
                                                @else
                                                    <label class="text-danger">Pending</label>
                                                @endif
                                            </td>
                                            {{-- <td><small>{{Carbon\Carbon::parse($user->created_at)->format('d-m-Y h:ia')}}</small></td> --}}
                                            <td>
                                                @if($user->status==1 && $user->type != 'Admin')
                                                    <a href="blockuser/{{$user->id}}">
                                                    <button type="submit" class="btn btn-sm btn-warning w-10">Disapprove</i></button></a>
                                                @elseif($user->status==0 && $user->type != 'Admin') 
                                                    <a href="unblockuser/{{$user->id}}">
                                                    <button type="submit" class="btn btn-sm btn-info w-10">Approve</button></a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->type !='Admin') 
                                                    <a class="btn btn-sm btn-dark w-100" href="#" data-toggle="modal" 
                                                    data-target="#editusermodal{{$user->id}}">Edit</a>                                                
                                                @endif
                                            <td>
                                                @if($user->type!='Admin')
                                                    <a class="btn btn-sm btn-danger w-100" href="deleteuser/{{$user->id}}">Delete</a>
                                                @else 
                                                {{-- <a class="btn btn-sm btn-danger w-100" href="#">Delete</a>                                              --}}
                                                @endif
                                            </td> 
    
                                            <!-----------------------------Edit User modal---------------------------------->
                                            <div id="editusermodal{{$user->id}}" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-md">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">                                                              
                                                    <form method="POST" action="updateuser/{{$user->id}}">
                                                        @csrf    
                                                        <div class="modal-header bg-info text-white p-2">
                                                            <i class="fas fa-pen fa-1x" aria-hidden="true">&nbsp;Edit User</i>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>         
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group row">
                                                                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>
                                                                <div class="col-md-7">
                                                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                                                    name="name" value="{{$user->name}}">
                                                                    @if ($errors->has('name'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('name') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="phone" class="col-md-3 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                                                                <div class="col-md-7">
                                                                    <input id="phone" type="number" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" 
                                                                    name="phone" value="{{ $user->phone_number }}">
                                                                    @if ($errors->has('phone'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="type" class="col-md-3 col-form-label text-md-right">{{ __('Account Type') }}</label>
                                                                <div class="col-md-7">
                                                                    <select id="type" type="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" 
                                                                    name="type" value="{{ old('type') }}">  
                                                                        <option>{{$user->type}}</option>                              
                                                                        <option>Agricultural Officer</option>
                                                                        <option>Driver</option>
                                                                        <option>Finance</option>
                                                                        <option>HR</option>
                                                                        <option>Procurement</option>
                                                                        <option>Supplier</option>
                                                                        <option>Veterinary</option>
                                                                    </select>
                                                                    @if ($errors->has('type'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('type') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>
                                                                <div class="col-md-7">
                                                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                                                    name="email" value="{{$user->email}}">
                                                                    @if ($errors->has('email'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('email') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>                            
                                                            <div class="form-group row">
                                                                <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>
                                                                <div class="col-md-7">
                                                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                                                                    name="password" value="{{$user->password}}">
                                                                    @if ($errors->has('password'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('password') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>                  
                                                        </div>
                                                        <div class="modal-footer bg-dark">
                                                            <button type="submit" class="btn btn-sm btn-secondary pull-right">Update User</button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-----------------------------./Edit User modal---------------------------------->
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                                @endif
                            </div>                            
                        </div>
                        
                        <button class="accordion">Suppliers&nbsp;<strong>({{($users->where('type', 'Supplier'))->count()}})
                        </strong></button>
                        <div class="panel">
                            <div class="well p-3">
                                @if(count($users->where('type', 'Supplier'))>0)  
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <tr>
                                            <th>Name</th>  
                                            <th>Type</th>                                  
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            {{-- <th>Joined</th> --}}
                                            <th colspan="3" class="text-center">Action</th>
                                        </tr>
                                        @foreach($users->where('type', 'Supplier') as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>   
                                            <td>{{$user->type}}</td>                                        
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->phone_number}}</td>
                                            <td>
                                                @if($user->status==1)
                                                    <label class="text-success">Approved</label>
                                                @else
                                                    <label class="text-danger">Pending</label>
                                                @endif
                                            </td>
                                            {{-- <td><small>{{Carbon\Carbon::parse($user->created_at)->format('d-m-Y h:ia')}}</small></td> --}}
                                            <td>
                                                @if($user->status==1 && $user->type != 'Admin')
                                                    <a href="blockuser/{{$user->id}}">
                                                    <button type="submit" class="btn btn-sm btn-warning w-10">Disapprove</i></button></a>
                                                @elseif($user->status==0 && $user->type != 'Admin')
                                                    <a href="unblockuser/{{$user->id}}">
                                                    <button type="submit" class="btn btn-sm btn-info w-10">Approve</button></a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->type !='Admin') 
                                                    <a class="btn btn-sm btn-dark w-100" href="#" data-toggle="modal" 
                                                    data-target="#editusermodal{{$user->id}}">Edit</a>                                                
                                                @endif
                                            <td>
                                                @if($user->type!='Admin')
                                                    <a class="btn btn-sm btn-danger w-100" href="deleteuser/{{$user->id}}">Delete</a>
                                                @else 
                                                {{-- <a class="btn btn-sm btn-danger w-100" href="#">Delete</a>                                              --}}
                                                @endif
                                            </td> 
    
                                            <!-----------------------------Edit User modal---------------------------------->
                                            <div id="editusermodal{{$user->id}}" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-md">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">                                                              
                                                    <form method="POST" action="updateuser/{{$user->id}}">
                                                        @csrf    
                                                        <div class="modal-header bg-info text-white p-2">
                                                            <i class="fas fa-pen fa-1x" aria-hidden="true">&nbsp;Edit User</i>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>         
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group row">
                                                                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>
                                                                <div class="col-md-7">
                                                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                                                    name="name" value="{{$user->name}}">
                                                                    @if ($errors->has('name'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('name') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="phone" class="col-md-3 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                                                                <div class="col-md-7">
                                                                    <input id="phone" type="number" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" 
                                                                    name="phone" value="{{ $user->phone_number }}">
                                                                    @if ($errors->has('phone'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="type" class="col-md-3 col-form-label text-md-right">{{ __('Account Type') }}</label>
                                                                <div class="col-md-7">
                                                                    <select id="type" type="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" 
                                                                    name="type" value="{{ old('type') }}">  
                                                                        <option>{{$user->type}}</option>                              
                                                                        <option>Agricultural Officer</option>
                                                                        <option>Driver</option>
                                                                        <option>Finance</option>
                                                                        <option>HR</option>
                                                                        <option>Procurement</option>
                                                                        <option>Supplier</option>
                                                                        <option>Veterinary</option>
                                                                    </select>
                                                                    @if ($errors->has('type'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('type') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>
                                                                <div class="col-md-7">
                                                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                                                    name="email" value="{{$user->email}}">
                                                                    @if ($errors->has('email'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('email') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>                            
                                                            <div class="form-group row">
                                                                <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>
                                                                <div class="col-md-7">
                                                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                                                                    name="password" value="{{$user->password}}">
                                                                    @if ($errors->has('password'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('password') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>                  
                                                        </div>
                                                        <div class="modal-footer bg-dark">
                                                            <button type="submit" class="btn btn-sm btn-secondary pull-right">Update User</button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-----------------------------./Edit User modal---------------------------------->
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                                @endif
                            </div>                            
                        </div>
                            
                        
                        <button class="accordion">Adminstrators&nbsp;<strong>({{$users->where('type', 'Admin')->count()}})</strong></button>
                        <div class="panel">
                            <div class="well p-3">
                                @if(count($users->where('type', 'Admin'))>0)  
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <tr>
                                            <th>Name</th>  
                                            <th>Type</th>                                  
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            {{-- <th>Joined</th> --}}
                                            <th colspan="3" class="text-center">Action</th>
                                        </tr>
                                        @foreach($users->where('type', 'Admin') as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>   
                                            <td>{{$user->type}}</td>                                        
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->phone_number}}</td>
                                            <td>
                                                @if($user->status==1)
                                                    <label class="text-success">Approved</label>
                                                @else
                                                    <label class="text-danger">Pending</label>
                                                @endif
                                            </td>
                                            {{-- <td><small>{{Carbon\Carbon::parse($user->created_at)->format('d-m-Y h:ia')}}</small></td> --}}
                                            <td>
                                                @if($user->status==1 && $user->type != 'Admin')
                                                    <a href="blockuser/{{$user->id}}">
                                                    <button type="submit" class="btn btn-sm btn-warning w-10">Disapprove</i></button></a>
                                                @elseif($user->status==0 && $user->type != 'Admin')
                                                    <a href="unblockuser/{{$user->id}}">
                                                    <button type="submit" class="btn btn-sm btn-info w-10">Approve</button></a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->type !='Admin') 
                                                    <a class="btn btn-sm btn-dark w-100" href="#" data-toggle="modal" 
                                                    data-target="#editusermodal{{$user->id}}">Edit</a>                                                
                                                @endif
                                            <td>
                                                @if($user->type!='Admin')
                                                    <a class="btn btn-sm btn-danger w-100" href="deleteuser/{{$user->id}}">Delete</a>
                                                @else 
                                                {{-- <a class="btn btn-sm btn-danger w-100" href="#">Delete</a>                                              --}}
                                                @endif
                                            </td> 
    
                                            <!-----------------------------Edit User modal---------------------------------->
                                            <div id="editusermodal{{$user->id}}" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-md">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">                                                              
                                                    <form method="POST" action="updateuser/{{$user->id}}">
                                                        @csrf    
                                                        <div class="modal-header bg-info text-white p-2">
                                                            <i class="fas fa-pen fa-1x" aria-hidden="true">&nbsp;Edit User</i>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>         
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group row">
                                                                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>
                                                                <div class="col-md-7">
                                                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                                                    name="name" value="{{$user->name}}">
                                                                    @if ($errors->has('name'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('name') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="phone" class="col-md-3 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                                                                <div class="col-md-7">
                                                                    <input id="phone" type="number" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" 
                                                                    name="phone" value="{{ $user->phone_number }}">
                                                                    @if ($errors->has('phone'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="type" class="col-md-3 col-form-label text-md-right">{{ __('Account Type') }}</label>
                                                                <div class="col-md-7">
                                                                    <select id="type" type="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" 
                                                                    name="type" value="{{ old('type') }}">  
                                                                        <option>{{$user->type}}</option>                              
                                                                        <option>Agricultural Officer</option>
                                                                        <option>Driver</option>
                                                                        <option>Finance</option>
                                                                        <option>HR</option>
                                                                        <option>Procurement</option>
                                                                        <option>Supplier</option>
                                                                        <option>Veterinary</option>
                                                                    </select>
                                                                    @if ($errors->has('type'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('type') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>
                                                                <div class="col-md-7">
                                                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                                                    name="email" value="{{$user->email}}">
                                                                    @if ($errors->has('email'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('email') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>                            
                                                            <div class="form-group row">
                                                                <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>
                                                                <div class="col-md-7">
                                                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                                                                    name="password" value="{{$user->password}}">
                                                                    @if ($errors->has('password'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('password') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>                  
                                                        </div>
                                                        <div class="modal-footer bg-dark">
                                                            <button type="submit" class="btn btn-sm btn-secondary pull-right">Update User</button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-----------------------------./Edit User modal---------------------------------->
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                                @endif
                            </div>                            
                        </div>
                        
                     </div>
                    <!-----------------------------./Accordion---------------------------------->

                        
                    </div><!-----------------------------./Users---------------------------------->


                    <!-----------------------------Feedbacks---------------------------------->
                    <div id="feedbacks" class="tab-pane fade">
                        <h3>FEEDBACK MESSAGES</h3>
                        <h4>TOTAL:&nbsp;<strong>{{$feedbacks->count()}}</strong></h4>
                            <div class="well"> 
                                @if(count($feedbacks)>0)
                                <div class="table-responsive">                            
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th>From</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Received on</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach($feedbacks as $feedback)
                                    <tr>
                                        <td>{{App\User::where('id', $feedback->sender)->get()->first()->name}}</td>
                                        <td>{{$feedback->email}}</td> 
                                        <td>{{$feedback->subject}}</td>
                                        <td>{{$feedback->message}}</td>                                    
                                        <td>{{Carbon\Carbon::parse($feedback->created_at)->format('d-m-Y h:ia')}}</td>
                                        <td>
                                            @if($feedback->status==1)
                                                <a class="btn btn-sm btn-success" href="#" data-toggle="modal" 
                                                data-target="#viewfeedback{{$feedback->id}}">View Reply</a>
                                            @else
                                                <a class="btn btn-sm btn-info" href="#" data-toggle="modal" 
                                                data-target="#replyfeedback{{$feedback->id}}">Reply</a>
                                            @endif
                                        </td>
                                              <!-----------------------------ReplyFeedbacks---------------------------------->
                                            <div id="replyfeedback{{$feedback->id}}" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-md">
                                                    <!-- Modal content-->
                                                    <div class="modal-content"> 
                                                        <form method="POST" action="replyfeedback/{{$feedback->sender}}/{{$feedback->id}}">
                                                            @csrf    
                                                            <div class="modal-header bg-info text-white p-2">
                                                                <i class="fas fa-reply fa-1x" aria-hidden="true">&nbsp;Reply</i>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>         
                                                            </div>
                                                            <div class="modal-body">  
                                                                <!-------------------------------Input------------------------------->
                                                                <div class="form-group row">
                                                                    <label for="message" class="col-md-3 col-form-label text-md-right">{{ __('Message') }}</label>
                                                                    <div class="col-md-7">
                                                                        <textarea id="message" type="text" class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" 
                                                                        name="message" value="{{ old('message') }}" cols="5"></textarea>
                                                                        @if ($errors->has('message'))
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $errors->first('message') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>                               
                                                                <!-------------------------------./Input------------------------------->
                                                            </div>
                                                            <div class="modal-footer bg-dark">
                                                                <button type="submit" class="btn btn-sm btn-secondary pull-right">Send</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-----------------------------./ReplyFeedbacks---------------------------------->
                                              <!-----------------------------viewfeedback---------------------------------->
                                              <div id="viewfeedback{{$feedback->id}}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-md">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">    
                                                                <div class="modal-header bg-info text-white">
                                                                    <strong>{{$feedback->subject}}</strong>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>         
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>{{$feedback->message}}</p>
                                                                </div>
                                                                <div class="modal-footer bg-dark">
                                                                    
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-----------------------------./viewfeedback---------------------------------->
                                        </tr>  
                                    @endforeach   
                                </table>
                                </div>                                                                             
                                @else
                                    <h6 class="text-center text-black-50 p-3">No feedback messages</h6>                
                                @endif
                            </div>
                    </div><!-----------------------------./Feedbacks---------------------------------->


                    <!-----------------------------deliveredproducts---------------------------------->
                    <div id="deliveredproducts" class="tab-pane fade">
                            <h3>DELIVERED PRODUCTS</h3>
                            <h4>TOTAL:&nbsp;<strong>{{$deliveredproducts->count()}}</strong></h4>
                                <div class="well"> 
                                    @if(count($deliveredproducts)>0)
                                    <div class="table-responsive">                            
                                    <table class="table table-striped table-bordered">
                                        <tr>
                                            <th>User</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Driver</th>
                                            <th>Delivered on</th>
                                        </tr>
                                        @foreach($deliveredproducts as $deliveredproduct)
                                        <tr>
                                            <td>{{App\User::where('id', $deliveredproduct->user)->get()->first()->name}}</td>
                                            <td>{{$deliveredproduct->category}}</td> 
                                            <td>{{$deliveredproduct->quantity}}</td>   
                                            <td>{{App\User::where('id', App\DriverCharges::where('charges', $deliveredproduct->driver_charges)->get()->first()->id)->get()->first()->name}}</td>                                 
                                            <td>{{Carbon\Carbon::parse($deliveredproduct->updated_at)->format('d-m-Y h:ia')}}</td>
                                        </tr>  
                                        @endforeach   
                                    </table>
                                    </div>                                                                             
                                    @else
                                        <h6 class="text-center text-black-50 p-3">No delivered products</h6>                
                                    @endif
                                </div>
                        </div><!-----------------------------./deliveredproducts---------------------------------->
    
                </div>
                <!-----------------------------./Tab panes---------------------------------->

                    
                </div>
                <!-----------------------------./HERO---------------------------------->

            </div>
            <!-----------------------------./col-md-10---------------------------------->

        </div>
        <!-----------------------------./row---------------------------------->


    <!-----------------------------Add User---------------------------------->
    <div id="addUser" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content"> 
                <form method="POST" action="/storeuser">
                    @csrf    
                    <div class="modal-header bg-info text-white p-2">
                        <i class="fas fa-user-plus fa-1x" aria-hidden="true">&nbsp;Add User</i>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>         
                    </div>
                    <div class="modal-body">   
                        <!-------------------------------Input------------------------------->
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
                            <label for="phone" class="col-md-3 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                            <div class="col-md-7">
                                <input id="phone" type="number" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" 
                                name="phone" value="{{ old('phone') }}">
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-md-3 col-form-label text-md-right">{{ __('Account Type') }}</label>
                            <div class="col-md-7">
                                <select id="type" type="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" 
                                name="type" value="{{ old('type') }}">                                
                                    <option>Agricultural Officer</option>
                                    <option>Driver</option>
                                    <option>Finance</option>
                                    <option>HR</option>
                                    <option>Procurement</option>
                                    <option>Supplier</option>
                                    <option>Veterinary</option>
                                </select>
                                @if ($errors->has('type'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>    
                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-7">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                                name="password" value="{{ old('password') }}">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                               
                        <!-------------------------------./Input------------------------------->
                    </div>
                    <div class="modal-footer bg-dark">
                        <button type="submit" class="btn btn-sm btn-secondary pull-right">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-----------------------------./Add User---------------------------------->


    <!-----------------------------report---------------------------------->
    <div id="report" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">   
                    <div class="modal-header bg-info text-white p-2">
                        <i class="fas fa-list-alt fa-1x" aria-hidden="true">&nbsp;Report</i>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>         
                    </div>
                    <div class="modal-body">   
                        <!-------------------------------Input------------------------------->
                        <div id="report_table">
                        <h4 class="p-1">{{config('app.name')}} Report as on {{Date('D-M-Y')}}</h4>
                        <hr>
                            <table id="tab_customers" class="table table-striped" >        
                                    <tr class='warning'>
                                        <th>Total Users.</th>
                                        <th>Total Feedbacks</th>
                                        <th>Total Delivered products</th>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">{{$users->count()}}</td> 
                                        <td class="text-muted">{{$feedbacks->count()}}</td>
                                        <td class="text-muted">{{$deliveredproducts->count()}}</td>
                                    </tr>
                            </table> 
                            </div>                              
                        <!-------------------------------./Input------------------------------->
                    </div>
                    <div class="modal-footer bg-dark">
                        <button type="submit" class="btn btn-sm btn-secondary pull-right"  onclick="javascript:demoFromHTML()">&nbsp;Print</button>
                    </div>
                </div>
            </div>
        </div>
        <!-----------------------------./report---------------------------------->


        
@endsection
<!-----------------------------./Section---------------------------------->




<script type="text/javascript">
    function demoFromHTML() {
        var pdf = new jsPDF('p', 'pt', 'letter');
        // source can be HTML-formatted string, or a reference
        // to an actual DOM element from which the text will be scraped.
        source = $('#report_table')[0];

        // we support special element handlers. Register them with jQuery-style 
        // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
        // There is no support for any other type of selectors 
        // (class, of compound) at this time.
        specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '#bypassme': function(element, renderer) {
                // true = "handled elsewhere, bypass text extraction"
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 522
        };
        // all coords and widths are in jsPDF instance's declared units
        // 'inches' in this case
        pdf.fromHTML(
                source, // HTML string or DOM elem ref.
                margins.left, // x coord
                margins.top, {// y coord
                    'width': margins.width, // max width of content on PDF
                    'elementHandlers': specialElementHandlers
                },
        function(dispose) {
            // dispose: object with X, Y of the last line add to the PDF 
            //          this allow the insertion of new lines after html
            pdf.save('Receipt.pdf');
        }
        , margins);
    }
</script>