<x-layout>
      
        
        
        <div class="container-fluid">
            <div class="dashboard-container">

                {{-- Each Whole Table Screen --}}
                <div class="process-bar">
                    <div class="process-bar">
                        <div class="process-order">
                        <h3 style="text-align:center">Assign Permission Role:   <a href="{{route('edit_role',['role'=>$role])}}"> {{$role->name}}  <i class="fa fa-eye"></i> </a>  </h3>
                                <span style=" ">
                                    <form >
                                        <input type="text" class="search_box" data-url="{{route("search_non_user_roles",['role'=>$role])}}" placeholder="search name..." style="text-align:center;">
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
                                                   
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            {{-- Table Body --}}
                                            <tbody class="search_result">
                                                @foreach($non_permissions as $permission)

                                                <tr id="tr_{{$permission->id}}">
                                                    <td>
                                                        {{$permission->name}}
                                                    </td>

                                                    {{-- Actions --}}
                                                    <td>
                                                        {{-- @can('update',$user) --}}
                                                         <button class="check_button" id="{{$permission->id}}" data-url="{{route('assign_role_permission',['role'=>$role,'permission'=>$permission])}}" >
                                                              <i class="fa fa-check"></i>
                                                        </button>
                                                        {{-- @endcan --}}
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
                            {{$non_permissions->links()}}
                        </div>
                    </div>
                </div>
                {{-- Whole Table Screen Ends --}}

                {{-- Info About Program --}}
                <div class="process-view-container">
                    <p style="font-weight:bolder">
                        {{-- See User Info --}}
                    </p>
                    <div id="get_fetched_content" >

                        {{-- See User Info Here --}}

                    </div>
                   
                </div>
                {{-- Info About Program Ends --}}

            </div> <!-- end of dashboard container -->

        </div>
        <!-- /.conainer-fluid -->
    
</x-layout>