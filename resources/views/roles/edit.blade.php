<x-layout>
      
    <div class="container">
        
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" data-toggle="tab"  role="tab" aria-controls="users">Users</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-toggle="tab"   role="tab" aria-controls="permissions">Permissions</button>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab"  role="tab" aria-controls="messages">Messages</a>
            </li>
        </ul>

        {{-- Tab Div Begins --}}
        <div class="tab-content">

            {{-- Users Tab Begins --}}
            <div class="tab-pane active" id="users" role="tabpanel">
                <table class="table table-striped">
                    <caption>Users with the role: {{$role->name}}</caption>
                        {{-- Table Head --}}
                        <thead>
                            <tr>
                                <th>User Name</th>
                                @can('assign',$role)
                                <th>Actions</th>
                                 @endcan
                            </tr>
                        </thead>
                        {{-- Table Body --}}
                        <tbody class="search_result">
                            @foreach($role->users as $user)
                                <tr>
                                     <td>{{$user->firstname." ".$user->lastname}} </td>
                                     @can('assign',$role)
                                     <td>
                                        <a class="btn btn-danger" href="#">
                                            <i class="fa fa-remove"></i>
                                        </a>     
                                    </td>
                                    @endcan
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
                    <caption>Permissions attatched to the role: {{$role->name}}</caption>
                        {{-- Table Head --}}
                        <thead>
                            <tr>
                                <th>Permission Name</th>
                                @can('assign',$role)
                                    <th>Actions</th>
                                @endcan
                            </tr>
                        </thead>
                        {{-- Table Body --}}
                        <tbody class="search_result">
                            @foreach($role->permissions as $permission)
                                <tr>
                                     <td>{{$permission->name}} </td>
                                     @can('assign',$role)
                                     <td>
                                        <a class="btn btn-danger" href="#">
                                            <i class="fa fa-remove"></i>
                                        </a>     
                                    </td>
                                    @endcan
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
                </div>
                {{-- Tab Div ends --}}

    </div>

</x-layout>