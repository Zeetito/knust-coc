<x-layout>
      
    <div class=" card ">

        <div class="container-fluid">
            {{-- Search User --}}
            <span class="form-control card">
                <form >
                    <input type="text" class="search_box" id="for_user_list" data-url="{{route('search_unavailable_members')}}" placeholder="search name..." style="text-align:center;">
                        <i class="fa fa-search"></i>
                </form>
            </span>

            {{-- Filter User --}}
            <span calss="form-control card float-right">
                <form >
                    <select type="text" id="_for_user_list" class="filter_box" data-url="{{route('filter_unavailable_members')}}" >    
                        <option>Filter By </option>
                        <option value="sick">UnWell Only</option>
                        <option value="travelled">Travelled Only</option>
                        <option value="not_yet_in">Not Yet In</option>
{{-- 
                        <option value="latest">Latest</option>
                        <option value="oldest">oldest</option> --}}
                    </select>        
                    <i class="fa fa-filter"></i>                                       
                </form>
            </span>

        </div>

        <div id="search_result_for_user_list" class=" row ">
            {{-- Each Account will sit in this --}}
            @foreach(App\Models\User::unavailable_members()->get() as $user)
                <div class="col-sm-3 col-md-2 mt-3">

                    {{-- If User is Ill --}}
                    @if($user->unavailable_member_category() == 'sick')
                    <a class="card text-white bg-warning" data-toggle="modal" data-target="#myModal" data-url="{{route('edit_unavailable_members_status',['user'=>$user])}}" >
                        <div class="card-body">
                            <div class="h1 text-muted text-right mb-4">
                                <i>
                                    <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                                </i>
                            </div>
                            <div class=" mb-0">{{$user->created_at->diffInDays(now())}} Days Ago</div>
                            <small class="text-muted text-uppercase font-weight-bold">{{$user->fullname()." ".$user->status(). " (". $user->unavailable_member_category().")" }}</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </a>
                    {{-- If User Account is blocke for a reason --}}
                    @elseif($user->unavailable_member_category() == 'travelled')
                    <a class="card text-white bg-secondary" data-toggle="modal" data-target="#myModal" data-url="{{route('edit_unavailable_members_status',['user'=>$user])}}" >
                        <div class="card-body">
                            <div class="h1 text-muted text-right mb-4">
                                <i>
                                    <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                                </i>
                            </div>
                            <div class=" mb-0">{{$user->created_at->diffInDays(now())}} Days Ago</div>
                            <small class="text-muted text-uppercase font-weight-bold">{{$user->fullname()." ".$user->status(). " (". $user->unavailable_member_category().")" }}</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </a>
                    {{-- If user is not reported --}}
                    @elseif($user->unavailable_member_category() == 'not_yet_in')
                    <a class="card text-white bg-primary" data-toggle="modal" data-target="#myModal" data-url="{{route('edit_unavailable_members_status',['user'=>$user])}}" >
                        <div class="card-body">
                            <div class="h1 text-muted text-right mb-4">
                                <i>
                                    <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                                </i>
                            </div>
                            <div class=" mb-0">{{$user->created_at->diffInDays(now())}} Days Ago</div>
                            <small class="text-muted text-uppercase font-weight-bold">{{$user->fullname()." ".$user->status(). " (". $user->unavailable_member_category().")" }}</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </a>
                    @endif


                </div>
            @endforeach
        </div>

    </div>

</x-layout>
