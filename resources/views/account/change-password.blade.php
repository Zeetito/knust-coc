<x-layout>
 
    <body class="app flex-row align-items-center">
        <div class="container">

   
           {{-- Form Begins --}}
                <form action="{{route('change_password',['user'=>$user])}}" method="Post">
                    @method('put')
                   @csrf
                   <div class="row justify-content-center" >
                       <div class="col-md-6">
                           <div class="card mx-4" style="border-radius:25px;">
                               <div class="card-body p-4 row">

                                 {{-- Password --}}
                                 <div class="col-12 mb-3">
                                    <strong>New Password</strong>
                                    <input type="password"  name="password" class="form-control" placeholder="Password">
                                </div>
                                @error('password')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror
        
                                {{-- ConfirmPassword --}}
                                <div class="col-12 mb-4">
                                    <strong>Confirm New Password</strong>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat password">
                                </div>
                                @error('password_confirmation')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror
                                    
                                <button type="submit" name="submit" class="btn btn-block btn-success">Save Password</button>
                            </div>

   
                             
                       </div>
                   </div>
               </form>
            {{-- Form Ends --}}
        </div>
    
       </x-layout>