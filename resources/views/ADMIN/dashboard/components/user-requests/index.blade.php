<x-layout>
      
    <div class=" card ">

        <div class="container-fluid">
            {{-- Search User --}}
            <span class="form-control card">
                <form >
                    <input type="text" class="search_box" id="for_user_list" data-url="{{route('search_user_with_request')}}" placeholder="search name..." style="text-align:center;">
                        <i class="fa fa-search"></i>
                </form>
            </span>

            {{-- Filter User --}}
            <div class="mt-2">
                <form >
                    <select type="text" id="_for_user_list" class="filter_box" data-url="{{route('filter_user_requests')}}" >    
                        <option value="">Filter By Zone</option>
                        @foreach(App\Models\Zone::all() as $zone)
                            <option value="{{$zone->id}}">{{$zone->name}}</option>
                        @endforeach
{{-- 
                        <option value="latest">Latest</option>
                        <option value="oldest">oldest</option> --}}
                    </select>        
                    <i class="fa fa-filter"></i>                                       
                </form>
            </div>
            
            <div class="mt-2">
                <form >
                    <select type="text" id="_for_user_list" class="filter_box" data-url="{{route('filter_user_requests')}}" >    
                        <option value="">Filter By Status</option>
                        <option value="members">Members</option>
                        <option value="alumni">Alumni</option>
                        {{-- <option value="students">Students</option> --}}
                        {{-- <option value="non-students">Non-Students</option> --}}
{{-- 
                        <option value="latest">Latest</option>
                        <option value="oldest">oldest</option> --}}
                    </select>        
                    <i class="fa fa-filter"></i>                                       
                </form>
            </div>



        </div>

        <div id="search_result_for_user_list" class=" row ">
            {{-- Each Account will sit in this --}}
            @foreach(App\Models\User::users_with_pending_request()->get() as $user)

                <div class="col-sm-3 col-md-2 mt-3 " >
                    {{-- If User is a Fresher --}}

                    {{-- @if($user->inactive_account_reason() == 'fresher') --}}
                    <div class="card text-white bg-info accordion accordion-button accordion-item" id={{"accordion_".$user->username}} data-bs-target="{{"#collapse".$user->username}}" data-bs-toggle="collapse" aria-controls="{{"collapse".$user->username}}">
                    {{-- <div class="card text-white bg-info accordion accordion-button accordion-item" data-toggle="modal" data-target="#myModal"  data-url="{{route('edit_user_request',['user_request'=>$user])}}"> --}}
                        <div class="card-body">
                            <div class="h1 text-muted text-right mb-4">
                                 <i>
                                     <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture"> 
                                </i> 
                            </div>

                            @if($user->pending_requests->sortByDesc('created_at')->first()->created_at->diffInDays(now()) > 0)
                                <div class=" mb-0">{{$user->pending_requests->sortByDesc('created_at')->first()->created_at->diffInDays(now())}} Days Ago</div>
                            @else
                                <div class=" mb-0">{{$user->pending_requests->sortByDesc('created_at')->first()->created_at->diffInHours(now())}} Hours Ago</div>
                            @endif

                            <small class="text-uppercase font-weight-bold">{{$user->fullname()}}</small> <br>
                            <small class="text-uppercase font-weight-bold">Status: {{$user->status()}}</small> <br>
                            <small class="text-uppercase font-weight-bold">Zone: {{$user->zone() ? $user->zone()->name : "None"}} </small> <br>
                            <div class="font-weight-bold">Phone: {{$user->phone? $user->phone->body : ($user->was_a_guest() ? $user->when_guest()->contact : "None"  )}}</div>
                            <div class="font-weight-bold">WhatsApp: {{$user->whatsapp? $user->whatsapp->body :  "None"  }}</div>

                            {{-- <small class="text-uppercase font-weight-bold">whatsapp: {{$user->whatsapp->body}} </small><br> --}}
                            <div class="progress progress-white progress-xs mt-3">
                                {{-- <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div> --}}
                            </div>
                        </div>
                    </div>
            
                    {{-- @endif --}}

                    <div id={{"collapse".$user->username}} class="accordion-collapse collapse" data-bs-parent={{"#accordion_".$user->username}}>    
                        <table class="table table-bordered table-striped table-sm accordion-body">
                            <thead>
                                <tr>
                                    <th>
                                        Type
                                    </th>

                                    <th>
                                        Created...
                                    </th>

                                    <th>
                                        Respond
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($user->pending_requests as $request)
                                <tr>
                                    <td>
                                        {{$request->type}}
                                    </td>
                                    <td>
                                        @if($request->created_at->diffInDays(now()) > 0)
                                            <div class=" mb-0">{{$request->created_at->diffInDays(now())}} Days Ago</div>
                                            @else
                                            <div class=" mb-0">{{$request->created_at->diffInHours(now())}} Hours Ago</div>
                                        @endif
                                    </td>
                                    <td data-toggle="modal" data-target="#myLargeModal"  data-url="{{route('edit_user_request',['user_request'=>$request])}}"   class="btn fa fa-reply ">
                                        {{$request->method}}
                                    </td>
                                </tr>
                                
                                @endforeach
                            </tbody>
                        </table>                
                    </div>

                </div>
                
            @endforeach
        </div>

    </div>

</x-layout>
