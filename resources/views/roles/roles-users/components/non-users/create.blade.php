<x-layout>
      
        
        
        <div class="container-fluid">
            <div class="dashboard-container">

                {{-- Each Whole Table Screen --}}
                <div class="process-bar-container">
                    <div class="process-bar">
                        <div class="process-order">
                        <h3 style="text-align:center">Give Users Role:   <a href="{{route('edit_role',['role'=>$role])}}"> {{$role->name}}  <i class="fa fa-eye"></i> </a>  </h3>
                                <span style=" ">
                                    <form >
                                        <input type="text"  id="for_non_user_list" class="search_box" data-url="{{route("search_non_user_roles",['role'=>$role])}}" placeholder="search name..." style="text-align:center;">
                                            <i class="fa fa-search"></i>
                                    </form>
                                </span>

                        </div>

                        {{-- Users Table --}}
                        <div class="pre-scrollable" >

                                <div class="card-body">
                                        <table class="table table-striped">
                                            {{-- Table Head --}}
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Zone</th>
                                                    <th>Residence</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            {{-- Table Body --}}
                                            <tbody id="search_result_for_non_user_list">
                                                @foreach($non_users as $user)
                                                    <tr id="tr_{{$user->id}}">
                                                    {{-- Name and avatar of user --}}
                                                    <td>
                                                        <a >
                                                            <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                                                        </a>
                                                        {{$user->fullname()}}
                                                        
                                                                                                       
                                                    </td>
                                                    {{-- Zone of the user --}}
                                                    <td>{{$user->username}}</td>

                                                    {{-- Residence of the User --}}
                                                    <td>{{ $user->biodata !=null ? $user->Zone->name : "Zone Name" }}</td>

                                                    {{-- Actions --}}
                                                    <td>
                                                        @can('update',$user)
                                                        <button class="check_button" id="{{$user->id}}" data-url="{{route('give_user_role',['role'=>$role, 'user'=>$user])}}" >
                                                              <i class="fa fa-check"></i>
                                                        </button>
                                                        @endcan
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

                        {{-- Pagination Links go here--}}
                        <div class="process-billing">
                            {{$non_users->links()}}
                        </div>
                    </div>
                </div>
                {{-- Whole Table Screen Ends --}}

                {{-- Info About Program --}}
                <div class="process-view-container">
                    <p style="font-weight:bolder">
                        See User Info
                    </p>
                    <div id="get_fetched_content" >

                        See User Info Here

                    </div>
                   
                </div>
                {{-- Info About Program Ends --}}

            </div> <!-- end of dashboard container -->

        </div>
        <!-- /.conainer-fluid -->
    
</x-layout>