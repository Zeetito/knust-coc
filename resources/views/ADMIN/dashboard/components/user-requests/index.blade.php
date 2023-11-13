<x-layout>
      
    <div class=" card ">

        <div class="container-fluid">
            {{-- Search User --}}
            <span class="form-control card">
                <form >
                    <input type="text" class="search_box" id="for_user_list" data-url="{{route('search_user_requests')}}" placeholder="search name..." style="text-align:center;">
                        <i class="fa fa-search"></i>
                </form>
            </span>

            {{-- Filter User --}}
            <span calss="form-control card float-right">
                <form >
                    <select type="text" id="_for_user_list" class="filter_box" data-url="{{route('filter_user_requests')}}" >    
                        <option>Filter By </option>
                        <option value="insert">Create</option>
                        <option value="update">Update</option>
                        <option value="delete">Delete</option>
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
            @foreach(App\Models\User::user_requests()->get() as $request)
                <div class="col-sm-3 col-md-2 mt-3">
                    {{-- If User is a Fresher --}}

                    {{-- @if($user->inactive_account_reason() == 'fresher') --}}
                    <a class="card text-white bg-info" data-toggle="modal" data-target="#myModal"  data-url="{{route('edit_user_request',['user_request'=>$request])}}">
                        <div class="card-body">
                            <div class="h1 text-muted text-right mb-4">
                                {{-- <i>
                                    <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                                </i> --}}
                            </div>
                            <div class=" mb-0">{{$request->created_at->diffInDays(now())}} Days Ago</div>
                            <small class="text-uppercase font-weight-bold">{{$request->user()->fullname()." - ".$request->user()->status()." (".$request->method." ".$request->type.")" }}</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </a>
            
                    {{-- @endif --}}


                </div>
            @endforeach
        </div>

    </div>

</x-layout>
