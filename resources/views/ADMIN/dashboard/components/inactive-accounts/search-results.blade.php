@foreach($users as $user)
<div class="col-sm-3 col-md-2 mt-3">
    {{-- If User is a Fresher --}}
    @if($user->inactive_account_reason() == 'fresher')
    <a class="card text-white bg-info" data-toggle="modal" data-target="#myModal" data-url="{{route('edit_inactive_account_status',['user'=>$user])}}">
        <div class="card-body">
            <div class="h1 text-muted text-right mb-4">
                <i>
                    <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                </i>
            </div>
            <div class=" mb-0">{{$user->created_at->diffInDays(now())}} Days Ago</div>
            <small class="text-muted text-uppercase font-weight-bold">{{$user->fullname()." ".$user->status(). " (". $user->inactive_account_reason().")" }}</small>
            <div class="progress progress-white progress-xs mt-3">
                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </a>
    {{-- If User Account is blocke for a reason --}}
    @elseif($user->inactive_account_reason() == 'suspended')
    <a class="card text-white bg-danger" data-toggle="modal" data-target="#myModal" data-url="{{route('edit_inactive_account_status',['user'=>$user])}}">
        <div class="card-body">
            <div class="h1 text-muted text-right mb-4">
                <i>
                    <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                </i>
            </div>
            <div class=" mb-0">{{$user->created_at->diffInDays(now())}} Days Ago</div>
            <small class="text-muted text-uppercase font-weight-bold">{{$user->fullname()." ".$user->status(). " (". $user->inactive_account_reason().")" }}</small>
            <div class="progress progress-white progress-xs mt-3">
                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </a>
    {{-- A Non-Fresher Creating an account --}}
    @elseif($user->inactive_account_reason() == 'new_account')
    <a class="card text-white bg-secondary" data-toggle="modal" data-target="#myModal" data-url="{{route('edit_inactive_account_status',['user'=>$user])}}">
        <div class="card-body">
            <div class="h1 text-muted text-right mb-4">
                <i>
                    <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                </i>
            </div>
            <div class=" mb-0">{{$user->created_at->diffInDays(now())}} Days Ago</div>
            <small class="text-muted text-uppercase font-weight-bold">{{$user->fullname()." ".$user->status(). " (". $user->inactive_account_reason().")" }}</small>
            <div class="progress progress-white progress-xs mt-3">
                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </a>
    @endif


</div>
@endforeach