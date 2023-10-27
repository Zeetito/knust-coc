
 <!DOCTYPE html>
 <html lang="en">
 
 <head>
 
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
     <link rel="icon" href="{{asset('img/logo.png')}}" type = "image/x-icon"> 
 
     <title>Knust Church Of Christ</title>
 
     <!-- Icons -->
     <link href="{{ asset("css/style.css") }}" rel="stylesheet">
     {{-- <link href="{{ asset("css/bootstrap.css") }}" rel="stylesheet"> --}}
     <link href="{{ asset("css/simple-line-icons.css") }}" rel="stylesheet">
     <link href="{{ asset("css/font-awesome.css") }}" rel="stylesheet">
 
     <!-- Main styles for this application -->
     
     {{-- Custom Styles --}}
     <link href={{ asset("css/custom.css") }} rel="stylesheet">

    <!-- Bootstrap and necessary plugins -->
    <script src={{asset("js/jquery-3.6.0.min.js")}}></script>
    <script src={{asset("js/popper.min.js")}}></script>
    <script src={{asset("bower_components/bootstrap/dist/js/bootstrap.min.js")}}></script>
    

    {{-- Some specific for view features --}}
    {{-- <script src={{asset("bower_components/chart.js/dist/Chart.min.js")}}></script> --}}
    {{-- <script src={{asset("js/views/charts.js")}}></script> --}}
    <script src={{asset("js/views/main.js")}}></script>
    {{-- <script src={{asset("js/views/widgets.js")}}></script> --}}
 
 </head>

 <body class="app header-fixed  aside-menu-fixed aside-menu-hidden">
        <header class="app-header navbar">
            <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">☰</button>
                <a class="navbar-brand" href="{{route('home')}}"></a>
            <button class="navbar-toggler sidebar-minimizer d-md-down-none" type="button">☰</button>
    
            <ul class="nav navbar-nav d-md-down-none">
                <li class="nav-item px-3">
                <a class="nav-link" href="{{route('home')}}">Dashboard</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link" href="{{route('view_users')}}">Users</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link" href="#">Settings</a>
                </li>
            </ul>
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item d-md-down-none">
                    <a class="nav-link" href="#"><i class="icon-bell"></i><span class="badge badge-pill badge-danger">5</span></a>
                </li>
                <li class="nav-item d-md-down-none">
                    <a class="nav-link" href="#"><i class="icon-list"></i></a>
                </li>
                <li class="nav-item d-md-down-none">
                    <a class="nav-link" href="#"><i class="icon-location-pin"></i></a>
                </li>

                <li class="nav-item dropdown">
                        {{-- User Profile Icon --}}
                    <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="{{route('view_profile', auth()->id())}}" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="{{Auth::user()->get_avatar() }}" class="img-avatar" alt="Profile Picture">
                        <span class="d-md-down-none">User Role</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header text-center">
                            <strong>Account</strong>
                        </div>
                        <a class="dropdown-item" href="#"><i class="fa fa-bell-o"></i> Updates<span class="badge badge-info">42</span></a>
                        <a class="dropdown-item" href="#"><i class="fa fa-envelope-o"></i> Messages<span class="badge badge-success">42</span></a>
                        <a class="dropdown-item" href="#"><i class="fa fa-tasks"></i> Tasks<span class="badge badge-danger">42</span></a>
                        <a class="dropdown-item" href="#"><i class="fa fa-comments"></i> Comments<span class="badge badge-warning">42</span></a>
                        <div class="dropdown-header text-center">
                            <strong>Settings</strong>
                        </div>
                    <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-wrench"></i> Settings</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-usd"></i> Payments<span class="badge badge-default">42</span></a>
                        <a class="dropdown-item" href="#"><i class="fa fa-file"></i> Projects<span class="badge badge-primary">42</span></a>
                        <div class="divider"></div>
                        <a class="dropdown-item" href="#"><i class="fa fa-shield"></i> Lock Account</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-lock"></i> Logout</a>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler aside-menu-toggler" type="button">☰</button>
    
        </header>
    
        <div class="app-body">
                {{-- LEFT SIDEBAR STARTS --}}
                <x-left_side_bar/>
                    {{-- LEFT SIDEBAR ENDS --}}
            
                    <!-- Main content -->
                    <main class="main">
            
                        <!-- BREADCRUMP -->
                      <x-breadcrump/>

                      {{-- Session Variables for Success or Failure Messages --}}
                      @if(session()->has('success'))
                      <div class='container container--narrow'>
                          <div id="success_msg" class='alert alert-success text-center '>
                          {{session('success')}}
                        </div>
                      </div> 
                      @endif
                      @if(session()->has('failure'))
                      <div class='container container--narrow'>
                        <div class='alert alert-danger text-center'>
                          {{session('failure')}}
                        </div>
                      </div> 
                      @endif

                    <!-- Modal -->
                    <div class="modal fade" data-backdrop="true"  id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div id="modal-content" class="container bg-white">
                            
                            </div>
                        </div>
                    </div>

        {{$slot}}

                    </main>
        
    <x-right_side_bar/>


        </div>

        <footer class="app-footer">
                <a href="">Knust CoC </a> © {{Date('Y')}}
        </footer>
        
        
 

     {{-- <script src={{asset("bower_components/tether/dist/js/tether.min.js")}}></script> --}}
     
     {{-- Plugins and scripts required by all views --}}
     {{-- <script src={{asset("bower_components/bootstrap/dist/js/Chart.min.js")}}></script> --}}
     
     {{-- GenesisUI main scripts --}}
     <script src={{asset("js/app.js")}}></script>
     
     {{-- Custom scripts --}}
     {{-- <script src={{asset("js/views/main.js")}}></script> --}}

     <script src={{asset("js/custom.js")}}></script>

 </body>
 
 </html>