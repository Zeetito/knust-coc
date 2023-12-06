<x-guest_layout>
 
 <body class="app flex-row align-items-center">
     <div class="container">

        {{-- Form Begins --}}
             <form action="{{route('register_user')}}" method="Post">
                @csrf
                <div class="row justify-content-center" >
                    <div class="col-md-6">
                        <div class="card mx-4" style="border-radius:25px;">
                            <div class="card-body p-4  row">
                                <div class="col-12">
                                    <h1>Register</h1>
                                    <a href={{route('login')}}   class="btn btn-primary float-right" style="border-radius:10px "> <strong>Already Have an Account ?</strong> </a>
                                    <p class="text-muted">Create your account</p>
                                </div>

                                {{-- Username --}}
                                <div class="col-12 mb-3">
                                    <strong>Tip: Use KNUST username (If you have) for convenience </strong>
                                    
                                    <input type="text" value="{{old('username',"")}}" name="username" autocomplete="off" class="form-control" placeholder="Username">
                                </div>
                                @error('username')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror

                                {{-- Firstname --}}
                                <div class="col-4 mb-3">
                                    
                                    <input type="text" value="{{old('firstname',"")}}" name="firstname" autocomplete="off" class="form-control" placeholder="firstname">
                                </div>
                                @error('firstname')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror


                                {{-- Lastname --}}
                                <div class="col-4 mb-3">
                                    
                                    <input type="text" value="{{old('lastname',"")}}" name="lastname" autocomplete="off" class="form-control" placeholder="lastname">
                                </div>
                                @error('lastname')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror
                                
                                {{-- Othername --}}
                                <div class="col-4 mb-3">
                                    
                                    <input type="text" value="{{old('othername')}}" name="othername" autocomplete="off" class="form-control" placeholder="othername">
                                </div>
                                    @error('othername')
                                    <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                    @enderror

                                {{-- contact --}}
                                <div class="col-12 mb-3">
                                    <strong>Contact - Preferrably WhatsApp Contact </strong>
                                    
                                    <input type="text" value="{{old('contact')}}" name="contact" autocomplete="off" class="form-control" placeholder="contact">
                                </div>
                                    @error('contact')
                                        <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                    @enderror
                                


                                {{-- Gender --}}
                                <div class="col-6 mb-3">

                                    <strong>Gender</strong>
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
                                <div class="col-6 mb-3">
                                    <strong>Are you Baptized ?</strong>
                                    
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
                                <div class="col-12 mb-3">
                                    <strong>NB:Your Year of birth will not be displayed publicly</strong>
                                    
                                    <input type="date" value="{{old('dob')}}" name="dob" class="form-control" required>
                                </div>
                                @error('dob')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror

        
                                {{-- Email --}}
                                <div class="col-12 mb-3">
                                    <input type="text"  value="{{old('email',"")}}" class="form-control" name="email" autocomplete="off" placeholder="Email">
                                </div>
                                @error('email')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror

                                {{-- Is_Student --}}
                                <div class="col-6 mb-3">
                                    <strong>Are You Currently A student in KNUST ?</strong>
                                <select name="is_student"  class="form-control" id="is_student" required> 
                                    <option value="">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                </div>
                                @error('is_student')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror

                                {{-- Is_Member --}}
                                <div class="col-6 mb-3">
                                    <strong>Are You Currently  Worshipping with the  KNUST Church Of Christ ?</strong>
                                <select name="is_member"  class="form-control" id="is_member" required>
                                    <option value="">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                </div>
                                @error('is_member')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror

                           
        
                                {{-- Password --}}
                                <div class="col-12 mb-3">
                                    
                                    <input type="password"  name="password" class="form-control" placeholder="Password">
                                </div>
                                @error('password')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror
        
                                {{-- ConfirmPassword --}}
                                <div class="col-12 mb-4">
                                    
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
                                        <a href="#" class="btn btn-block btn-google" type="button">
                                            <span>Visit Our Website</span>
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