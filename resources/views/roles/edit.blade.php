<x-layout>
      
    <div class="container">
        
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" data-toggle="tab"  role="tab" aria-controls="users">Users</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-toggle="tab"   role="tab" aria-controls="permissions">Permissions</button>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" data-toggle="tab"  role="tab" aria-controls="messages">Messages</a>
            </li> --}}
        </ul>

        
        
            
       

        {{-- Tab Div Begins --}}
        <div class="tab-content">
            {{-- Users Tab Begins --}}
            <div class="tab-pane active" id="users" role="tabpanel">
                <table class="table table-striped">
                        {{-- Add New User Button --}}
                        @if(auth()->user()->is_preacher() == true)
                        {{-- <span data-url="{{route('fetch_role_users_modal',$role)}}" class="get_content btn mb-3 btn-info float-right">Add User</span> --}}
                        <a href="{{route('create_users_roles',$role)}}" class="btn mb-3 btn-info float-right">Add User</a>
                        @endif

                    {{-- Table Caption --}}
                    <caption>Users with the role: {{$role->name}}</caption>
                        {{-- Table Head --}}
                        <thead>
                            <tr>
                                <th>User Name</th>

                                @if(auth()->user()->is_preacher() == true)
                                <th>Actions</th>
                                 @endif
                            </tr>
                        </thead>
                        {{-- Table Body --}}
                        <tbody id="search_result_for_user_list">
                            @foreach($role->users as $user)
                                <tr id="tr_{{$user->id}}">
                                  
                                    {{-- Name And Avatar--}}
                                
                                     <td>
                                        <a >
                                            <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                                        </a>
                                         {{$user->fullname()}}
                                    </td>

                                     {{-- Action  --}}
                                     @if(auth()->user()->is_preacher() == true)
                                     <td>
                                        <a class="btn btn-danger"  data-toggle="modal" data-target="#myModal" data-url="{{route('confirm_role_user_remove',['role'=>$role , 'user'=>$user])}}" id="{{$user->id}}">
                                            <i class="fa fa-remove"></i>
                                        </a>     
                                    </td>
                                    @endif

                                </tr>
                            @endforeach
                        </tbody>
                        {{-- Table Body Ends --}}
                </table>
            </div>
            {{-- Users Tab Ends --}}


            {{-- Permissions Tab Begins --}}
            <div class="tab-pane" id="permissions" role="tabpanel">
                <table class="table table-striped">
                    {{-- Add New Permission Button --}}
                         @if(auth()->user()->is_preacher() == true)
                        <a href="{{route('create_roles_permissions',$role)}}" class="btn mb-3 btn-info float-right">Add New Permission</a>
                        @endif
                       <caption>Permissions attatched to the role: {{$role->name}}</caption>

                        {{-- Table Head --}}
                        <thead>
                            <tr>
                                <th>Permission Name</th>
                                 @if(auth()->user()->is_preacher() == true)
                                    <th>Actions</th>
                                @endif
                            </tr>
                        </thead>

                        {{-- Table Body --}}
                        <tbody class="search_result">
                            @foreach($role->permissions as $permission)
                                <tr id="tr_{{$permission->slug}}">
                                     <td>{{$permission->name}} </td>
                                      @if(auth()->user()->is_preacher() == true)
                                     <td>
                                        <a class="btn btn-danger"  data-toggle="modal" data-target="#myModal" data-url="{{route('confirm_role_permission_remove',['role'=>$role , 'permission'=>$permission])}}" id="{{$permission->id}}">
                                        {{-- <a class="btn check_button btn-danger" id="{{$permission->slug}}" data-url="{{route('remove_role_permission',['role'=>$role , 'permission'=>$permission])}}"> --}}
                                            <i class="fa fa-remove"></i>
                                        </a>    
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                        {{-- Table Body Ends --}}
                </table>
            </div>
            {{-- Users Tab Ends --}}


            
            <div class="tab-pane" id="messages" role="tabpanel">
                3Messagess. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
            
            {{-- Tab Div ends --}}
        </div>
    </div>

</x-layout>