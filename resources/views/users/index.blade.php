<x-layout>
      
        
        <div class="container-fluid  bg-white">
            <div class="">
                {{Breadcrumbs::render('view_users')}}
                {{-- Each Whole Table Screen --}}
                <div class="process-bar-container">

                    
                    <div class="process-bar" id="table_replaceable">
                        
                        {{-- <span  class="btn btn-info table_replace_button" data-url="{{route('users_table')}}" data-target="#table_replaceable" >Users Table</span> --}}
                        <a  class="btn btn-info table_replace_button" href="{{route('users_table_page')}}"  >Users Table</a>


                        <div class="process-order">
                            <h3 style="text-align:center">Members</h3>
                            
                                <span class="mb-2 ">
                                    <form >
                                        <input type="text" class="search_box" id="for_user_list" data-url="{{route("search_user")}}" placeholder="search name..." style="text-align:center;">
                                            <i class="fa fa-search"></i>
                                    </form>
                                </span>

                                 {{-- <span calss="form-control card float-right">
                                    <form >
                                        <select type="text" id="_for_program_mate_list" class="filter_box" >    
                                            <option>Filter By </option>
                                            <option value="same">All</option>
                                            <option value="junior">Student</option>
                                            <option value="senior">Alumini</option> 
                                            <option value="senior">Alumini</option> 
                                        </select>        
                                        <i class="fa fa-filter"></i>                                       
                                    </form>
                                </span> --}}

                        </div>

                        {{-- Users Table --}}

                            <div class="row"  id="search_result_for_user_list" >
                                       
                                @foreach($users as $user)
                                <div class="col-lg-4 col-sm-3 col-md-3 ">
                                    <div class="card text-white bg-info" data-toggle="" data-target="#myModal" data-url="{{route('edit_inactive_account_status',['user'=>$user])}}">
                                        <div class="card-body">

                                            <div class="menu-container">
                                                <button class="menu-button">&#8286;</button>
                                                <div class="menu-content">
                                                  {{-- <a href="{{route('view_profile',['user'=>$user])}}">Profile</a> --}}
                                                  @allowedTo(['update_user'])
                                                  <a class="bg-warning btn mt-1" data-toggle='modal' data-target="#myModal" data-url={{route('mark_unavailable_confirm',['user'=>$user])}} href="{{route('mark_unavailable_confirm',['user'=>$user])}}">Mark Unavailable</a>
                                                  <a class="bg-warning btn mt-1" data-toggle='modal' data-target="#myModal" data-url="{{route('mark_user_inactive_confirm',['user'=>$user])}}" href="#">Deactivate User</a>
                                                  <a class="bg-warning btn mt-1"  href="{{route('edit_user',['user'=>$user])}}">Edit This Account</a>
                                                  <a class="bg-danger btn mt-1"  data-target="#myModal" data-toggle="modal" data-url="{{route('confirm_delete_user',['user'=>$user])}}">Delete Account</a>
                                                  @endallowedTo
                                                  <a class="bg-success btn mt-1" data-toggle='modal' data-target="#myModal" data-url="{{route('custom_email_single_user',['user'=>$user])}}" href="#">Send Custom Email</a>
                                                  {{-- <a href="#">Option 3</a> --}}
                                                </div>
                                            </div>
                                            
                                            <div class="h1 text-muted text-right mb-4">
                                                <i>
                                                    <a href="{{route('view_profile', $user)}}">
                                                        <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                                                    </a>
                                                </i>
                                            </div>
                                            <div class=" mb-0">{{$user->created_at->diffInDays(now())}} Days Ago</div>
                                            <small class="text-muted text-uppercase font-weight-bold">{{$user->fullname()." ".$user->status()}}</small>
                                            <div class="progress progress-white progress-xs mt-3">
                                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                       
                            </div>
                        
                         
                        {{--Users Table Ends--}}

                        {{-- Pagination Links go here--}}
                        <div class="process-billing">
                            {{$users->links()}}
                        </div>
                    </div>
                </div>
                {{-- Whole Table Screen Ends --}}

                {{-- Info About Program Ends --}}

            </div> <!-- end of dashboard container -->

        </div>
        <!-- /.conainer-fluid -->
    
</x-layout>