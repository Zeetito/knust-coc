<x-layout>
 
    <body class="">
        <div class="">

   
           {{-- Form Begins --}}
                <form action="{{route('update_user',['user'=>$user])}}" method="Post">
                    @method('put')
                   @csrf
                   <div class="row justify-content-center" >
                       <div class="col-md-12">
                           <div class="card mx-4" style="border-radius:25px;">
                               <div class="card-body p-4 row">
   
                               {{-- Username --}}
                                    {{-- <strong>Tip: Use KNUST username (If you have) for convenience </strong> --}}
                                    <div class="menu-container">
                                        <span class="menu-button">
                                            <span class="btn-info"><strong class="fa fa-list">More</strong></span>
                                        </span>
                                        <div class="menu-content">
                                          {{-- <a href="{{route('view_profile',['user'=>$user])}}">Profile</a> --}}
                                          @if(auth()->user()->is($user))
                                            <a class="bg-secondary btn mt-1" data-toggle='modal' data-target="#myModal" data-url={{route('account_confirm_password',['user'=>$user])}}>Change Password</a>
                                            {{-- <a class="bg-secondary btn mt-1" data-toggle='modal' data-target="#myModal"
                                            data-url="{{ route('confirm_password_form', ['user' => $user, 'url' => route('change_password', ['user' => $user])]) }}">
                                            Change Password
                                            </a> --}}
                                            {{-- <a class="bg-secondary btn mt-1"  href="{{route('edit_user',['user'=>$user])}}">I'm Not Available</a> --}}
                                            {{-- <a class="bg-secondary btn mt-1" data-toggle='modal' data-target="#myModal" data-url="{{route('mark_user_inactive_confirm',['user'=>$user])}}" href="#">Delete Account</a> --}}
                                          @endif
                                          {{-- <a href="#">Option 3</a> --}}
                                        </div>
                                    </div>

                                   <div class="col-12 mb-3">
                                        <strong>Username</strong>

                                       <input type="text" value="{{old('username',$user->username)}}" name="username" autocomplete="off" class="form-control" placeholder="Username">
                                   </div>
                                   @error('username')
                                   <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                   @enderror
   
                               {{-- Firstname --}}
                                   <div class="col-12 mb-3">
                                    <strong>FirstName</strong>
                                       <input type="text" value="{{old('firstname',$user->firstname)}}" name="firstname" autocomplete="off" class="form-control" placeholder="firstname">
                                   </div>
                                   @error('firstname')
                                   <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                   @enderror
   
   
                               {{-- Lastname --}}
                                   <div class="col-12 mb-3">
                                    <strong>LastName</strong>
                                       <input type="text" value="{{old('lastname',$user->lastname)}}" name="lastname" autocomplete="off" class="form-control" placeholder="lastname">
                                   </div>
                                   @error('lastname')
                                   <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                   @enderror
                               {{-- Othername --}}
                                   <div class="col-12 mb-3">
                                    <strong>Other Name</strong>
                                       <input type="text" value="{{old('othername',$user->othername)}}" name="othername" autocomplete="off" class="form-control" placeholder="othername">
                                   </div>
                                       @error('othername')
                                       <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                       @enderror
   
                            
                               {{-- Gender --}}
                                   <div class="col-12 mb-3">
                                    <strong>Gender</strong>

                                       <select name="gender"  class="form-control" id="gender" required>
                                            @if($user->gender == 'm')
                                                <option value="m">Male</option>   
                                            @else
                                                <option value="f">Female</option>
                                            @endif
                                           <option value="">Select</option>
                                           <option value="m">Male</option>
                                           <option value="f">Female</option>
                                       </select>
                                   </div>
                                       @error('gender')
                                       <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                       @enderror
   
                               {{-- is_baptized --}}
                                   <div class="col-12 mb-3">
                                    <strong>Are you baptized?</strong>

                                       <select name="is_baptized"  class="form-control" id="is_baptized" required>
                                            @if($user->is_baptized == '1')
                                                <option value="1">Yes</option>  
                                            @else
                                                <option value="0">No</option>
                                            @endif
                                           <option value="">Select</option>
                                           <option value="1">Yes</option>
                                           <option value="0">No</option>
                                       </select>
                                   </div>
   
                                       @error('is_baptized')
                                       <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                       @enderror
   
                               {{-- Date of Birth --}}
                               @if(auth()->user()->is($user))

                                   <div class="col-12 mb-3">
                                       <strong>Date Of Birth
                                           
                                           <p>Only You Can See this</p>
                                           {{-- REad Only To show the current Birthday --}}
                                           <input type="date" value="{{old('dob',$user->dob)}}" name="dob" class="form-control" readonly >

                                           <strong>Change Date Of Birth?</strong>
                                           <div class="col-12 mb-3">
                                       
                                            {{-- <input type="date" value="{{old('dob')}}" name="dob" class="form-control" required> --}}
                                            
                                            {{-- Day --}}
                                            <select name="dob_day" class="col-3 " id="" value="{{old('dob_day')}}">
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
                                            <select name="dob_month" class="col-3 " value="{{old('dob_month')}}" id="">
                                                 <option value="">Select Month</option>
                                             
                                                 @php
                                                     for ($i = 1; $i <= 12; $i++) {
                                                     
                                                         echo "<option value='" . $i . "'>" . date("F", mktime(0, 0, 0, $i, 10)) . "</option>";
                                                     }
                                                 @endphp                                            
                                         
                                             </select>
     
                                            {{-- Year --}}
                                            <select name="dob_year" class="col-3 " value="{{old('dob_year')}}" id="">
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

                                    </strong>

                                   </div>

                                @endif
   
                                
                               {{-- Email --}}
                                   <div class="col-12 mb-3">
                                    <strong>Email</strong>
                                       <input type="text"  value="{{old('email',$user->email)}}" class="form-control" name="email" autocomplete="off" placeholder="Email">
                                   </div>
                                   @error('email')
                                   <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                   @enderror
   
                            
                               {{-- Password --}}
                                   {{-- <div class="col-12 mb-3">

                                       <input type="password"  name="password" class="form-control" placeholder="Password">
                                   </div>
                                   @error('password')
                                   <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                   @enderror --}}
           
                               {{-- ConfirmPassword --}}
                                   {{-- <div class="col-12 mb-4">

                                       <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat password">
                                   </div>
                                   @error('password_confirmation')
                                   <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                   @enderror --}}
   
                               {{-- Register Button --}}
                                   <button type="submit" name="submit" class="btn btn-block btn-success">Update Account</button>
                               </div>
   
   
                               {{-- <div class="card-footer p-4">
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
                               </div> --}}
                           </div>
                       </div>
                   </div>
               </form>
            {{-- Form Ends --}}
        </div>
    
       </x-layout>