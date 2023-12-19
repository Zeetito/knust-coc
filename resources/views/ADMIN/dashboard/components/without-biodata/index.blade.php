<x-layout>
      
    <div class=" card ">

        <div class="container-fluid">
            {{-- Search User --}}
            <span class="form-control card">
                <form >
                    <input type="text" class="search_box" id="for_user_list" data-url="{{route('search_users_without_biodata')}}" placeholder="search name..." style="text-align:center;">
                        <i class="fa fa-search"></i>
                </form>
            </span>

            {{-- Filter User --}}
            <span calss="form-control card float-right">
                <form >
                    <select type="text" id="_for_user_list" class="filter_box" data-url="{{route('filter_users_without_biodata')}}" >    
                        <option>All</option>
                        <option value="member">Members</option>
                        <option value="alumni">Alumni</option>
                    </select>        
                    <i class="fa fa-filter"></i>                                       
                </form>
            </span>

        </div>

        <div id="search_result_for_user_list" class=" row ">
            {{-- Each Account will sit in this --}}
            @foreach(App\Models\User::without_biodata()->get()->sortByDesc('created_at') as $user)
                <div class="col-sm-3 col-md-2 mt-3">
                    {{-- If User is a Fresher --}}
                    {{-- @if($user->status() == 'fresher') --}}
                    <a class="card text-white bg-info" data-toggle="" data-target="#myModal" data-url=""  >
                        <div class="card-body">
                            <div class="h1 text-muted text-right mb-4">
                                {{-- <i>
                                    <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                                </i> --}}
                            </div>
                            <div class=" mb-0">{{$user->created_at->diffInDays(now())}} Days Ago</div>
                            <small class="text-uppercase font-weight-bold">{{$user->fullname()." - ".$user->status()}}</small>
                            <div class="font-weight-bold">Contact: {{$user->phone? "wa.me/".$user->phone->body : ($user->was_a_guest() ? "wa.me/".$user->when_guest()->contact : ""  )}}</div>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </a>

              
                </div>
            @endforeach
        </div>

    </div>

</x-layout>
