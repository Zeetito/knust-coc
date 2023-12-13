
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, ">

    <link rel="icon" href="{{asset('img/logo.png')}}" type = "image/x-icon"> 

    <title>Knust Church Of Christ</title>




    <!-- Icons -->
    <link href="{{ asset("css/font-awesome.css") }}" rel="stylesheet">
    <link href="{{ asset("css/simple-line-icons.css") }}" rel="stylesheet">
    {{-- <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet"> --}}
    <link href="{{ asset("css/style.css") }}" rel="stylesheet">

    <!-- Main styles for this application -->
    
    {{-- Custom Styles --}}
    <link href={{ asset("css/custom.css") }} rel="stylesheet">


   <!-- Bootstrap and necessary plugins -->
   <script src={{asset("js/jquery-3.6.0.min.js")}}></script>
   <script src={{asset("bower_components/bootstrap/dist/js/bootstrap.min.js")}}></script>
   {{-- <script src={{asset("js/views/bootstrap.min.js")}}></script> --}}
   <script src={{asset("js/views/bootstrap.bundle.min.js")}}></script>

   {{-- Some specific for view features --}}
   {{-- <script src={{asset("bower_components/chart.js/dist/Chart.min.js")}}></script> --}}
   {{-- <script src={{asset("js/views/charts.js")}}></script> --}}
   <script src={{asset("js/views/main.js")}}></script>
   <script src={{asset("js/views/widgets.js")}}></script>

</head>
<body class="app header-fixed  aside-menu-fixed aside-menu-hidden">

   
       <div class="app-body">
               {{-- LEFT SIDEBAR STARTS --}}
                   {{-- LEFT SIDEBAR ENDS --}}
           
                   <!-- Main content -->
                   <main class="main">
           
                       <!-- BREADCRUMP -->
                     <x-breadcrump/>

                     {{-- Session Variables for Success or Failure Messages --}}
                     
                     {{-- Success --}}
                     @if(session()->has('success'))
                     <div class='container PopMessage  container--narrow'>
                         <div id="success_msg" class='alert alert-success text-center '>
                         {{session('success')}}
                       </div>
                     </div>

                     {{-- Failure --}}
                     @elseif(session()->has('failure'))
                     <div class='container PopMessage container--narrow'>
                       <div class='alert alert-danger text-center'>
                         {{session('failure')}}
                       </div>
                     </div> 

                     {{-- Warning --}}
                     @elseif(session()->has('warning'))
                     <div class='container PopMessage container--narrow'>
                       <div class='alert alert-warning text-center'>
                         {{session('warning')}}
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
     <script src={{asset("js/qr/qrcode.js")}}></script>
     
     {{-- Custom scripts --}}
     {{-- <script src={{asset("js/views/main.js")}}></script> --}}

     <script src={{asset("js/custom.js")}}></script>

</body>

</html>