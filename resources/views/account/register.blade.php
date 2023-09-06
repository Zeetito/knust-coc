
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
             <form action="{{route('register_user')}}" method="Post">
                @csrf
                <div class="row justify-content-center" >
                    <div class="col-md-6">
                        <div class="card mx-4" style="border-radius:25px;">
                            <div class="card-body p-4">
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
                                <h1>Register</h1>
                                <a href={{route('login')}}   class="btn btn-primary" style="float:right; border-radius:10px "> <strong>LogIN</strong> </a>
                                <p class="text-muted">Create your account</p>

                                {{-- Username --}}
                                <div class="input-group mb-3">
                                    <span class="input-group-addon"><i class="icon-user"></i>
                                    </span>
                                    <input type="text" value="{{old('username',"")}}" name="username" class="form-control" placeholder="Username">
                                </div>
                                @error('username')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror

                                {{-- Firstname --}}
                                <div class="input-group mb-3">
                                    <span class="input-group-addon"><i class="icon-user"></i>
                                    </span>
                                    <input type="text" value="{{old('firstname',"")}}" name="firstname" class="form-control" placeholder="firstname">
                                </div>
                                @error('firstname')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror


                                {{-- Lastname --}}
                                <div class="input-group mb-3">
                                    <span class="input-group-addon"><i class="icon-user"></i>
                                    </span>
                                    <input type="text" value="{{old('lastname',"")}}" name="lastname" class="form-control" placeholder="lastname">
                                </div>
                                @error('lastname')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror

        
                                {{-- Email --}}
                                <div class="input-group mb-3">
                                    <span class="input-group-addon">@</span>
                                    <input type="text"  value="{{old('email',"")}}" class="form-control" name="email" placeholder="Email">
                                </div>
                                @error('email')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror
        
                                {{-- Password --}}
                                <div class="input-group mb-3">
                                    <span class="input-group-addon"><i class="icon-lock"></i>
                                    </span>
                                    <input type="password"  name="password" class="form-control" placeholder="Password">
                                </div>
                                @error('password')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror
        
                                {{-- ConfirmPassword --}}
                                <div class="input-group mb-4">
                                    <span class="input-group-addon"><i class="icon-lock"></i>
                                    </span>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat password">
                                </div>
                                @error('password_confirmation')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror

                                {{-- Register Button --}}
                                <button type="submit" name="submit" class="btn btn-block btn-success">Create Account</button>
                            </div>


                            <div class="card-footer p-4">
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-block btn-facebook" type="button">
                                            <span>facebook</span>
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-block btn-google" type="button">
                                            <span>Visit Us</span>
                                        </button>
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