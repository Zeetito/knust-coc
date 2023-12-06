<x-guest_layout>
 
 <body class="app flex-row align-items-center">
    <div class="container">

        {{-- Form Begins --}}
        <form action="{{route('log_user_in')}}" method="Post">
            @csrf
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card-group mb-0">
                            <div class="card p-4">
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
                                        <h2>Dear Fresher <i class="fa fa-smile-o"></i></h2>
                                        {{-- <p> Connect with your loved once online like never before, Alumni and students alike. Have Fun!!! </p> --}}
                                        <p> Create An Account here </p>
                                    <a href={{route('create_fresher')}} type="button" class="btn btn-primary active mt-3">Register Now!</a>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
        </form>
         {{-- Form Ends --}}
    </div>
 
</x-guest_layout>