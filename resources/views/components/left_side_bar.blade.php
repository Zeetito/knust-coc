<div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.html"><i class="icon-speedometer"></i> Dashboard <span class="badge badge-primary">NEW</span></a>
                </li>

                <li class="nav-title">
                    TOOLS
                </li>

                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-settings"></i> User Settings</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('view_profile',auth()->id() )}}"><i class="icon-user"></i> Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('logout' )}}"><i class="icon-user"></i> LogOut</a>
                        </li>
                     
                    </ul>
                </li>
                {{-- CONFIGURATIONS --}}
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-gear"></i> Configurations</a>
                    <ul class="nav-dropdown-items">
                        {{-- Attendance --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('attendance')}}"><i class="icon-user"></i> Attendance</a>
                        </li>
                        {{-- Roles --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('roles')}}"><i class="icon-note"></i> Roles</a>
                        </li>
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
                        {{-- Faculty --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('faculties')}}"><i class="fa fa-circle-o-notch"></i> Faculty</a>
                        </li>
                        {{-- Departments --}}
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-circle-o-notch"></i> Departments</a>
                        </li>
                        {{-- Programs --}}
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-circle-o-notch"></i> Programs</a>
                        </li>
                        {{-- Courses --}}
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-circle-o-notch"></i> Courses</a>
                        </li>
 
                        
                     
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
                    {{-- <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-eye"></i>Views </a>
                    <ul class="nav-dropdown-items">

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('view_users')}}" target="_top"><i class="fa fa-users"></i> Users</a>
                        </li>
                        
                       
                    </ul> --}}

                        {{-- Special --}}
                        <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-star"></i> Special</a>
                        </li>

                </li>


            </ul>
        </nav>
    </div>