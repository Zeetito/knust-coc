<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            @if(auth()->user()->hasAnyOf(App\Models\Role::ministry_members_level()->get()))
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" ><i class="fa fa-wrench"></i> Admin Tools</a>
                       
                        <ul class="nav-dropdown-items">

                            {{-- Dashboard --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admin_home')}}"><i class="icon-speedometer"></i> Dashboard</a>
                            </li>
                            @if(auth()->user()->hasAnyOf(App\Models\Role::preacher_level()->get()))

                                {{-- Configurations --}}
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('admin_config')}}"><i class="fa fa-warning"></i> Configurations</a>
                                </li>
                            @endif
                                {{-- Roles --}}
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('roles')}}"><i class="fa fa-warning"></i> User-Roles</a>
                                </li>
                                {{-- All Users --}}
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('view_users')}}"><i class="fa fa-users"></i> All Users</a>
                                </li>
    
                            
                        </ul>
                        {{-- <span class="badge badge-primary">NEW</span> --}}
                    
                </li>
            @endif

            {{-- <li class="nav-title">
                TOOLS
            </li> --}}

            {{-- User --}}
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" ><i class="fa fa-user"></i> User</a>
                <ul class="nav-dropdown-items">

                    {{-- Profile --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('view_profile',['user'=>auth()->user()])}}"><i class="fa fa-id-card"></i> Profile</a>
                    </li>
                    {{-- Groups --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('view_user_groups',['user'=>auth()->user()])}}"><i class="fa fa-users"></i> Groups</a>
                    </li>

                    
                </ul>
            </li>

            {{-- NOTIFICATION --}}
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" ><i class="fa fa-bell"></i> Notifications</a>
                <ul class="nav-dropdown-items">
                    {{-- Announcements --}}
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-bullhorn"></i> Announcements</a>
                    </li>
                    {{-- Group Invites --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('view_user_invites',['user'=>auth()->user()])}}"><i class="fa fa-envelope"></i> 
                            Invites
                            @if(auth()->user()->has_invites())
                                (<span class="h6 mb-4">{{auth()->user()->invites->count()}}</span>)
                            @endif
                        
                        </a>
                       
                    </li>

                    @if(auth()->user()->has_assigned_guest_request())
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('view_assigned_guest_request',['user'=>auth()->user()])}}"><i class="fa fa-book"></i> Assigned Requests  ({{auth()->user()->assigned_guest_requests()->count()}})</a>
                        </li>
                    @endif

                    {{-- Birthdays --}}
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-heart-o"></i> Birthdays</a>
                       
                    </li>
                    
                </ul>
            </li>
          
            {{-- CONFIGURATIONS --}}
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-gear"></i> Manage</a>
                <ul class="nav-dropdown-items">
                    {{-- Attendance --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('attendance')}}"><i class="icon-user"></i> Attendance</a>
                    </li>
                    {{-- Roles --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{route('roles')}}"><i class="icon-note"></i> Roles</a>
                    </li> --}}
                    {{-- Semester Programs --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('semester_programs')}}"><i class="fa fa-calendar-check-o"></i> Semester Programs</a>
                    </li>

                    {{-- Door To Door --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user_dtd',['user'=>auth()->user()])}}"><i class="fa fa-child"></i> Door To Door</a>
                    </li>

                 
                </ul>
            </li>

            {{-- ACADEMIA --}}
            {{-- <li class="nav-item nav-dropdown"> --}}
                {{-- <a class="nav-link nav-dropdown-toggle" ><i class="fa fa-university"></i> Academia</a> --}}
                {{-- <ul class="nav-dropdown-items"> --}}
                    {{-- College --}}
                    {{-- <li class="nav-item"> --}}
                        {{-- <a class="nav-link" href="{{route('colleges')}}"><i class="fa fa-circle-o-notch"></i> Colleges</a> --}}
                    {{-- </li> --}}

                    {{-- Programs --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-circle-o-notch"></i> Programs</a>
                    </li> --}}
                    {{-- Courses --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-circle-o-notch"></i> Courses</a>
                    </li> --}}

                    
                 
                {{-- </ul> --}}
            {{-- </li> --}}

            {{-- HOUSING --}}
            {{-- <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" ><i class="fa fa-home"></i> Housing</a>
                <ul class="nav-dropdown-items"> --}}
                    {{-- Zone --}}
                    {{-- <li class="nav-item"> --}}
                    {{-- <a class="nav-link" href="{{route('zones')}}"><i class="fa fa-circle-o-notch"></i> Zones</a> --}}
                    {{-- </li> --}}
                    {{-- Residence --}}
                    {{-- <li class="nav-item"> --}}
                        {{-- <a class="nav-link" href="#"><i class="fa fa-circle-o-notch"></i> Residences</a> --}}
                    {{-- </li> --}}
                 {{--  --}}
                {{-- </ul> --}}
            {{-- </li> --}}

              {{-- Manage --}}
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" ><i class="fa fa-user"></i> General</a>
                <ul class="nav-dropdown-items">

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('zones')}}"><i class="fa fa-circle-o-notch"></i> Zones</a>
                    </li>
                    {{-- Groups --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('view_user_groups',['user'=>auth()->user()])}}"><i class="fa fa-users"></i> College</a>
                    </li>

                    
                </ul>
            </li>

            {{-- SETTINGS --}}
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" ><i class="fa fa-gear"></i> Settings</a>
                <ul class="nav-dropdown-items">
                    {{-- Zone --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('edit_user',['user'=>auth()->user()])}}"><i class="fa fa-user"></i> Account</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('logout',['user'=>auth()->user()])}}"><i class="fa fa-power-off"></i> Logout</a>
                    </li>


                 
                </ul>
            </li>
           
           
            <li class="divider"></li>
            <li class="nav-title">
                Extras
            </li>


            {{-- PREFERENCE --}}
            <li class="nav-item nav-dropdown">
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" ><i class="fa fa-star"></i> Sepcial</a>
                    <ul class="nav-dropdown-items">  
                    {{-- For Members --}}
                    @if(auth()->user()->is_member)

                        {{-- Zonal Members --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('view_zone_mates',['user'=>auth()->user()])}}"><i class="fa fa-users"></i> Zone Members</a>
                        </li>
                        
                        {{-- Students Alone --}}
                        @if(auth()->user()->is_student)
                            {{-- Program Mates --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('view_program_mates',['user'=>auth()->user()])}}"><i class="fa fa-users"></i> Program Mates</a>
                            </li>
            
                            
                        @endif

                    @endif
                    
                    </ul>
                </li>

            </li>


        </ul>
    </nav>
</div>