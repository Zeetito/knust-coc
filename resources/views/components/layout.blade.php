
 <!DOCTYPE html>
 <html lang="en">
 
 <head>
 
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0, ">
 
     <link rel="icon" href="{{asset('img/logo.png')}}" type = "image/x-icon"> 
 
     <title>Church Of Christ, Knust</title>
 



     <!-- Icons -->
     <link href="{{ asset("css/font-awesome.css") }}" rel="stylesheet">
     <link href="{{ asset("css/simple-line-icons.css") }}" rel="stylesheet">
     {{-- <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet"> --}}
     <link href="{{ asset("css/style.css") }}" rel="stylesheet">
 
     <!-- Main styles for this application -->
     
     {{-- Custom Styles --}}
     <link href={{ asset("css/custom.css") }} rel="stylesheet">
     <link href={{ asset("css/custom.css") }} rel="stylesheet">


    <!-- Bootstrap and necessary plugins -->
    <script src={{asset("js/jquery-3.6.0.min.js")}}></script>
    <script src={{asset("bower_components/bootstrap/dist/js/bootstrap.min.js")}}></script>
    {{-- <script src={{asset("js/views/bootstrap.min.js")}}></script> --}}
    <script src={{asset("js/views/bootstrap.bundle.min.js")}}></script>

    {{-- Some specific for view features --}}
    <script src={{asset("bower_components/chart.js/dist/Chart.min.js")}}></script>
    <script src={{asset("js/views/charts.js")}}></script>
    <script src={{asset("js/views/main.js")}}></script>
    <script src={{asset("js/views/widgets.js")}}></script>
    <script src={{asset("js/jquery.dataTables.min.js")}}></script>
    <script src={{asset("js/jquery.dataTables.bootstrap5.min.js")}}></script>
 
 </head>

 <body class="app header-fixed  aside-menu-fixed aside-menu-hidden">
        <header class="app-header navbar">
            <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">☰</button>
                <a class="navbar-brand" href="{{route('home')}}"></a>
            <button class="navbar-toggler sidebar-minimizer d-md-down-none" type="button">☰</button>
    
            {{-- <ul class="nav navbar-nav  d-md-down-none">
                <li class="nav-item px-3">
                <a class="nav-link" href="{{route('home')}}">Dashboard</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link" href="{{route('view_users')}}">Users</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link" href="#">Settings</a>
                </li>
            </ul> --}}
            
            <ul class="nav navbar-nav ml-auto">
               
                <li class="nav-item d-md-down-none">
                    <a class="nav-link" href="#"><i class="icon-location-pin"></i></a>
                </li>

                {{-- User Updates and Setting Nav --}}
                <li class="nav-item ">
                        {{-- User Profile Icon --}}
                    <a class="nav-link"  href="{{route('view_profile', auth()->user())}}">
                        <img src="{{Auth::user()->get_avatar() }}" class="img-avatar" alt="Profile Picture">
                    </a>
                </li>
                
            </ul>
            {{-- <button class="navbar-toggler aside-menu-toggler" type="button">☰</button> --}}
    
        </header>
    
        <div class="app-body">
                {{-- LEFT SIDEBAR STARTS --}}
                <x-left_side_bar/>
                    {{-- LEFT SIDEBAR ENDS --}}
            
                    <!-- Main content -->
                    <main class="main">
                
                        <!-- BREADCRUMP -->
                        {{-- <x-breadcrump/> --}}

                        {{-- Session Variables for Success or Failure Messages --}}
                        
                        {{-- Success --}}
                        @if(session()->has('success'))
                        <div class='container container--narrow PopMessage'>
                            <div id="success_msg" class='alert alert-success text-center '>
                            {{session('success')}}
                            </div>
                        </div>

                        {{-- Failure --}}
                        @elseif(session()->has('failure'))
                        <div class='container container--narrow PopMessage'>
                            <div class='alert alert-danger text-center'>
                            {{session('failure')}}
                            </div>
                        </div> 

                        {{-- Warning --}}
                        @elseif(session()->has('warning'))
                        <div class='container container--narrow PopMessage'>
                            <div class='alert alert-warning text-center'>
                            {{session('warning')}}
                            </div>
                        </div> 

                        @endif

                        <!-- Modal -->
                        <div class="modal fade" data-backdrop="true"  id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content" class="container bg-white">
                                
                                </div>
                            </div>
                        </div>
                        
                        {{-- My Second Modal --}}
                        <div class="modal fade" data-backdrop="true"  id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content" class="container bg-white">
                                
                                </div>
                            </div>
                        </div>

                        {{-- Large Modal --}}
                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="myLargeModal">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                ...
                              </div>
                            </div>
                          </div>

                        {{$slot}}

                    </main>
        
            {{-- <x-right_side_bar/> --}}


        </div>

        <footer class="app-footer">
            <div>
                <span class="float" >Knust CoC  © {{Date('Y')}} </span>
            </div>
        </footer>
        
 

     {{-- <script src={{asset("bower_components/tether/dist/js/tether.min.js")}}></script> --}}
     
     {{-- Plugins and scripts required by all views --}}
     {{-- <script src={{asset("bower_components/bootstrap/dist/js/Chart.min.js")}}></script> --}}
     
     {{-- GenesisUI main scripts --}}
     <script src={{asset("js/app.js")}}></script>
     <script src={{asset("js/qr/qrcode.js")}}></script>
     
     {{-- Custom scripts --}}
     {{-- <script src={{asset("js/views/main.js")}}></script> --}}

     <script src={{asset("js/custom.js")}}></script>

 </body>
 
 </html>