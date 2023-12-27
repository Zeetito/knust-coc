<x-layout>
      
    <div class=" card ">

        <div class="container-fluid">
            {{-- Search User --}}
            {{-- <span class="form-control card"> --}}
                {{-- <form > --}}
                    {{-- <input type="text" class="search_box" id="for_user_list" data-url="{{route('search_guest_requests')}}" placeholder="search name..." style="text-align:center;"> --}}
                        {{-- <i class="fa fa-search"></i> --}}
                {{-- </form> --}}
            {{-- </span> --}}

            {{-- Filter User --}}
            {{-- <span calss="form-control card float-right"> --}}
                {{-- <form > --}}
                    {{-- <select type="text" id="_for_user_list" class="filter_box" data-url="{{route('filter_guest_requests')}}" >     --}}
                        {{-- <option>All</option> --}}
                        {{-- <option value="fresher">Freshers</option> --}}
                        {{-- <option value="member">New Members</option> --}}
{{-- 
                        <option value="latest">Latest</option>
                        {{-- <option value="oldest">oldest</option> --}}
                    {{-- </select>         --}}
                    {{-- <i class="fa fa-filter"></i>                                        --}}
                {{-- </form> --}}
            {{-- </span> --}}

            <a href="{{route('show_guest_requests')}}" class="btn btn-info float-right mt-2">
                Guest Requests
            </a>

        </div>

        <div id="search_result_for_user_list" class=" row ">
            {{-- Each Account will sit in this --}}
            @foreach($user->assigned_guest_requests() as $request)
            
                
                <div class="col-sm-3 col-md-2 mt-3">
                    {{-- If User is a Fresher --}}

                    @if($request->is_assigned() == true)
                        <div class="card text-white bg-info" >
                    @else
                        <div class="card text-white bg-info" >
                    @endif
                        <div class="card-body">
                        
                            {{-- <span class=" float-right btn fa fa-pencil" data-toggle="modal" data-target="#myModal" data-url="{{route('assign_guest_request',['guest_request'=>$request])}}" >Assign To</span> --}}

                            <div class=" mb-0">{{$request->created_at->diffInDays(now())}} Days Ago</div>
                            <small class="text-uppercase font-weight-bold">{{$request->guest()->fullname." - ".$request->guest()->status." (".$request->method." ".$request->type.")" }}</small>
                            <div class="font-weight-bold">Contact: {{$request->guest()->contact}}</div>

                            <span class="btn fa fa-pencil" data-toggle="modal" data-target="#myModal" data-url="{{route('edit_guest_request',['guest_request'=>$request])}}"   >Handle</span>
                         
                        </div>
                    </div>

                </div>
                
            @endforeach
        </div>

    </div>

</x-layout>
