<x-guest_layout>
 
    {{-- <body class="app flex-row align-items-center"> --}}
        <div class="container">
            
            {{-- Form Begins --}}
            <form action="{{route('send_reset_link')}}" method="Post">
                @csrf
                <div class="row justify-content-center" >
                    <div class="col-12">

                        
                        <div class="card" style="border-radius:25px;">
                            <a href={{route('login')}}  class="btn btn-primary float-right" style="border-radius:10px "> <strong>Back To Login</strong> </a>
                            
                            <div class="card-body p-4 row">
                                   <strong>Forgot Password</strong>
   
                               {{-- Forgot Password --}}
                               <div class="form-control mb-3">
                                <strong>Email</strong>
                                    <input type="email"  name="email" class="form-control" required >
                               </div>
                                 
       
                               <button class=" btn col-12 btn-primary">Send Reset Link</button>



                           </div>
                       </div>
                    </div>
                    <div class="col-12">
                        
                    </div>


                   </div>
               </form>


            {{-- Form Ends --}}
        </div>
    {{-- </body> --}}
    
</x-guest_layout>