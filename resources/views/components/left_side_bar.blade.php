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
                        <li class="nav-item">
                            <a class="nav-link" href="components-tabs.html"><i class="icon-puzzle"></i> Tabs</a>
                        </li>
                    </ul>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link" href="widgets.html"><i class="icon-calculator"></i> Widgets <span class="badge badge-primary">NEW</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="charts.html"><i class="icon-pie-chart"></i> Charts</a>
                </li>
                <li class="divider"></li>
                <li class="nav-title">
                    Extras
                </li>


                {{-- PREFERENCE --}}
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-eye"></i>Views </a>
                    <ul class="nav-dropdown-items">

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('view_users')}}" target="_top"><i class="fa fa-users"></i> Users</a>
                        </li>
                        
                       
                    </ul>
                </li>


            </ul>
        </nav>
    </div>