<x-layout>
      
    <div class=" card ">

        <div class="container-fluid">
            {{-- Search User --}}
            {{-- <span class=""> --}}
                {{-- <form > --}}
                    {{-- <input type="text" class="search_box" id="for_user_list" data-url="{{route('search_inactive_user')}}" placeholder="search name..." style="text-align:center;"> --}}
                        {{-- <i class="fa fa-search"></i> --}}
                {{-- </form> --}}
            {{-- </span> --}}

            {{-- Filter User --}}
            {{-- <span class="form-control float-right"> --}}
                {{-- <form > --}}
                    {{-- <select type="text" id="_for_user_list" class="filter_box" data-url="{{route('filter_inactive_users')}}" >     --}}
                        {{-- <option>Filter By </option> --}}
                        {{-- <option value="suspended">Suspended Only</option> --}}
                        {{-- 
                        <option value="latest">Latest</option>
                        <option value="oldest">oldest</option> --}}
                    {{-- </select>         --}}
                    {{-- <i class="fa fa-filter"></i>                                        --}}
                {{-- </form> --}}
            {{-- </span> --}}

            @allowedTo(['create_fishing_out'])
            <span class="float-right btn btn-info">
                <div class="menu-container">
                    <button class="menu-button">Create a New Session</button>
                    <div class="menu-content">
                      {{-- <a href="{{route('view_profile',['user'=>$user])}}">Profile</a> --}}
                      <a class="bg-primary btn mt-1"  data-target="#myModal" data-toggle="modal" data-url="{{route('fishing_out_create',['user'=>$user])}}">Fishing Out</a>
                      <a class="bg-primary btn mt-1"  data-target="#myModal" data-toggle="modal" data-url="{{route('evangelism_create',['user'=>$user])}}">Evangelism</a>
                      <a class="bg-primary btn mt-1"  data-target="#myModal" data-toggle="modal" data-url="">Visitation</a>
                      {{-- <a href="#">Option 3</a> --}}
                    </div>
                </div>
            </span>
            @endallowedTo


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
                            
                              <a class="bg-info btn mt-1" data-toggle='modal' data-target="#myModal" data-url="{{route('dtd_users',['dtd'=>$dtd])}}">See Users</a>
                              <a class="bg-info btn mt-1" data-toggle='modal' data-target="#myModal" data-url="{{route('dtd_groups',['dtd'=>$dtd])}}">See Groups</a>
                              @can('delete',$dtd)
                                <a class="bg-warning btn mt-1" data-toggle='modal' data-target="#myModal" data-url="{{route('confirm_dtd_delete',['dtd'=>$dtd])}}">Delete Session</a>
                              @endcan
                              @can('update',$dtd)
                                <a class="bg-warning btn mt-1" data-toggle='modal' data-target="#myModal" data-url="{{route('edit_dtd',['dtd'=>$dtd])}}">Edit Session</a>
                              @endcan

                            </div>
                        </div>

                        <div class="card-body"data-toggle="" data-target="#myModal" data-url="{{route('user_dtd_groups',$user)}}">
                            <div class="h1 text-muted text-right mb-4">

                            </div>
                            <div class=" mb-0">{{$dtd->created_at->diffInDays(now())}} Days Ago</div>
                            <small class="text-uppercase font-weight-bold">{{$dtd->name}}</small> <br>
                            <small class="text-uppercase font-weight-bold">Mission: {{$dtd->info}}</small> <br>
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
