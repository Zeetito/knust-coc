@if($users == "[]")
    <div class="col-lg-4 col-sm-3 col-md-3 ">
    
        <span class="btn btn-info h5">No Results Found</span>

    </div>
@else

@foreach($users as $user)
<div class="col-lg-4 col-sm-3 col-md-3 ">
    <div class="card text-white bg-info" data-toggle="" data-target="#myModal" data-url="{{route('edit_inactive_account_status',['user'=>$user])}}">
        <div class="card-body">

            <div class="menu-container">
                <button class="menu-button">&#8286;</button>
                <div class="menu-content">
                  {{-- <a href="{{route('view_profile',['user'=>$user])}}">Profile</a> --}}
                  @allowedTo(['update_user'])
                  <a class="bg-warning btn mt-1" data-toggle='modal' data-target="#myModal" data-url={{route('mark_unavailable_confirm',['user'=>$user])}} href="{{route('mark_unavailable_confirm',['user'=>$user])}}">Mark Unavailable</a>
                  {{-- <a class="bg-warning btn mt-1" data-toggle='modal' data-target="#myModal" data-url="{{route('mark_user_inactive_confirm',['user'=>$user])}}" href="#">Deactivate User</a> --}}
                  <a class="bg-warning btn mt-1"  href="{{route('edit_user',['user'=>$user])}}">Edit This Account</a>

                  @if($user->biodata == null)
                    <a class="bg-success btn mt-1"  href="{{route('create_user_profile_form',['user'=>$user])}}">Create Profile</a>
                  @else
                    <a class="bg-warning btn mt-1"  href="{{route('edit_user_profile_form',['user'=>$user])}}">Edit Profile</a>
                  @endif

                  <a class="bg-danger btn mt-1"  data-target="#myModal" data-toggle="modal" data-url="{{route('confirm_delete_user',['user'=>$user])}}">Delete Account</a>
                  @endallowedTo
                  {{-- <a class="bg-success btn mt-1" data-toggle='modal' data-target="#myModal" data-url="{{route('custom_email_single_user',['user'=>$user])}}" href="#">Send Custom Email</a> --}}

                  {{-- <a href="#">Option 3</a> --}}
                </div>
            </div>
            
            <div class="h1 text-muted text-right mb-4">
                <i>
                    <a href="{{route('view_profile', $user)}}">
                        <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                    </a>
                </i>
            </div>
            <div class=" mb-0">{{$user->created_at->diffInDays(now())}} Days Ago</div>
            <small class="text-muted text-uppercase font-weight-bold">{{$user->fullname()." ".$user->status()}}</small>
            <div class="progress progress-white progress-xs mt-3">
                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
</div>
@endforeach

@endif