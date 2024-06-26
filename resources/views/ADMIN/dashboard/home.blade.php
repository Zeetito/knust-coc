<x-layout>
      
    <div class="card-body ">

        <div class="row ">

                <div class="border border-info mt-2 col-12">
                    <div class="card-body p-0 clearfix">
                        <i class="fa fa-user-circle bg-info p-4 px-5 font-2xl mr-3 float-right"></i>
                        <div class="h5 text-danger mb-0 pt-3">{{App\Models\User::inactive_accounts()->count() + App\Models\User::unavailable_members()->count() + App\Models\User::user_requests()->count()}} </div>
                        <div class="text-muted text-uppercase font-weight-bold font-xs">User Related</div>
                    </div>
                </div>
                {{-- User the User Related, we have --}}

                {{-- Inactive Accounts --}}
                <div class="col-sm-6 col-md-4 mt-3">
                    <a class="card text-white bg-success" href="{{route('show_inactive_accounts')}}">
                        <div class="card-body">
                            <div class="h1 text-muted text-right mb-4">
                                <i class="icon-user-unfollow text-danger"></i>
                            </div>
                            <div class="h4 mb-0">{{App\Models\User::inactive_accounts()->count()}}</div>
                            <small class="text-muted text-uppercase font-weight-bold">InActive User Accounts</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </a>
                </div>
                
                {{-- Unavailable Members --}}
                <div class="col-sm-6 col-md-4 mt-3">
                    <a class="card text-white bg-success" href="{{route('show_unavailable_members')}}">
                        <div class="card-body">
                            <div class="h1 text-muted text-right mb-4">
                                <i class="icon-user-unfollow"></i>
                            </div>
                            <div class="h4 mb-0">{{App\Models\User::unavailable_members()->count()}}</div>
                            <small class="text-muted text-uppercase font-weight-bold">Unavailable Members</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Users Without Biodata --}}
                <div class="col-sm-6 col-md-4 mt-3">
                    <a class="card text-white bg-success" href="{{route('users_without_biodata')}}">
                        <div class="card-body">
                            <div class="h1 text-muted text-right mb-4">
                                <i class="fa fa-id-card"></i>
                            </div>
                            <div class="h4 mb-0">{{App\Models\User::without_biodata()->count()}}</div>
                            <small class="text-muted text-uppercase font-weight-bold">Users With No Profile</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </a>
                </div>


                {{-- Unavailable Members --}}
                <div class="col-sm-6 col-md-4 mt-3">
                    <a class="card text-white bg-success" href="{{route('show_user_requests')}}">
                        <div class="card-body">
                            <div class="h1 text-muted text-right mb-4">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                            <div class="h4 mb-0">{{App\Models\User::user_requests()->count()}}</div>
                            <small class="text-muted text-uppercase font-weight-bold">User Requests</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Birthdays --}}
                <div class="col-sm-6 col-md-4 mt-3">
                    <a class="card text-white bg-success" href="{{route('birthdays_today')}}">
                        <div class="card-body">
                            <div class="h1 text-muted text-right mb-4">
                                <i class="fa fa-birthday-cake"></i>
                            </div>
                            <div class="h4 mb-0">{{App\Models\User::with_birthday()->count()}}</div>
                            <small class="text-muted text-uppercase font-weight-bold">Birthdays</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- User Statistics --}}
                <div class="col-sm-6 col-md-4 mt-3">
                    <div class="card">
                        <div class="card-header bg-success">
                            <div class="font-weight-bold">
                                <span>USERS STATISTICS</span>
                                <span class="float-right">Users ({{App\Models\User::all()->count()}})</span>
                            </div>
                            <div>
                                <span>
                                    {{-- <small>Today 6:43 AM</small> --}}
                                    <small>Today</small>
                                </span>
                                <span class="float-right">
                                    <small>Members({{App\Models\User::where('is_member','1')->count()}})</small>,
                                    <small>Alumni({{App\Models\User::where('is_member','0')->count()}})</small>
                                </span>
                            </div>

                            <div class="menu-container">
                                <button class="menu-button fa fa-list"></button>
                                <div class="menu-content">

                                  <a class="bg-warning btn mt-1"  href="{{route('stats_members')}}">Members</a>
                                  <a class="bg-warning btn mt-1"  href="#">Alumni</a>

                                </div>
                            </div>

                            <div class="chart-wrapper" style="height:38px;"><iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; inset: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
                                <canvas class="chart-7-3 chart chart-line" height="76" width="716" style="display: block; height: 38px; width: 358px;"></canvas>
                            </div>
                            <div class="chart-wrapper" style="height:38px;"><iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; inset: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
                                <canvas class="chart-8-3 chart chart-bar" height="76" width="716" style="display: block; height: 38px; width: 358px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Welfare Ministry Page--}}
                @if(auth()->user()->hasRoleAs(['welfare_ministry_member']))
                    <div class="col-sm-6 col-md-4 mt-3">
                        <a class="card text-white bg-secondary" href="{{route('ministry_index',['ministry'=>App\Models\Role::where('slug','welfare_ministry_member')->first()])}}">
                            <div class="card-body">
                                <div class="h1 text-muted text-right mb-4">
                                    <i class="fa fa-heartbeat"></i>
                                </div>
                                {{-- <div class="h4 mb-0">{{App\Models\User::user_requests()->count()}}</div> --}}
                                <small class="text-muted text-uppercase font-weight-bold">Welfare Ministry Space</small>
                                <div class="progress progress-white progress-xs mt-3">
                                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif

                {{-- edification Ministry Page--}}
                @if(auth()->user()->hasRoleAs(['edification_ministry_member']))
                    <div class="col-sm-6 col-md-4 mt-3">
                        <a class="card text-white bg-secondary" href="{{route('ministry_index',['ministry'=>App\Models\Role::where('slug','edification_ministry_member')->first()])}}">
                            <div class="card-body">
                                <div class="h1 text-muted text-right mb-4">
                                    <i class="fa fa-map-o"></i>
                                </div>
                                {{-- <div class="h4 mb-0">{{App\Models\User::user_requests()->count()}}</div> --}}
                                <small class="text-muted text-uppercase font-weight-bold">Edification Ministry Space</small>
                                <div class="progress progress-white progress-xs mt-3">
                                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif

                {{-- evangelism Ministry Page--}}
                @if(auth()->user()->hasRoleAs(['evangelism_ministry_member']))
                    <div class="col-sm-6 col-md-4 mt-3">
                        <a class="card text-white bg-secondary" href="{{route('ministry_index',['ministry'=>App\Models\Role::where('slug','evangelism_ministry_member')->first()])}}">
                            <div class="card-body">
                                <div class="h1 text-muted text-right mb-4">
                                    <i class="fa fa-anchor"></i>
                                </div>
                                {{-- <div class="h4 mb-0">{{App\Models\User::user_requests()->count()}}</div> --}}
                                <small class="text-muted text-uppercase font-weight-bold">Evangelism Ministry Space</small>
                                <div class="progress progress-white progress-xs mt-3">
                                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif

                {{-- Finance Ministry Page--}}
                @if(auth()->user()->hasRoleAs(['finance_ministry_member']))
                    <div class="col-sm-6 col-md-4 mt-3">
                        <a class="card text-white bg-secondary" href="{{route('ministry_index',['ministry'=>App\Models\Role::where('slug','finance_ministry_member')->first()])}}">
                            <div class="card-body">
                                <div class="h1 text-muted text-right mb-4">
                                    <i class="fa fa-money"></i>
                                </div>
                                {{-- <div class="h4 mb-0">{{App\Models\User::user_requests()->count()}}</div> --}}
                                <small class="text-muted text-uppercase font-weight-bold">Finance Ministry Space</small>
                                <div class="progress progress-white progress-xs mt-3">
                                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif

                {{-- Organising Ministry Page--}}
                @if(auth()->user()->hasRoleAs(['organising_ministry_member']))
                    <div class="col-sm-6 col-md-4 mt-3">
                        <a class="card text-white bg-secondary" href="{{route('ministry_index',['ministry'=>App\Models\Role::where('slug','organising_ministry_member')->first()])}}">
                            <div class="card-body">
                                <div class="h1 text-muted text-right mb-4">
                                    <i class="fa fa-sitemap"></i>
                                </div>
                                {{-- <div class="h4 mb-0">{{App\Models\User::user_requests()->count()}}</div> --}}
                                <small class="text-muted text-uppercase font-weight-bold">Organising Ministry Space</small>
                                <div class="progress progress-white progress-xs mt-3">
                                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif

                {{-- Zonal Rep Page--}}
                @if(auth()->user()->hasRoleAs(['zone_rep']))
                    <div class="col-sm-6 col-md-4 mt-3">
                        <a class="card text-white bg-secondary" href="{{route('ministry_index',['ministry'=>App\Models\Role::where('slug','zone_rep')->first()])}}">
                            <div class="card-body">
                                <div class="h1 text-muted text-right mb-4">
                                    <i class="icon-home"></i>
                                </div>
                                {{-- <div class="h4 mb-0">{{App\Models\User::user_requests()->count()}}</div> --}}
                                <small class="text-muted text-uppercase font-weight-bold">Zonal Rep Space</small>
                                <div class="progress progress-white progress-xs mt-3">
                                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif

            {{-- User Related Ends Here --}}

                {{-- GUEST RELATED --}}
                <div class="border border-info mt-2  col-sm-12 col-md-12 ">
                    <div class="card-body p-0 clearfix">
                        <i class="fa fa-user-circle bg-info p-4 px-5 font-2xl mr-3 float-right"></i>
                        <div class="h5 text-danger mb-0 pt-3"> {{App\Models\Guest::guest_requests()->count()}} </div>
                        <div class="text-muted text-uppercase font-weight-bold font-xs">GUEST RELATED</div>
                    </div>
                </div>

                {{-- Under Guest Related, we have --}}
                {{-- Guest Related --}}
                <div class="col-sm-6 col-md-4 mt-3">
                    <a class="card text-white bg-success" href="{{route('show_guest_requests')}}">
                        <div class="card-body">
                            <div class="h1 text-muted text-right mb-4">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="h4 mb-0">{{App\Models\Guest::guest_requests()->count()}}</div>
                            <small class="text-muted text-uppercase font-weight-bold">Guest Requests</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </a>
                </div>


        </div>

    </div>

</x-layout>
