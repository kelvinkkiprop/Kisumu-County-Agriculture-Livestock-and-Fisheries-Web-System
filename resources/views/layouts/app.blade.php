<!DOCTYPE html>
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

    
    <!--Preloader-->
    <div id="preloader">
        <div id="status">
        </div>
    </div><!--/.Preloader-->

    <!-----------------------------APP---------------------------------->
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel super-nav">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img class="logo img-thumbnail" src="/images/logo.jpg"> 
                        {{-- {{ config('app.name', 'Laravel') }} --}}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
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
    
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest 
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
                                
                                    
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="welcome">
                                            <i class="fas fa-globe fa-1x">&nbsp;Explore</i></a>
                                        @if(Auth::user()->type == 'Farmer' && Auth::user()->status ==1)
                                    <a class="dropdown-item"  href="welcome">
                                            <i class="fab fa-product-hunt fa-1x">&nbsp;Products</i></a>
        
                                        <a class="dropdown-item"  href="requestservice">
                                                <i class="fab fa-servicestack fa-1x">&nbsp;Request service</i></a>
        
                                        <a class="dropdown-item"  href="/receipts">
                                            <i class="fas fa-receipt fa-1x">&nbsp;Receipts</i></a>
        
                                        <a class="dropdown-item"  href="profile">
                                            <i class="fas fa-user fa-1x">&nbsp;Profile</i></a>
                                    @endif
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt fa-1x">&nbsp;
                                            {{ __('Logout') }}</i>
                                        </a>
    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
        </nav>

        <main class="py-4">
            <!-- include info messages -->
            <div class="row justify-content-center">
                <div class="col-md-8"> 
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
                @include('common.messages')
                </div>
            </div><!-- ./include info messages -->
            @yield('content')
        </main>
    </div>
    <!-----------------------------./APP---------------------------------->
        
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
