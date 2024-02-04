<x-guest_layout>
 
    {{-- <body class="app flex-row align-items-center"> --}}
        <div class="container">
            
            {{-- Form Begins --}}
            <form action="{{route('email_check',['attendance'=>$attendance])}}" method="Post">
                @csrf
                <div class="row justify-content-center" >
                    <div class="col-md-6">
                        <div class="card mx-4" style="border-radius:25px;">
                            <div class="card-body p-4 row">
                                   <strong>Input Your email to mark as present</strong> <br>

                                   {{-- <input type="hidden" name="token" value="{{ $token }}"> --}}

                               {{-- Forgot Password --}}
                               <div class="col-12 mb-3">
                                <strong>Email</strong>
                                    <input type="email"  name="email" class="form-control" required >
                               </div>

                               {{-- Password --}}
                           
                                 
       
                               <button class="btn-primary float-right">Mark Present</button>

                               <br>
                               
                               
                               
                            </div>
                            
                                                           <span class="btn">
                                                               <a href="{{route('register')}}">Register New Account ?</a>
                                                           </span>
                        </div>
                        
                        
                    </div>
                </form>


            {{-- Form Ends --}}
        </div>
    {{-- </body> --}}
    
</x-guest_layout>