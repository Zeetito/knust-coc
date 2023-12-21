<x-layout>
      
    <div class=" card ">

        <div class="container-fluid">
            {{-- Search User --}}
            <span class="form-control ">
                <form >
                    <input type="text" class="search_box" id="for_user_list" data-url="{{route('search_inactive_user')}}" placeholder="search name..." style="text-align:center;">
                        <i class="fa fa-search"></i>
                </form>
            </span>

            {{-- Filter User --}}
            <span class="form-control float-right">
                <form >
                    <select type="text" id="_for_user_list" class="filter_box" data-url="{{route('filter_inactive_users')}}" >    
                        <option>Filter By </option>
                        <option value="suspended">Suspended Only</option>
                        {{-- 
                        <option value="latest">Latest</option>
                        <option value="oldest">oldest</option> --}}
                    </select>        
                    <i class="fa fa-filter"></i>                                       
                </form>
            </span>

        </div>

        {{-- If User has not DTD in Session, --}}
        
        <div id="search_result_for_user_list" class=" row ">
            @if($user->dtd_sessions() == "[]")
                <div class="col-12 h5">You Have No Door To Door Sessions To show</div>
            @else
            {{-- Each Account will sit in this --}}
            <div class="col-12 h6">These are the Door To Door Sessions you're associated with</div>
            @foreach($user->dtd_sessions() as $dtd)
                <div class="col-sm-3 col-md-2 mt-3">
                    
                    {{-- If User is a Fresher --}}
                    <div class="card text-white bg-secondary" >

                        <div class="menu-container">
                            <button class="menu-button">&#8286;</button>
                            <div class="menu-content">
                              {{-- <a href="{{route('view_profile',['user'=>$user])}}">Profile</a> --}}
                              {{-- @allowedTo(['update_user']) --}}
                              <a class="bg-info btn mt-1" data-toggle='modal' data-target="#myModal" data-url="{{route('dtd_users',['dtd'=>$dtd])}}">See Users</a>
                              <a class="bg-info btn mt-1" data-toggle='modal' data-target="#myModal" data-url="{{route('dtd_groups',['dtd'=>$dtd])}}">See Groups</a>
                              <a class="bg-info btn mt-1"  href="{{route('edit_user',['user'=>$user])}}">Edit This Account</a>
                              {{-- @endallowedTo --}}
                              {{-- <a href="#">Option 3</a> --}}
                            </div>
                        </div>

                        <div class="card-body"data-toggle="" data-target="#myModal" data-url="{{route('user_dtd_groups',$user)}}">
                            <div class="h1 text-muted text-right mb-4">
                                {{-- <i>
                                    <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                                </i> --}}
                            </div>
                            <div class=" mb-0">{{$dtd->created_at->diffInDays(now())}} Days Ago</div>
                            <small class="text-muted text-uppercase font-weight-bold">{{$dtd->name}}</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @endif
        </div>


    </div>

</x-layout>
