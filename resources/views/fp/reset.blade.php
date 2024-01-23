
<x-guest_layout>            
            {{-- Form Begins --}}
            <form action="{{route('fp_reset')}}" method="Post">
                @csrf
                <div class="row justify-content-center" >
                    <div class="col-12 modal-body">

                        
                        <div class="card" style="border-radius:25px;">
                            <a href={{route('login')}}  class="btn btn-primary float-right" style="border-radius:10px "> <strong>Back To Login</strong> </a>
                            
                            <div class="card-body p-4 row">
                                   <strong>Reset Your Password</strong>
   
                               {{-- Forgot Password --}}
                               <div class="form-control mb-3">
                                    <strong>Email</strong>
                                    <input type="email"  name="email" value="{{$user->email}}" class="form-control" required  readonly> <br>

                                    <strong>New Password</strong>
                                    <input type="password"  name="password" class="form-control" required > <br>
                                    @error('password')
                                    <p class="bg-danger">
                                        {{$message}}
                                    </p>
                                    @enderror

                                    <strong>Confirm New Password</strong>
                                    <input type="password"  name="password_confirmation" class="form-control" required >
                               </div>
                                 
       
                               <button class=" btn col-12 btn-primary">Send Reset Link</button>



                           </div>
                       </div>
                    </div>
                    {{-- <div class="col-12">
                        
                    </div> --}}


                   </div>
               </form>
</x-guest_layout>

