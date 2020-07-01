<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Bootstrap -->
        <link href="{{ asset('bootstrap-4.1.3-dist/css/bootstrap.min.css') }}"  rel="stylesheet">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/css-main.css')}}" rel="stylesheet">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/js-main.js')}}" defer></script>
        <!-- Font Awesome-->
        <link rel="stylesheet" href="{{ asset('fontawesome-free-5.10.1-web/css/all.css') }}" >
        <!--Animate-->
        <link rel="stylesheet" href="{{ asset('animate.css-master/animate.css') }}"/>
        <!--FivoIcon-->
        <link href="images/logo.jpg" rel="icon" type="image/x-icon" />
    
    </head>

    <body>

    <!-----------------------------HOME---------------------------------->    
    <div id="home">

        <!-----------------------------------------Site Title--------------------------------------------------->
        <div class="site-title">
            <a class="navbar-brand" href="{{ url('/') }}">                
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>
        <div class="site-subtitle">
            <p>A milestone in food security and income generation</p>
        </div>
        <!-----------------------------------------./Site Title--------------------------------------------------->


        <!-----------------------------------------./Nav--------------------------------------------------->
        <div class="navbar navbar-expand-md navbar-light navbar-laravel home-nav">
            <div class="container">                    
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Links -->
                    <ul class="navbar-nav mr-auto">                      
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/aboutus">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/products">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/services">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/tenders">Tenders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/vacancies">Vacancies</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contact">Contact</a>
                        </li>
                    </ul>
                    
                    <ul class="navbar-nav ml-auto">
                        @guest 
                            <li class="nav-item">
                                <a class="nav-link" href="login">Login</a>
                            </li>                                
                            <li class="nav-item">
                                <a class="nav-link" href="register">Register</a>
                            </li> 
                        @else                        
                            <li class="nav-item">
                                <a class="nav-link" href="welcome">{{Auth::user()->name}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout">Logout</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
        <!-----------------------------------------./Nav--------------------------------------------------->


        <!-----------------------------------------Recent-stories Section--------------------------------------------------->
        <section class="recent-stories">
            <div class="container">    
                <div id="carousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ul class="carousel-indicators">
                        <li data-target="#carousel" data-slide-to="0" class="active"></li>
                        @for ($i = 1; $i <= count($updates); $i++)
                            <li data-target="#carousel" data-slide-to="{{$i}}"></li>
                        @endfor
                        {{-- <li data-target="#carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel" data-slide-to="1"></li>
                        <li data-target="#carousel" data-slide-to="2"></li> --}}
                    </ul>
                <!-- The slideshow -->

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="images/agriculture.jpg" alt="Agriculture" class="img-fluid">
                        <div class="carousel-caption">
                            <h3>Agriculture</h3>
                            <p>Food security is key for an health nation</p>
                        </div>
                    </div> 
                    @foreach ($updates as $update)
                        <div class="carousel-item">
                            <img src="uploads/images/{{$update->image}}" alt="{{$update->caption}}" class="img-fluid">
                            <div class="carousel-caption">
                                <h3>{{$update->caption}}</h3>
                                <p>{{$update->details}}</p>
                            </div>
                        </div> 
                    @endforeach                   
                    {{-- <div class="carousel-item">
                        <img src="images/flowers.jpg" alt="Welcome image" class="img-fluid">
                        <div class="carousel-caption">
                            <h3>Beauty!</h3>
                            <p>Beauty is everywhere take time to see it.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/beads.jpg" alt="Image 3" class="img-fluid">
                        <div class="carousel-caption">
                            <h3>Breakfast</h3>
                            <p>Lorem ipsum tempor incididunt ut labore et dolore magna aliqua</p>
                        </div>
                    </div> --}}

                    </div>
                        <!-- Left and right controls -->
                        <a class="carousel-control-prev" href="#carousel" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#carousel" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                </div>
            </div>
        </section>
        <!-----------------------------------------./Recent-stories Section--------------------------------------------------->


        <!-----------------------------------------Tenders,Events & Vacancy announcements--------------------------------------------------->
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="vacancies mt-2">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Job Vacancies</h4>
                                @if(count($vacancies)>0)
                                        @foreach($vacancies as $vacancy)
                                            <p>(Closing date: {{Carbon\Carbon::parse($vacancy->created_at)->format('d-m-Y h:ia')}})</p>
                                            
                                        <a href="vacancies">
                                            <ul>                                        
                                                <li class="card-text wow infinite fadeIn">{{$vacancy->position}}</li>
                                                {{-- <li class="card-text wow infinite fadeIn"><a href="#">Driver Position</a></li> --}}
                                            </ul>  
                                        </a>                                  
                                        @endforeach                                        
                                @else
                                    <h6 class="text-center text-black-50 p-3">No open vacancies at moment</h6>                
                                @endif 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="announcements mt-2">

                    @if(count($announcements)>0)
                        @foreach($announcements as $announcement)
                            <div class="card-header">
                                <h6>{{$announcement->title}}</h6>
                            </div>                            
                            <div class="card-body">
                                <h5 class="text-danger">{{$announcement->shouter}}</h5>
                                <p>{{$announcement->description}}</p>
                            </div>                                 
                        @endforeach                                        
                    @else
                        <h6 class="text-center text-black-50 p-3">No announcements at moment</h6>                
                    @endif
                    {{ $announcements->links() }}

                        {{-- <div class="card-header">
                            <h6>Information on Fall Army Worm (spodoptera frugiperda)</h6>
                        </div>
                        <div class="card-body">
                            <h5 class="text-danger">Attention!!!</h5>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
                            Aenean commodo ligula eget dolor. Aenean massa. Cum sociis 
                            natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                        </div> --}}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="tenders mt-2">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Tenders</h4>
                                @if(count($tenders)>0)
                                    <a href="tenders">
                                        <ul>
                                            @foreach($tenders as $tender)
                                                <li class="card-text">{{$tender->title}}</li>
                                            @endforeach
                                            {{-- <li class="card-text"><a href="#">Supply and delivery of seed dressing chemical<a href="#"></li>
                                            <li class="card-text"><a href="#">Supply of Manure<a href="#"></li> --}}
                                        </ul>
                                    </a>
                                @else
                                    <h6 class="text-center text-black-50 p-3">No Tenders at moment</h6>                
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <!-----------------------------------------./Tenders,Events & Vacancy announcements--------------------------------------------------->


        @include('common.floating-menu');
        
    </div>
    <!-----------------------------.HOME---------------------------------->
        
    <!-----------------------------FOOTER---------------------------------->
    @include('common.footer');
    <!-----------------------------./FOOTER---------------------------------->

    <!-- Boostrap JS -->
    <script src="{{ asset('bootstrap-4.1.3-dist/js/bootstrap.min.js') }}"></script>
    <!--Wow JS-->
    <script src="{{ asset('WOW-master/dist/wow.min.js') }}"></script>
    <script>
        new WOW().init();
    </script>

    </body>
</html>
