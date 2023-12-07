<x-layout>
 
    <body class="app flex-row align-items-center">
        <div class="container">
   
           {{-- Form Begins --}}
                <form action="{{route('update_user',['user'=>$user])}}" method="Post">
                    @method('put')
                   @csrf
                   <div class="row justify-content-center" >
                       <div class="col-md-6">
                           <div class="card mx-4" style="border-radius:25px;">
                               <div class="card-body p-4 row">
   
                               {{-- Username --}}
                                    {{-- <strong>Tip: Use KNUST username (If you have) for convenience </strong> --}}
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
                                       NB:Your Year of birth will not be displayed publicly
                                   <div class="col-12 mb-3">
                                    <strong>Date Of Birth</strong>

                                       <input type="date" value="{{old('dob',$user->dob)}}" name="dob" class="form-control" required>
                                   </div>
                                   @error('dob')
                                   <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                   @enderror
   
                                
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