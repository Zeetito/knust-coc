<x-layout>
      
    <div class=" card ">

        <div class="container-fluid">
            {{-- Search User --}}
            <span class="form-control card">
                <form >
                    <input type="text" class="search_box" id="for_user_list" data-url="{{route('search_guest_requests')}}" placeholder="search name..." style="text-align:center;">
                        <i class="fa fa-search"></i>
                </form>
            </span>

            {{-- Filter User --}}
            <span calss="form-control card float-right">
                <form >
                    <select type="text" id="_for_user_list" class="filter_box" data-url="{{route('filter_guest_requests')}}" >    
                        <option>All</option>
                        <option value="fresher">Freshers</option>
                        <option value="member">New Members</option>
                        <option value="alumni">Alumni</option>
                        <option value="alumini">__Alumni</option>
                        {{-- 
                            <option value="latest">Latest</option>
                            
                            <option value="oldest">oldest</option>
                         --}}
                    </select>        
                    <i class="fa fa-filter"></i>                                       
                </form>
            </span>

            @if(auth()->user()->has_assigned_guest_request())
                <a href="{{route('view_assigned_guest_request',['user'=>auth()->id()])}}" class="btn btn-info float-right mr-2">
                    Assigned Request ({{auth()->user()->assigned_guest_requests()->count()}})
                </a>
            @endif
            
            {{-- If User is A Ministry Member... --}}

            @if(auth()->user()->is_ministry_member())
                <a href="{{route('handle_bulk_guest_request_page')}}" class="btn btn-info float-right mr-2">
                    Handle Bulk Request
                </a>
            @endif

        </div>

        <div id="search_result_for_user_list" class=" row ">
            {{-- Each Account will sit in this --}}
            @foreach(App\Models\Guest::guest_requests()->get() as $request)
            
                
                <div class="col-sm-3 col-md-3 mt-3">
                    {{-- If User is a Fresher --}}
                    {{-- @if($request->guest()->status == 'fresher') --}}

                    @if($request->is_assigned() == true)
                        <div class="card text-white bg-success" >
                    @else
                        <div class="card text-white bg-info" >
                    @endif
                        <div class="card-body">
                            
                            

                            @if($request->created_at->diffInDays(now()) > 0)
                            <div class=" mb-0">{{$request->created_at->diffInDays(now())}} Days Ago</div>
                            @else
                                <div class=" mb-0">{{$request->created_at->diffInHours(now())}} Hours Ago</div>
                            @endif

                            <small class="text-uppercase font-weight-bold">{{$request->guest()->fullname}}</small><br>
                            <small class="text-uppercase font-weight-bold">Status:{{$request->guest()->status." (".$request->method." ".$request->type.")" }}</small><br>
                            <small class="text-uppercase font-weight-bold">Request:({{$request->method." ".$request->type}})</small><br>
                            <div class="font-weight-bold">Contact: {{"wa.me/+233".$request->guest()->contact}}</div>
                            @if($request->is_assigned() == false)
                            <span class=" float-right btn fa fa-pencil" data-toggle="modal" data-target="#myModal" data-url="{{route('assign_guest_request',['guest_request'=>$request])}}" >Assign To</span>
                            @else
                            <span class=" float-right btn fa fa-check"  >Assigned - {{$request->assigned_user()->fullname()}}</span>
                            @endif

                         
                        </div>
                    </div>
                    {{-- @endif --}}



                </div>
                
            @endforeach
        </div>

    </div>

</x-layout>
