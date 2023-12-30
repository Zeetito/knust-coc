<x-guest_layout>
 
 <body class="app flex-row align-items-center">
     <div class="container">

        {{-- Form Begins --}}
             <form action="{{route('register_user')}}" method="Post">
                @csrf
                <div class="row justify-content-center" >
                    <div class="col-md-6">
                        <div class="card mx-4" style="border-radius:25px;">
                            <div class="card-body p-4">
                                <h1>Dear Fresher <i class="fa fa-smile-o"> </i></h1>

                                    <div class="accordion col-12" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                            <div class="accordion-button  btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Read Me...
                                            </div>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
        
                                                <div class="card">
        
                                                    <strong>INSTRUCTIONS FOR ALL</strong>
                                                    <p>
                                                        
                                                        <ul>
                                                            <li>
                                                                This Excercise Is For Brethren Joining Knust Church Of Christ <strong>(Kumasi Campus Only)</strong>
                                                            </li>
                                                            <li>
                                                                Use the Link below If you're a student in <strong>Obuasi Campus.</strong><br>
                                                                <a href="https://docs.google.com/forms/d/1M5LIG7goIf7UKc5f8JGyYHCEjRH2usso8d9firwWpkk/">Cick Here</a>
                                                            </li>
        
                                                        </ul>
        
                                                    </p>
                                                        
                                                </div>
        
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                <a href={{route('login_page_fresher')}}   class="float-right" style="border-radius:10px "> <strong>Already Have an Account ?</strong> </a>
                                <p class="text-muted">Create your account</p>

                            {{-- Username --}}
                            <strong>Tip: Use KNUST username (If you have) for convenience </strong>
                                <div class="input-group mb-3">
                                    <span class="input-group-addon"><i class="icon-user"></i>
                                    </span>
                                    <input type="text" value="{{old('username',"")}}" name="username" autocomplete="off" class="form-control" placeholder="Username">
                                </div>
                                @error('username')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror

                            {{-- Firstname --}}
                                <div class="input-group mb-3">
                                    <span class="input-group-addon"><i class="icon-user"></i>
                                    </span>
                                    <input type="text" value="{{old('firstname',"")}}" name="firstname" autocomplete="off" class="form-control" placeholder="firstname">
                                </div>
                                @error('firstname')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror


                            {{-- Lastname --}}
                                <div class="input-group mb-3">
                                    <span class="input-group-addon"><i class="icon-user"></i>
                                    </span>
                                    <input type="text" value="{{old('lastname',"")}}" name="lastname" autocomplete="off" class="form-control" placeholder="lastname">
                                </div>
                                @error('lastname')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror
                                
                            {{-- Othername --}}
                                <div class="input-group mb-3">
                                    <span class="input-group-addon"><i class="icon-user"></i>
                                    </span>
                                    <input type="text" value="{{old('othername')}}" name="othername" autocomplete="off" class="form-control" placeholder="othername">
                                </div>
                                    @error('othername')
                                    <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                    @enderror

                            {{-- contact --}}
                                <strong>Contact - Preferrably WhatsApp Contact </strong>
                                <div class="input-group mb-3">
                                    <span class="input-group-addon"><i class="icon-user"></i>
                                    </span>
                                    <input type="text" value="{{old('contact')}}" name="contact" autocomplete="off" class="form-control" placeholder="contact">
                                </div>
                                    @error('contact')
                                        <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                    @enderror
                                


                            {{-- Gender --}}
                                <strong>Gender</strong>
                                <div class="input-group mb-3">
                                    <span class="input-group-addon"><i class="icon-user"></i>
                                    </span>
                                    <select name="gender"  class="form-control" id="gender" required>
                                        <option value="">Select</option>
                                        <option value="m">Male</option>
                                        <option value="f">Female</option>
                                    </select>
                                </div>
                                    @error('gender')
                                    <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                    @enderror

                            {{-- is_baptized --}}
                            <strong>Are you Baptized ?</strong>
                                <div class="input-group mb-3">
                                    <span class="input-group-addon"><i class="icon-drop"></i>
                                    </span>
                                    <select name="is_baptized"  class="form-control" id="is_baptized" required>
                                        <option value="">Select</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                                    @error('is_baptized')
                                    <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                    @enderror

                            {{-- Date of Birth --}}
                                    <strong>NB:Your Year of birth will not be displayed publicly</strong>
                                <div class="input-group mb-3">

                                    <span class="input-group-addon"><i class="icon-time"></i>
                                    </span>
                                    <input type="date" value="{{old('dob')}}" name="dob" class="form-control" required>
                                </div>
                                @error('dob')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror

        
                            {{-- Email --}}
                                <div class="input-group mb-3">
                                    <span class="input-group-addon">@</span>
                                    <input type="text"  value="{{old('email',"")}}" class="form-control" name="email" autocomplete="off" placeholder="Email">
                                </div>
                                @error('email')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror

                            {{-- Student / Member Status, true ny default --}}
                                <input type="text" name="is_student" readonly hidden value="1">
                                <input type="text" name="is_member" readonly hidden value="1">
                                {{-- Fresher Status --}}
                                <input type="text" name="is_fresher" readonly hidden value="1">


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
                                        <a href="https://www.facebook.com/churchofchristknust?mibextid=ZbWKwL" target="_blank" class="btn btn-block btn-facebook" type="button">
                                            <span>facebook</span>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="https://knustcoc.org" target="_blank" class="btn btn-block bg-primary fa fa-globe" type="button">
                                            <span>Visit Us</span>
                                        </a>
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