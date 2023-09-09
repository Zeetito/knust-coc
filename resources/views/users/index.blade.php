<x-layout>
      
        
        
        <div class="container-fluid">
            <div class="dashboard-container">

                {{-- Each Whole Table Screen --}}
                <div class="process-bar-container">
                    <div class="process-bar">
                        <div class="process-order">
                            <h3 style="text-align:center">Users</h3>
                            <input type="text" placeholder="search name..." style="text-align:center; float:right;">
                        </div>

                        {{-- Users Table --}}
                        <div class="pre-scrollable" >

                                <div class="card-body">
                                        <table class="table table-striped">
                                            {{-- Table Head --}}
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Username</th>
                                                    <th>Program Of Study</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            {{-- Table Body --}}
                                            <tbody>
                                                @foreach($users as $user)
                                                <tr>
                                                    <td>
                                                        {{$user->firstname." ".$user->lastname}}
                                                        
                                                                <a >
                                                                    <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                                                                </a>
                                                                                                       
                                                    </td>
                                                    <td>{{$user->username}}</td>
                                                    <td>{{ $user->program !="" ? $user->program->name : "Program Name" }}</td>
                                                    <td>
                                                        <a href="{{route('view_profile',$user->id)}}">
                                                              <i class="fa fa-eye"></i>
                                                        </a>
                                                    <span class="btn-info get_info_modal_button "  data-url="{{route('show_modal_info',$user->id)}}">
                                                              <i class="fa fa-address-card-o"></i>
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
                        
                         
                        </div>
                        {{--Users Table Ends--}}

                        {{-- Pagination Links go here--}}
                        <div class="process-billing">
                            {{$users->links()}}
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