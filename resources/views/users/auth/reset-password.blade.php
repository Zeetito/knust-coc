<x-guest_layout>
 
    {{-- <body class="app flex-row align-items-center"> --}}
        <div class="container">
            
            {{-- Form Begins --}}
            <form action="{{route('update_password')}}" method="Post">
                @csrf
                <div class="row justify-content-center" >
                    <div class="col-md-6">
                        <div class="card mx-4" style="border-radius:25px;">
                            <div class="card-body p-4 row">
                                   <strong>Reset Password</strong>

                                   <input type="hidden" name="token" value="{{ $token }}">

                               {{-- Forgot Password --}}
                               <div class="col-12 mb-3">
                                <strong>Email</strong>
                                    <input type="email"  name="email" class="form-control" required >
                               </div>

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
                                 
       
                               <button class="btn-primary">Reset Password</button>


                           </div>
                       </div>


                   </div>
               </form>


            {{-- Form Ends --}}
        </div>
    {{-- </body> --}}
    
</x-guest_layout>