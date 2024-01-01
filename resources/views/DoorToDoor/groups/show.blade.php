<x-layout>
        
    <div class="container-fluid">
            <div class="dashboard-container">

                {{-- Each Whole Table Screen --}}
                <div class="process-bar">
                    <div class="process-bar">
                        <div class="process-order">
                            {{-- <h3 style="text-align:center">There Are Groups you belong To</h3> --}}
                            {{-- Search Program bar --}}
                            <span>
                                <form >
                                    {{-- <input type="text" id="for_record_list" class="search_box" data-url="#" placeholder="search name..." style="text-align:center;"> --}}
                                        {{-- <i class="fa fa-search"></i> --}}
                                </form>
                            </span>
                          

                            {{-- New Semester Program Button --}}
                            @if(auth()->user()->is_admin_for($group))
                            <span class="btn btn-info mr-2 float-right mb-2" data-toggle="modal" data-target="#myModal" data-url="{{route('dtd_subgroup_create',['dtd'=>$dtd])}}" >
                                Create Sub-Group
                            </span>

                            <a class="btn btn-info mr-2 float-right mb-2" href="{{route('user_dtd',['user'=>auth()->user()])}}" >
                                My Sessions
                            </a>
                            @endif

                        </div>

                        {{-- Attendance Table --}}
                        <div class="" >

                                   <span class="h5">{{$group->name}}</span>
                                   <P class="">Mission: {{$group->info}}</P>


                            {{-- Accordion - Table of Rooms Covered --}}
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                      Rooms We've Been To
                                    </button>
                                  </h2>
                                  <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">

                                        @if($dtd->group_records($group) != "[]")
                                        <div class="">

                                            <span>
                                                <form >
                                                    <input type="text" id="for_record_list" class="search_box" data-url="#" placeholder="search name..." style="text-align:center;">
                                                        <i class="fa fa-search"></i>
                                                </form>
                                            </span>

                                            <table class="table table-striped">
                                                {{-- Table Head --}}
                                                <thead>
                                                    <tr>
                                                        <th>Person Name</th>
                                                        <th>Room </th>
                                                        <th>Floor</th>
                                                        
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                {{-- Table Body --}}
                                                <tbody id="search_result_for_record_list">
                                                    @foreach($dtd->group_records($group) as $record)

                                                        <tr id="tr_{{$record->id}}">
                                                            <td>
                                                            {{$record->name}}
                                                        </td>
                                                            <td>
                                                                {{$record->room}}
                                                            </td>

                                                            <td>{{$record->floor}}</td>

                                                            <td>
                                                                {{-- View Attendance Session --}}
                                                                <span  data-toggle="modal" data-target="#myModal" data-url="{{route('edit_dtd_record',['record_id'=>$record->id])}}" class="btn fa fa-pencil">

                                                                </span>

                                                            </td>
                                                            {{-- <td>
                                                                <span class="badge badge-success">Active</span>
                                                            </td> --}}
                                                        </tr>
                                                    @endforeach
                                                        
                                                </tbody>
                                                    {{-- Table Body Ends --}}
                                            </table>
                                                
                                        </div>
                                        @else
                                            <div class=" h5">No Records Made</div>
                                        @endif

                                    </div>
                                  </div>
                                </div>
                            </div>
                            {{-- Accordion Ends Here --}}

                            {{-- Create DTD-Persons INstance Button--}}
                            @if(auth()->user()->is_member_of($group))
                                <span class="mt-2 btn btn-warning" data-toggle="modal" data-target="#myModal" data-url="{{route('create_dtd_record',['group'=>$group])}}" >
                                    Add New Record
                                </span>
                            @endif

                        </div>

                       
                    </div>
                </div>

                {{-- List of Group Members --}}
                <div class="row flex-row ">

                    <div class="h5 col-12 mt-3">Group Members</div> 

                    {{-- Loop List of Members --}}
                    @foreach($group->members as $member)
                        <div class="col-sm-3 col-md-2 mt-3">

                            <span class="card text-white bg-info" data-toggle="" data-target="#myModal"  data-url="">

                                <div class="card-body">

                                    <div class="menu-container">
                                        <button class="menu-button">&#8286;</button>
                                        <div class="menu-content">
                                            <a href="{{route('view_profile',['user'=>$member])}}">Profile</a>
                                            @can('update',$group)

                                                    {{-- <a class="bg-warning btn mt-1" data-toggle='modal' data-target="#myModal" data-url={{route('mark_unavailable_confirm',['user'=>$member])}} href="{{route('mark_unavailable_confirm',['user'=>$member])}}">Make Admin</a> --}}

                                                    {{-- If user is already Admin, Option to take away Admin eyi --}}
                                                    @if($member->is_admin_for($group))
                                                        <span class="bg-warning btn mt-1" data-toggle='modal' data-target="#myModal" data-url="{{route('confirm_admin_withdraw',['group'=>$group,'user'=>$member])}}">Withraw Admin Role</span>
                                                    @else
                                                        <span class="bg-warning btn mt-1" data-toggle='modal' data-target="#myModal" data-url="{{route('confirm_make_user_admin',['group'=>$group,'user'=>$member])}}">Make Admin</span>
                                                    @endif
                                                        
                                                        <span class="bg-danger btn mt-1" data-toggle='modal' data-target="#myModal" data-url="{{route('confirm_remove_user',['group'=>$group,'user'=>$member])}}">Remove Member</span>
                                                
                                            @endcan
                                            {{-- <a href="#">Option 3</a> --}}
                                        </div>
                                    </div>

                                    <div class="h1 text-muted text-right mb-4">
                                        <i>
                                            <img src="{{$member->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                                        </i>
                                    </div>
                                    {{-- <div class=" mb-0">{{$request->created_at->diffInDays(now())}} Days Ago</div> --}}
                                    <small class="text-uppercase font-weight-bold">{{$member->fullname()}}</small>
                                    <div class="progress progress-white progress-xs mt-3">
                                        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </span>

                        </div>
                    @endforeach

                </div>

                @if(auth()->user()->is_admin_for($group))
                {{-- Invite User Button --}}
                <span class="mt-2 ml-2 btn btn-warning" data-toggle="modal" data-target="#myModal" data-url="{{route('create_invite',['group'=>$group])}}" >Invite User</span>
                <span class="mt-2 ml-2 btn btn-warning" data-toggle="modal" data-target="#myModal" data-url="{{route('group_invites',['group'=>$group])}}" >See Invites</span>
                @endif


            </div> <!-- end of dashboard container -->

        </div>
        <!-- /.conainer-fluid -->

</x-layout>