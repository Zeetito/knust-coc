
<div class="card-body row">
    <strong class="col-12">Invited Users</strong>

    @if($group->invited != "[]" )
        @foreach($group->invited as $user)
        <div class="col-12  mb-1 bg-secondary">
            {{-- If User is a Fresher --}}
                <div class="">
                    {{$user->fullname()}}
                    <div class="float-right">

                        @if(auth()->user()->is_admin_for($group))
                            <span title="Edit Group" data-toggle="modal" data-target="#myLargeModal" data-url="{{route('confirm_invite_delete',['group'=>$group, 'user'=>$user])}}"  >
                                <i class="fa fa-trash"></i>
                            </span>
                        @endif

                        <a href="{{route('view_profile',['user'=>$user])}}">
                            <i>
                                <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                            </i>
                        </a>
                    </div>
                    
                </div>
        </div>
        @endforeach
    @else
        <strong>No Invited Users</strong>
    @endif


</div>