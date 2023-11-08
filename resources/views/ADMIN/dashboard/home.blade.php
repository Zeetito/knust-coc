<x-layout>
      
    <div class="container ">

        <div class="row ">

                <div class="border border-info mt-2 col-12">
                    <div class="card-body p-0 clearfix">
                        <i class="fa fa-user-circle bg-info p-4 px-5 font-2xl mr-3 float-right"></i>
                        <div class="h5 text-danger mb-0 pt-3">{{App\Models\User::inactive_accounts()->count() + App\Models\User::unavailable_members()->count()}}  </div>
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

            {{-- User Related Ends Here --}}
                {{-- Admin Related --}}
                <div class="border border-info mt-2  col-sm-12 col-md-12 ">
                    <div class="card-body p-0 clearfix">
                        <i class="fa fa-user-circle bg-info p-4 px-5 font-2xl mr-3 float-right"></i>
                        <div class="h5 text-danger mb-0 pt-3"> 15 </div>
                        <div class="text-muted text-uppercase font-weight-bold font-xs">ADMIN RELATED</div>
                    </div>
                </div>

                {{-- Under Admin Related, we have --}}
                {{-- All Ministries Related --}}
                <div class="col-sm-6 col-md-4 mt-3">
                    <a class="card text-white bg-success" href="{{route('show_inactive_accounts')}}">
                        <div class="card-body">
                            <div class="h1 text-muted text-right mb-4">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="h4 mb-0">{{App\Models\User::inactive_accounts()->count()}}</div>
                            <small class="text-muted text-uppercase font-weight-bold">All Ministries</small>
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </a>
                </div>


        </div>

    </div>

</x-layout>
