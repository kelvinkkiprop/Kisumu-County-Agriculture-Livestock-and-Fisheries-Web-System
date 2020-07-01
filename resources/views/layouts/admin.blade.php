<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap -->
    <link href="{{ asset('bootstrap-4.1.3-dist/css/bootstrap.min.css') }}"  rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}"rel="stylesheet">
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
    <!--AutoTable - Table plugin for jsPDF-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

</head>

<body>    

        <!--Preloader-->
        <div id="preloader">
            <div id="status">
            </div>
        </div><!--/.Preloader-->

    <section id="admin">
        <div class="breadcrum">
            <!-----------------------------Nav---------------------------------->
            <nav class="navbar navbar-expand-md navbar-light">
                <div class="container">
                    <li class="navbar-brand text-white">
                        <img class="logo img-thumbnail" src="/images/logo.jpg"> 
                        {{ config('app.name', 'Laravel') }}                        
                    </li>
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" 
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>                                    
                                <span class="text-white-50">Welcome&nbsp;</span><label class="username">
                                {{Auth::user()->name}}</label><span class="caret"></span>
                            </a>                                        
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="home">
                                    <i class="fas fa-home fa-1x">&nbsp;Home</i></a>
                            @if(Auth::user()->type == 'Admin' && Auth::user()->status == 1) 
                                <a class="dropdown-item" data-toggle="modal" data-target="#addUser">
                                    <i class="fas fa-user-plus fa-1x">&nbsp;Add User</i></a> 
                                <a class="dropdown-item" data-toggle="modal" data-target="#report">
                                    <i class="fas fa-list-alt fa-1x">&nbsp;Report</i></a> 
                            @elseif(Auth::user()->type == 'Procurement' && Auth::user()->status == 1) 
                                <a class="dropdown-item" data-toggle="modal" data-target="#addTender">
                                    <i class="fas fa-truck fa-1x">&nbsp;Add Tender</i></a> 
                            @elseif(Auth::user()->type == 'HR' && Auth::user()->status == 1)
                                <a class="dropdown-item" data-toggle="modal" data-target="#addAnnouncement">
                                    <i class="fas fa-globe fa-1x">&nbsp;Add Announcement</i></a> 
                                <a class="dropdown-item" data-toggle="modal" data-target="#addVacancy">
                                    <i class="fas fa-list-alt fa-1x">&nbsp;Add Vacancy</i></a> 
                                <a class="dropdown-item" data-toggle="modal" data-target="#addUpdate">
                                    <i class="fas fa-crosshairs fa-1x">&nbsp;Add Update</i></a> 
                            @elseif(Auth::user()->type == 'Supplier' && Auth::user()->status == 1)                                   
                                <a class="dropdown-item" data-toggle="modal" data-target="#addSupply">
                                    <i class="fas fa-warehouse fa-1x">&nbsp;Add Supply</i></a>
                            @elseif(Auth::user()->type == 'Finance' && Auth::user()->status == 1)  
                                <a class="dropdown-item" data-toggle="modal" data-target="#report">
                                    <i class="fas fa-list-alt fa-1x">&nbsp;Report</i></a> 
                            @endisset          
                                <a class="dropdown-item" href="logout">
                                    <i class="fas fa-sign-out-alt fa-1x">&nbsp;Logout</i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-----------------------------./Nav---------------------------------->
        </div>

        @yield('content')

    </section>
    
 <!-- Boostrap JS -->
 <script src="{{ asset('bootstrap-4.1.3-dist/js/bootstrap.min.js') }}"></script>
 
</body>
</html>