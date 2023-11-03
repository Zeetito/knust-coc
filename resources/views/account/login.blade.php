
 <!DOCTYPE html>
 <html lang="en">
 
 <head>
 
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     {{-- <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
     <meta name="author" content="Lukasz Holeczek">
     <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template"> --}}
     <link rel="icon" href="{{asset('img/logo.png')}}" type = "image/x-icon"> 
 
     <title>Knust Church Of Christ Register</title>
 
     <!-- Icons -->
     <link href="{{ asset('css/style.css') }}" rel="stylesheet">
     <link href={{ asset("css/simple-line-icons.css") }} rel="stylesheet">
 
     <!-- Main styles for this application -->
     <link href={{ asset("css/style.css") }} rel="stylesheet">
 
 </head>
 

 
 <body class="app flex-row align-items-center">
     <div class="container">

        {{-- Form Begins --}}
     <form action="{{route('log_user_in')}}" method="Post">
            @csrf
            <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card-group mb-0">
                            <div class="card p-4">
                                    @if(session()->has('success'))
                                    <div class='container container--narrow'>
                                        <div class='alert alert-success text-center '>
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
                                <div class="card-body">
                                    <h1>Login</h1>
                                    <p class="text-muted">Sign In to your account</p>

                                    {{-- Username --}}
                                    <div class="input-group mb-3">
                                        <span class="input-group-addon"><i class="icon-user"></i>
                                        </span>
                                        <input type="text" class="form-control" name="username" placeholder="Username">
                                    </div>
                                        @error('username')
                                        <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                        @enderror

                                    {{-- Password --}}
                                    <div class="input-group mb-4">
                                        <span class="input-group-addon"><i class="icon-lock"></i>
                                        </span>
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
                                    @error('password')
                                    <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                    @enderror
                                    {{-- SubmitButton --}}
                                    <div class="row">
                                        <div class="col-6">
                                            <button type="submit" name="submit" class="btn btn-primary px-4">Login</button>
                                        </div>
                                        <div class="col-6 text-right">
                                            <button type="button" class="btn btn-link px-0">Forgot password?</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card text-white bg-primary py-5 " >
                                <div class="card-body text-center">
                                    <div>
                                        <h2>Sign up</h2>
                                        {{-- <p> Connect with your loved once online like never before, alumini and students alike. Have Fun!!! </p> --}}
                                        <p> Is this your first time here? Are You an Alumini / Member of the KNUST COC? </p>
                                    <a href={{route('register')}} type="button" class="btn btn-primary active mt-3">Register Now!</a>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </form>
         {{-- Form Ends --}}
     </div>
 
     <!-- Bootstrap and necessary plugins -->
     <script src={{asset("bower_components/jquery/dist/jquery.min.js")}}></script>
     <script src={{asset("bower_components/bootstrap/dist/js/bootstrap.min.js")}}></script>
     {{-- <script src={{asset("bower_components/tether/dist/js/tether.min.js")}}></script> --}}
 
 
 </body>
 
 </html>