<x-layout>

    {{-- If User Has Profile Details --}}

    @if(!empty($profile))

    <div class="row" style="justify-items:center">
        <div class="col-sm-6 col-md-12" style="margin-left:16px;background-color:white">

         User: {{ $user->firstname ." ". $user->lastname}}

            <div  style="border-color:blue; border-width:5px"  class="nav-link nav-link" data-toggle="dropdown" href="{{route('view_profile',auth()->user()->id)}}" role="button" aria-haspopup="true" aria-expanded="false">
                <img src="{{asset('img/avatars/'.auth()->user()->avatar.'.jpg')}}" class="img-avatar" alt="Profile Picture">
                <a href="{{route('edit_avatar')}}">
                    <span style="position:absolute; margin-top:25px;" class="d-md-down-none"><i title="change Profile picture" class="fa fa-pencil"></i></span>
                </a>

            </div>

                Hello {{$user}} here
            
        </div>
    </div>
    
    {{-- If User Has No Profile Details --}}
    @else
    <div class="row" style="justify-items:center">
            <div class="col-sm-6 col-md-8">
                <div class="card border-warning">
                    <div class="card-header">
                        No Info To Show
                    </div>
                    <div class="card-body">
                        
                        <span class="title">
                            Help Us Know more about You.
                        </span>
                    <a href="{{route('create_user_profile_form')}}">
                            <button class="btn btn-primary">
                                Complete Profile
                            </button>
                        </a>

                    </div>
                </div>
            </div>
            <!--/.col-->
           
        </div>
    @endif

</x-layout>