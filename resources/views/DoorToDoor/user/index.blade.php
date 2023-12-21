
<div class="row">
    @if($dtd->groups != "[]")
        <div class="col-12 bg-info">Members of This Session</div>
        @foreach($dtd->users() as $user)
            <div class="col-12  mb-1 bg-secondary">
                {{-- If User is a Fresher --}}
                    <div class="">
                        {{$user->fullname()}}
                        <div class="float-right">
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
        <div class="col-12">This Session Has no Members</div>
    @endif

</div>