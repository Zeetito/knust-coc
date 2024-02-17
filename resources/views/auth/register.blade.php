<x-guest_layout>
 
    <body class="app flex-row align-items-center">
        <div class="">
   
           {{-- Form Begins --}}
                <form action="{{route('register_user')}}" method="Post">
                   @csrf
                   <div class="row justify-content-center" >
                       <div class="col-md-6">
                           <div class="card mx-4" style="border-radius:25px;">
                               <div class="card-body p-4  row">
                                   <div class="col-12">
                                       <h1>Register</h1>
                                       <a href={{route('login')}}   class=" float-right" style="border-radius:10px "> <strong>Already Have an Account ?</strong> </a>
                                       <p class="text-muted">Create your account</p>
                                   </div>
   
                                   {{-- Username --}}
                                   <div class="col-12 mb-3">
                                       <strong>Tip: Use KNUST username (If you have) for convenience </strong><br><br>
   
                                       <strong>Username</strong>
                                       <input type="text" value="{{old('username',"")}}" name="username" autocomplete="off" class="form-control" placeholder="NB:Avoid Spaces in the username">
                                   </div>
                                   @error('username')
                                   <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                   @enderror
   
                                   {{-- Firstname --}}
                                   <div class="col-12 mb-3">
                                       <strong>Firstname</strong>
                                       <input type="text" value="{{old('firstname',"")}}" name="firstname" autocomplete="off" class="form-control" placeholder="firstname">
                                   </div>
                                   @error('firstname')
                                   <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                   @enderror
   
   
                                   {{-- Lastname --}}
                                   <div class="col-12 mb-3">
                                       <strong>Lastname</strong>
                                       <input type="text" value="{{old('lastname',"")}}" name="lastname" autocomplete="off" class="form-control" placeholder="lastname">
                                   </div>
                                   @error('lastname')
                                   <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                   @enderror
                                   
                                   {{-- Othername --}}
                                   <div class="col-12 mb-3">
                                       <strong>Othername</strong>
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
                                   <strong>NB:Your Year of birth will not be displayed publicly</strong>
                                   <div class="col-12 mb-3">
                                       
                                       {{-- <input type="date" value="{{old('dob')}}" name="dob" class="form-control" required> --}}
                                       
                                       {{-- Day --}}
                                       <select name="dob_day" class="col-3 " id="" value="{{old('dob_day')}}" required>
                                            <option value="">Select Day</option>
                                        
                                            @php
                                                for ($i = 1; $i <= 31; $i++) {
                                                    $suffix = 'th';
                                        
                                                    if (in_array($i % 100, [11, 12, 13])) {
                                                        // If the day is 11th, 12th, or 13th, use 'th'
                                                        $suffix = 'th';
                                                    } else {
                                                        // For other days, determine the suffix based on the last digit
                                                        $lastDigit = $i % 10;
                                        
                                                        switch ($lastDigit) {
                                                            case 1:
                                                                $suffix = 'st';
                                                                break;
                                                            case 2:
                                                                $suffix = 'nd';
                                                                break;
                                                            case 3:
                                                                $suffix = 'rd';
                                                                break;
                                                            default:
                                                                $suffix = 'th';
                                                                break;
                                                        }
                                                    }
                                        
                                                    echo "<option value='" . $i . "'>" . $i . $suffix . "</option>";
                                                }
                                            @endphp                                            
                                    
                                        </select>

                                       {{-- Month --}}
                                       <select name="dob_month" class="col-3 " value="{{old('dob_month')}}" id="" required>
                                            <option value="">Select Month</option>
                                        
                                            @php
                                                for ($i = 1; $i <= 12; $i++) {
                                                
                                                    echo "<option value='" . $i . "'>" . date("F", mktime(0, 0, 0, $i, 10)) . "</option>";
                                                }
                                            @endphp                                            
                                    
                                        </select>

                                       {{-- Year --}}
                                       <select name="dob_year" class="col-3 " value="{{old('dob_year')}}" id="" required>
                                            <option value="">Select Year</option>
                                        
                                            @php
                                                for ($i = date('Y'); $i >=1970 ; $i--) {
                                                
                                                    echo "<option value='" . $i . "'>" . $i . "</option>";
                                                }
                                            @endphp                                            
                                    
                                        </select>
                                        

                                   </div>
                                   @error('dob_day')
                                   <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                   @enderror
                                   @error('dob_month')
                                   <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                   @enderror
                                   @error('dob_year')
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
                                   <div class="col-12 mb-3">
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
                                   <div class="col-12 mb-3">
                                       <strong>Are You Currently  A member of the  KNUST Church Of Christ ?</strong>
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