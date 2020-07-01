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
                            <a class="nav-link" data-toggle="tab" href="#announcements">
                            <i class="fas fa-globe">&nbsp;Announcements</i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#vacancies">
                            <i class="fas fa-list-alt">&nbsp;Vacancies</i></a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#updates">
                            <i class="fas fa-crosshairs">&nbsp;Updates</i></a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#vacancyapplications">
                            <i class="fas fa-briefcase">&nbsp;Vacancy Applications</i></a>
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
                                        <h2><i class="fas fa-globe fa-1x">&nbsp;{{$announcements->count()}}</i></h2>
                                        <h4>Announcements</h4>	
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="stat-box">
                                        <h2><i class="fas fa-list-alt fa-1x">&nbsp;{{$vacancies->count()}}</i></h2>
                                        <h4>Vacancies</h4>	
                                    </div>
                                </div>                               
                                <div class="col-md-4">
                                    <div class="stat-box">
                                        <h2><i class="fas fa-crosshairs fa-1x">&nbsp;{{$updates->count()}}</i></h2>
                                        <h4>Updates</h4>	
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--./Overview-->
                        <!--Latest -->
                        <div class="card">
                            <div class="card-header">
                                <h5>Latest Feedbacks</h5>
                            </div>					
                            <div class="card-body">
                                @if(count($feedbacks)>0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        @foreach($feedbacks as $feedback)
                                        <tr>
                                            <td>{{$feedback->name}}</td>
                                            <td>{{$feedback->email}}</td>
                                            <td>{{$feedback->type}}</td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>                
                                @else
                                    <h6 class="text-center text-black-50 p-3">No recent feedbacks</h6>                
                                @endif
                            </div>	
                        </div>
                        <!--/.Latest-->        
                        </div>
                    </div>
                    <!-----------------------------./Analytics---------------------------------->

                    <!-----------------------------Announcements---------------------------------->
                    <div id="announcements" class="tab-pane fade">
                        <h3>ANNOUNCEMENTS</h3>
                        <h4>TOTAL:&nbsp;<strong>{{$announcements->count()}}</strong></h4>
                            <div class="well"> 
                                @if(count($announcements)>0)
                                <div class="table-responsive">                            
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th>Title</th>
                                        <th>Shouter</th>
                                        <th>Description</th>
                                        <th>Date Created</th>
                                        <th colspan="3" class="text-center">Action</th>
                                    </tr>
                                    @foreach($announcements as $announcement)
                                    <tr>
                                        <td>{{$announcement->title}}</td>
                                        <td>{{$announcement->shouter}}</td>
                                        <td>{{$announcement->description}}</td>
                                        <td>{{Carbon\Carbon::parse($announcement->created_at)->format('d-m-Y h:ia')}}</td>
                                        <td><a href="#" class="btn btn-sm btn-secondary w-100"
                                            data-toggle="modal" data-target="#editAnnouncementModal{{$announcement->id}}">Edit</a></td>
                                        <td><a href="deleteannouncement/{{$announcement->id}}" class="btn btn-sm btn-warning w-75">Delete</a></td>
                                    <!-----------------------------Edit Announcement---------------------------------->
                                    <div id="editAnnouncementModal{{$announcement->id}}" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-md">
                                            <!-- Modal content-->
                                            <div class="modal-content"> 
                                                <form method="POST" action="/updateannouncement/{{$announcement->id}}">
                                                    @csrf    
                                                    <div class="modal-header bg-info text-white p-2">
                                                        <i class="fa fa-pencil fa-1x" aria-hidden="true">&nbsp;Edit Announcement</i>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>         
                                                    </div>
                                                    <div class="modal-body">   
                                                        <div class="form-group row">
                                                            <label for="title" class="col-md-3 col-form-label text-md-right">{{ __('Title') }}</label>
                                                            <div class="col-md-7">
                                                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" 
                                                                name="title" value="{{$announcement->title}}">
                                                                @if ($errors->has('title'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('title') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="shouter" class="col-md-3 col-form-label text-md-right">{{ __('Shouter') }}</label>
                                                            <div class="col-md-7">
                                                                <input id="shouter" type="shouter" class="form-control{{ $errors->has('shouter') ? ' is-invalid' : '' }}" 
                                                                name="shouter" value="{{$announcement->shouter}}">
                                                                @if ($errors->has('shouter'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('shouter') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="description" class="col-md-3 col-form-label text-md-right">{{ __('Description') }}</label>
                                                            <div class="col-md-7">
                                                                <textarea id="description" type="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" 
                                                                name="description" value="{{ old('description') }}" cols="4">{{$announcement->description}}</textarea>
                                                                @if ($errors->has('description'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('description') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>    
                                                        <div class="form-group row">
                                                            <label for="expiry_date" class="col-md-3 col-form-label text-md-right">{{ __('Expiry Date') }}</label>
                                                            <div class="col-md-7">
                                                                <input id="expiry_date" type="date" class="form-control{{ $errors->has('expiry_date') ? ' is-invalid' : '' }}" 
                                                                name="expiry_date" value="{{$announcement->expiry_date}}">
                                                                @if ($errors->has('expiry_date'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('expiry_date') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>  
                                                    </div>
                                                    <div class="modal-footer bg-dark">
                                                        <button type="submit" class="btn btn-sm btn-secondary pull-right">Update Announcement</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-----------------------------./Edit Announcement---------------------------------->
                                    </tr>  
                                    @endforeach
                                </table>
                                </div>
                                @else
                                    <h6 class="text-center text-black-50 p-3">No announcements</h6>                
                                @endif
                            </div>
                    </div><!-----------------------------./Announcements---------------------------------->
                    
                    <!-----------------------------Vacancies---------------------------------->
                    <div id="vacancies" class="tab-pane fade">
                        <h3>VACANCIES</h3>
                        <h4>TOTAL:&nbsp;<strong>{{$vacancies->count()}}</strong></h4>
                            <div class="well"> 
                                @if(count($vacancies)>0)
                                <div class="table-responsive">                            
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th>Position</th>
                                        <th>Number</th>
                                        <th>Description</th>
                                        <th>Date Created</th>
                                        <th colspan="3" class="text-center">Action</th>
                                    </tr>
                                    @foreach($vacancies as $vacancy)
                                    <tr>
                                        <td>{{$vacancy->position}}</td>
                                        <td>{{$vacancy->number}}</td>
                                        <td>{{$vacancy->description}}</td>
                                        <td>{{Carbon\Carbon::parse($vacancy->created_at)->format('d-m-Y h:ia')}}</td><td><a href="#" class="btn btn-sm btn-secondary w-100"
                                            data-toggle="modal" data-target="#editVacancyModal1{{$vacancy->id}}">Edit</a></td>
                                        <td><a href="deletevacancy/{{$vacancy->id}}" class="btn btn-sm btn-warning">Delete</a></td>
                                        <!-----------------------------Edit Vacancy---------------------------------->
                                        <div id="editVacancyModal1{{$vacancy->id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-md">
                                                <!-- Modal content-->
                                                <div class="modal-content"> 
                                                    <form method="POST" action="/updatevacancy/{{$vacancy->id}}">
                                                        @csrf    
                                                        <div class="modal-header bg-info text-white p-2">
                                                            <i class="fa fa-pencil fa-1x" aria-hidden="true">&nbsp;Edit Vacancy</i>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>         
                                                        </div>
                                                        <div class="modal-body">   
                                                            <div class="form-group row">
                                                                <label for="position" class="col-md-3 col-form-label text-md-right">{{ __('Position') }}</label>
                                                                <div class="col-md-7">
                                                                    <input id="position" type="text" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" 
                                                                    name="position" value="{{$vacancy->position}}">
                                                                    @if ($errors->has('position'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('position') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="number" class="col-md-3 col-form-label text-md-right">{{ __('Number') }}</label>
                                                                <div class="col-md-7">
                                                                    <input id="number" type="number" class="form-control{{ $errors->has('number') ? ' is-invalid' : '' }}" 
                                                                    name="number" value="{{$vacancy->number}}">
                                                                    @if ($errors->has('number'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('number') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="description" class="col-md-3 col-form-label text-md-right">{{ __('Description') }}</label>
                                                                <div class="col-md-7">
                                                                    <textarea id="description" type="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" 
                                                                    name="description" value="{{ old('description') }}" cols="4">{{$vacancy->description}}</textarea>
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
                                                                    name="closing_date" value="{{$vacancy->closing_date}}">
                                                                    @if ($errors->has('closing_date'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('closing_date') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>  
                                                        </div>
                                                        <div class="modal-footer bg-dark">
                                                            <button type="submit" class="btn btn-sm btn-secondary pull-right">Update Vacancy</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-----------------------------./Edit Vacancy---------------------------------->
                                    </tr>  
                                    @endforeach   
                                </table>
                                </div>                                                                                 
                                @else
                                    <h6 class="text-center text-black-50 p-3">No vacancies</h6>                
                                @endif
                            </div>
                    </div><!-----------------------------./Vacancies---------------------------------->

                     <!-----------------------------Updates---------------------------------->
                     <div id="updates" class="tab-pane fade">
                        <h3>UPDATES</h3>
                        <h4>TOTAL:&nbsp;<strong>{{$updates->count()}}</strong></h4>
                            <div class="well"> 
                                @if(count($updates)>0)
                                <div class="table-responsive">                            
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th>Caption</th>
                                        <th>Details</th>
                                        <th>Image</th>
                                        <th>Date Created</th>
                                        <th colspan="3" class="text-center">Action</th>
                                    </tr>
                                    @foreach($updates as $update)
                                    <tr>
                                        <td>{{$update->caption}}</td>
                                        <td>{{$update->details}}</td>
                                        <td><img class="img-fluid rounded-image" src="/uploads/images/{{$update->image}}"></td>
                                        <td>{{Carbon\Carbon::parse($update->created_at)->format('d-m-Y h:ia')}}</td>
                                        <td><a href="#" class="btn btn-sm btn-secondary"
                                            data-toggle="modal" data-target="#editUpdateModal{{$update->id}}">Edit</a></td>
                                        <td><a href="deleteupdate/{{$update->id}}" class="btn btn-sm btn-warning">Delete</a></td>
                                        <!-----------------------------Edit Update---------------------------------->
                                        <div id="editUpdateModal{{$update->id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-md">
                                                <!-- Modal content-->
                                                <div class="modal-content"> 
                                                    <form enctype="multipart/form-data" method="POST" action="/updateupdate/{{$update->id}}">
                                                        @csrf    
                                                        <div class="modal-header bg-info text-white p-2">
                                                            <i class="fa fa-pencil fa-1x" aria-hidden="true">&nbsp;Edit Update</i>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>         
                                                        </div>
                                                        <div class="modal-body">   
                                                            <div class="form-group row">
                                                                <label for="title" class="col-md-3 col-form-label text-md-right">{{ __('Caption') }}</label>
                                                                <div class="col-md-7">
                                                                    <input id="caption" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" 
                                                                    name="caption" value="{{$update->caption}}">
                                                                    @if ($errors->has('caption'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('caption') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="details" class="col-md-3 col-form-label text-md-right">{{ __('Details') }}</label>
                                                                <div class="col-md-7">
                                                                    <textarea id="details" type="details" class="form-control{{ $errors->has('details') ? ' is-invalid' : '' }}" 
                                                                    name="details" value="{{$update->details}}" cols="4">{{$update->details}}</textarea>
                                                                    @if ($errors->has('details'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('description') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>    
                                                            <div class="form-group row">
                                                                <label for="image" class="col-md-3 col-form-label text-md-right">{{ __('Image') }}</label>
                                                                <div class="col-md-7">
                                                                    <input id="image" type="file" class="form-control-file{{ $errors->has('image') ? ' is-invalid' : '' }}" 
                                                                    name="image" value="{{$update->image}}">
                                                                    @if ($errors->has('image'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('image') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>  
                                                        </div>
                                                        <div class="modal-footer bg-dark">
                                                            <button type="submit" class="btn btn-sm btn-secondary pull-right">Save Update</button>
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
                                    <h6 class="text-center text-black-50 p-3">No updates</h6>                
                                @endif
                            </div>
                    </div><!-----------------------------./Updates---------------------------------->

                    <!-----------------------------VacancyApplication---------------------------------->
                    <div id="vacancyapplications" class="tab-pane fade">
                        <h3>VACANCY APPLICATIONS</h3>
                        <h4>TOTAL:&nbsp;<strong>{{$vacanyapplications->count()}}</strong></h4>
                            <div class="well"> 
                                @if(count($vacanyapplications)>0)
                                <div class="table-responsive">                            
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>CV</th>
                                        <th>Date</th>
                                    </tr>
                                    @foreach($vacanyapplications as $vacanyapplication)
                                    <tr>
                                        <td>{{$vacanyapplication->name}}</td>
                                        <td>{{$vacanyapplication->position}}</td>
                                        <td><a href="/uploads/documents/{{$vacanyapplication->cv}}" download>
                                            <button type="button" class="btn btn-info" 
                                            title="Click to download CV">Download</button></a></td>	
                                        <td>{{Carbon\Carbon::parse($vacanyapplication->created_at)->format('d-m-Y h:ia')}}</td>
                                     </tr>  
                                    @endforeach   
                                </table>
                                </div>                                                                             
                                @else
                                    <h6 class="text-center text-black-50 p-3">No vacancy applications</h6>                
                                @endif
                            </div>
                    </div><!-----------------------------./VacancyApplication---------------------------------->


                </div>
                <!-----------------------------./Tab panes---------------------------------->

                    
                </div>
                <!-----------------------------./HERO---------------------------------->

            </div>
            <!-----------------------------./col-md-10---------------------------------->

        </div>
        <!-----------------------------./row---------------------------------->


    <!-----------------------------Add Announcements---------------------------------->
    <div id="addAnnouncement" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content"> 
                <form method="POST" action="/storeannouncement">
                    @csrf    
                    <div class="modal-header bg-info text-white p-2">
                        <i class="fa fa-globe fa-1x" aria-hidden="true">&nbsp;Add Announcement</i>
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
                            <label for="shouter" class="col-md-3 col-form-label text-md-right">{{ __('Shouter') }}</label>
                            <div class="col-md-7">
                                <input id="shouter" type="text" class="form-control{{ $errors->has('shouter') ? ' is-invalid' : '' }}" 
                                name="shouter" value="{{ old('number') }}" placeholder="e.g Attention!">
                                @if ($errors->has('shouter'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('shouter') }}</strong>
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
                            <label for="expiry_date" class="col-md-3 col-form-label text-md-right">{{ __('Expiry Date') }}</label>
                            <div class="col-md-7">
                                <input id="expiry_date" type="date" class="form-control{{ $errors->has('expiry_date') ? ' is-invalid' : '' }}" 
                                name="expiry_date" value="{{ old('expiry_date') }}">
                                @if ($errors->has('expiry_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('expiry_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>  
                    </div>
                    <div class="modal-footer bg-dark">
                        <button type="submit" class="btn btn-sm btn-secondary pull-right">Add Announcement</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-----------------------------./Add Announcement---------------------------------->

    <!-----------------------------Add Vacancy---------------------------------->
    <div id="addVacancy" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content"> 
                <form method="POST" action="/storevacancy">
                    @csrf    
                    <div class="modal-header bg-info text-white p-2">
                        <i class="fa fa-list fa-1x" aria-hidden="true">&nbsp;Add Vacancy</i>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>         
                    </div>
                    <div class="modal-body">   
                        <div class="form-group row">
                            <label for="position" class="col-md-3 col-form-label text-md-right">{{ __('Position') }}</label>
                            <div class="col-md-7">
                                <input id="position" type="text" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" 
                                name="position" value="{{ old('position') }}">
                                @if ($errors->has('position'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="number" class="col-md-3 col-form-label text-md-right">{{ __('Number') }}</label>
                            <div class="col-md-7">
                                <input id="number" type="number" class="form-control{{ $errors->has('number') ? ' is-invalid' : '' }}" 
                                name="number" value="{{ old('number') }}">
                                @if ($errors->has('number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('number') }}</strong>
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
                        <button type="submit" class="btn btn-sm btn-secondary pull-right">Add Vacancy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-----------------------------./Add Vacancy---------------------------------->

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
    
    <!-----------------------------Add Update---------------------------------->
    <div id="addUpdate" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content"> 
                <form enctype="multipart/form-data" method="POST" action="/storeupdate">
                    @csrf    
                    <div class="modal-header bg-info text-white p-2">
                        <i class="fa fa-crosshairs fa-1x" aria-hidden="true">&nbsp;Add Update</i>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>         
                    </div>
                    <div class="modal-body">   
                        <div class="form-group row">
                            <label for="caption" class="col-md-3 col-form-label text-md-right">{{ __('Caption') }}</label>
                            <div class="col-md-7">
                                <input id="caption" type="text" class="form-control{{ $errors->has('caption') ? ' is-invalid' : '' }}" 
                                name="caption" value="{{ old('caption') }}">
                                @if ($errors->has('caption'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('caption') }}</strong>
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
                        <button type="submit" class="btn btn-sm btn-secondary pull-right">Add Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-----------------------------./Add Update---------------------------------->
        
@endsection
<!-----------------------------./Section---------------------------------->