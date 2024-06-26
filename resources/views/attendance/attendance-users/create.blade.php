<x-layout>
      
        
        <div class="container-fluid">
                <div class="dashboard-container">
    
                    {{-- Each Whole Table Screen --}}
                    <div class="process-bar">
                        <div class="process-bar">
                            <div class="process-order">
                                    @allowedTo(['update_attendance'])
                                    <a href="{{route('show_attendance_users',['attendance'=>$attendance])}}">
                                        <h3 style="text-align:center"> Attendance Session: {{$attendance->semesterProgram->name}}</h3>
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @endallowedTo
                                <span>
                                        <form >
                                            <input  type="text" class="search_box"  id="for_user_list" data-url="{{route("search_attendance_users",['attendance'=>$attendance] )}}" placeholder="search name..." style="text-align:center;">
                                                <i class="fa fa-search"></i>
                                        </form>
                                </span>
                            </div>
    
                            {{-- Attendance Table --}}
                            <div class="pre-scrollable" >
    
                                    <div class="card-body">
                                            <table class="table table-striped">
                                                {{-- Table Head --}}
                                                <thead>
                                                    <tr>
                                                        <th>Member</th>
                                                        <th>Email</th>
                                                        <th>Zone</th>
                                                        {{-- <th>Has Profile</th> --}}
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                {{-- Table Body --}}
                                                <tbody id="search_result_for_user_list">
                                                    @foreach($members as $member)
                                                        @if($member->has_member_profile())
                                                            <tr id="tr_{{$member->id}}">
                                                        @else
                                                            <tr class="bg-danger" id="tr_{{$member->id}}">
                                                        @endif
                                                            <td>
                                                                <a href="{{route('view_profile',['user'=>$member])}}">
                                                                    <img src="{{$member->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                                                                </a>
                                                                {{$member->fullnames()}}
                                                            </td>

                                                            {{-- Email --}}
                                                            <td>
                                                                {{$member->email}}
                                                            </td>

                                                            {{-- Zone --}}
                                                            <td>{{$member->biodata !=null ? ($member->zone()? $member->zone()->name:"None") : "No Zone" }}</td>

                                                            {{-- Has Profile? --}}
                                                            {{-- <td>
                                                                {{$member->has_member_profile() == true ? "Yes":"No" }}
                                                            </td> --}}
                                                            <td>
                                                                @if($member->is_checked($attendance))
                                                                            @can('check',$member)
                                                                                {{-- Uncheck User button --}}
                                                                                <span type="button" data-toggle="modal" data-target="#myModal" id="{{$member->id}}"  data-url="{{route('confirm_uncheck_user',['attendance'=>$attendance , 'user'=>$member])}}" >
                                                                                    <i class="text-success fa fa-check"></i>
                                                                                </span> 
                                                                                @else
                                                                                {{-- Not A button --}}
                                                                                <span type="button" class="button message"  >
                                                                                    <i class="text-success fa fa-check"></i>
                                                                                </span>
                                                                            @endcan

                                                                @else
                                                                            {{-- Check User Button --}}
                                                                            @can('check',$member)
                                                                            <button class="check_button" id="{{$member->id}}" data-url="{{route('check_user',['attendance'=>$attendance , 'user'=>$member])}}" >
                                                                                <i class=" text-danger fa fa-check"></i>
                                                                            </button>

                                                                            @else

                                                                            <button class="" id="{{$member->id}}" data-url="" >
                                                                                    <i class=" text-info fa fa-check"></i>
                                                                            </button>
                                                                            @endcan

                                                                @endif

                                                                
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
                            
                            </div>
                            {{--Users Table Ends--}}
    
                            {{$members->links()}}
                           
                        </div>
                    </div>

                    {{-- Whole Table Screen Ends --}}
                    
                    {{--REGISTERING VISITORS--}}
                    @allowedTo(['add_guest'])
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    Add User As Visitor
                                </div>
                                <div class="card-body">
    
                                    {{-- User Officiator Form --}}
                                    <form action="{{route('register_user_visitor',['attendance'=>$attendance])}}" method="post">
                                        @csrf
                                        <span style=" ">
                                                {{-- <h4 style="text-align:center">Add Users</h4> --}}
                                            {{-- User Name --}}
                                            <input list="search_result_for_user_visitor_list" data-url="{{route('search_user_officiator')}}" value="{{old('user_id')}}" class="search_box form-control" name="user_id" id="for_user_visitor_list"  autocomplete="off" placeholder="Search Name..." required>
                                            <i class="fa fa-search"></i>
                                            <datalist id="search_result_for_user_visitor_list">
                                                    @if(empty($members))
                                                        <option>Search User</option>
                                                    @else
                                                    
                                                        @foreach(App\Models\User::where('is_member',0)->get() as $user)
                                                            <option value="{{$user->id}}">{{$user->fullname()}}</option>
                                                        @endforeach
            
                                                    @endif
                                            </datalist>
                                            @error('user_id')
                                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                            @enderror
    
                                            <input type="checkbox" name="status" value="user" hidden checked>
     
                                        </span>
                                        <br>
                                       
                                            <input type="submit" name="submit_user" value="REGISTER VISITOR" class="form-control btn btn-secondary">                                    
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                        <!--/.col-->
                       
                        <!--/.col-->
                        <div class="col-sm-6 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    Register Guest As Visitor
                                </div>
                                <div class="card-body">
                                   
                                    {{-- Guest Officiators Form --}}
                                    <form action="{{route('register_guest_visitor',['attendance'=>$attendance])}}" method="post">
                                        @csrf
                                        {{-- Name --}}
                                        <label for="guest_name">Guest Name</label>
                                        <input type="text" name="guest_name" value="{{old('guest_name')}}" class="form-control" id="guest_name" autocomplete="off">
                                        @error('guest_name')
                                        <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                        @enderror
                                        
                                        {{-- Gender --}}
                                        <label for="guest_gender">Gender</label>
                                        <select name="guest_gender" id="guest_gender" class="form-control">
                                            <option>
                                                Select
                                            </option>
                                            <option value="m">
                                                    Male
                                            </option>
                                            <option value="f">
                                                    Female
                                            </option>
                                        </select>
                                        @error('guest_gender')
                                        <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                        @enderror

                                        {{-- is_member --}}
                                        <label for="is_member">Member of CoC ?</label>
                                        <select name="is_member" id="is_member" class="form-control">
                                            <option>
                                                Select
                                            </option>
                                            <option value=1>
                                                    Yes
                                            </option>
                                            <option value=0 selected>
                                                    No
                                            </option>
                                        </select>
                                        @error('is_member')
                                        <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                        @enderror
                                        
                                        {{-- Local Church --}}
                                        <label for="local_congregation">Church</label>
                                        <input type="text" name="local_congregation" value="{{old('local_congregation')}}" class="form-control" id="local_congregation" autocomplete="off" required>
                                        @error('local_congregation')
                                        <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                        @enderror

                                        {{-- Contact --}}
                                        <label for="contact">Contact</label>
                                        <input type="text" name="contact" class="form-control" id="contact" autocomplete="off">
                                        @error('contact')
                                        <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                        @enderror
                                        
                                        {{-- Purpose --}}
                                        <label for="purpose">Purpose of Visit</label>
                                        <textarea  name="purpose" class="form-control"  id="purpose" autocomplete="off">
                                            Came with a friend
                                        </textarea>
                                        @error('purpose')
                                        <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                        @enderror
                                        
    
                                        <input type="checkbox"  name="status" value="guest"hidden checked>
                                        <input type="submit" value="REGISTER VISITOR" class="form-control btn btn-secondary">
    
                                    </form>
    
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    @endallowedTo
                    {{-- Screen For Summary Ends --}}

                    
                    {{--Users Table Ends--}}

    
                </div> <!-- end of dashboard container -->
        </div>
            <!-- /.conainer-fluid -->
    
</x-layout>