<div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                @if(auth()->user()->hasAnyOf(App\Models\Role::ministry_members_level()->get()))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin_home')}}"><i class="icon-speedometer"></i> Admin Dashboard
                            
                            {{-- <span class="badge badge-primary">NEW</span> --}}
                        </a>
                    </li>
                @endif

                <li class="nav-title">
                    TOOLS
                </li>

                {{-- NOTIFICATION --}}
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" ><i class="fa fa-bell"></i> Notifications</a>
                    <ul class="nav-dropdown-items">
                        {{-- College --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{route('colleges')}}"><i class="fa fa-circle-o-notch"></i> Birthdays</a>
                        </li> --}}
                        
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
                        {{-- <li class="nav-item">
                            <a class="nav-link" href=""><i class="icon-user"></i> </a>
                        </li> --}}
                     
                    </ul>
                </li>

                {{-- ACADEMIA --}}
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" ><i class="fa fa-university"></i> Academia</a>
                    <ul class="nav-dropdown-items">
                        {{-- College --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('colleges')}}"><i class="fa fa-circle-o-notch"></i> Colleges</a>
                        </li>
    
                        {{-- Programs --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-circle-o-notch"></i> Programs</a>
                        </li> --}}
                        {{-- Courses --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-circle-o-notch"></i> Courses</a>
                        </li> --}}
 
                        
                     
                    </ul>
                </li>

                {{-- HOUSING --}}
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" ><i class="fa fa-home"></i> Housing</a>
                    <ul class="nav-dropdown-items">
                        {{-- Zone --}}
                        <li class="nav-item">
                        <a class="nav-link" href="{{route('zones')}}"><i class="fa fa-circle-o-notch"></i> Zones</a>
                        </li>
                        {{-- Residence --}}
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-circle-o-notch"></i> Residences</a>
                        </li>
                     
                    </ul>
                </li>
               
               
                <li class="divider"></li>
                <li class="nav-title">
                    Extras
                </li>


                {{-- PREFERENCE --}}
                <li class="nav-item nav-dropdown">


                    {{-- Students Alone --}}
                    @if(auth()->user()->is_student)
                        {{-- Special --}}
                        <li class="nav-item nav-dropdown">
                            <a class="nav-link nav-dropdown-toggle" ><i class="fa fa-star"></i> Sepcial</a>
                            <ul class="nav-dropdown-items">
                                {{-- Zone --}}
                                <li class="nav-item">
                                <a class="nav-link" href="{{route('view_program_mates',['user'=>auth()->user()])}}"><i class="fa fa-users"></i> Program Mates</a>
                                </li>
         
                             
                            </ul>
                        </li>
                    @endif

                </li>


            </ul>
        </nav>
    </div>