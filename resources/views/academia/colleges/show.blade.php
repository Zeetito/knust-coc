<x-layout>
      
        <div class="container">
            
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-toggle="tab"  role="tab" aria-controls="users">Users</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-toggle="tab"   role="tab" aria-controls="permissions">Faculties</button>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"  role="tab" aria-controls="messages">Departments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"  role="tab" aria-controls="programs">Programs</a>
                </li>
            </ul>
    
            
            
                
           
    
            {{-- Tab Div Begins --}}
            <div class="tab-content">

                {{-- Users Tab Begins --}}
                <div class="tab-pane active pre-scrollable " id="users" role="tabpanel">
                    {{-- Table Caption --}}
                    <caption>Users In: {{$college->name}}</caption>
                    <div>
                        <table class="table table-striped">
                            
        
                                {{-- Table Head --}}
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        
                                        <th>Program</th>
        
                                        @can('update',$college)
                                        <th>Actions</th>
                                        @endcan
                                    </tr>
                                </thead>
                                {{-- Table Body --}}
                                <tbody class="search_result">
                                    @foreach($college->users as $user)
                                        <tr id="tr_{{$user->id}}">
                                        
                                            {{-- Name And Avatar--}}
                                        
                                            <td>
                                                <a >
                                                    <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                                                </a>
                                                {{$user->firstname." ".$user->lastname}}
                                            </td>

                                            {{-- Program of Study --}}
                                            <td>
                                                {{$user->program->name}}
                                            </td>
        
                                            {{-- Action  --}}
                                            @can('update',$college)
                                            <td>
                                                <a class="btn check_button btn-danger" id="{{$user->id}}" data-url="#">
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
                </div>
                {{-- Users Tab Ends --}}
    
    
                {{-- Programs Tab Begins --}}
                <div class="tab-pane " id="programs" role="tabpanel">
                    <caption>Programs in: {{$college->name}}</caption>
                    <div class="pre-scrollable">
                        <table class="table table-striped ">
                        
                            
                                {{-- Table Head --}}
                                <thead>
                                    <tr>
                                        <th>Program Name</th>

                                        @can('update',$college)
                                        <th>Actions</th>
                                        @endcan
                                    </tr>
                                </thead>
                                {{-- Table Body --}}
                                <tbody class="search_result">
                                    @foreach($college->programs as $program)
                                        <tr id="tr_{{$program->id."_".$program->created_at}}">

                                            <td>{{$program->name}} </td>
                                            @can('update',$college)

                                            <td>
                                                <a class="btn check_button btn-secondary" id="{{$program->id."_".$program->created_at}}" data-url="#">
                                                    <i class="fa fa-eye"></i>
                                                </a>    
                                            </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </tbody>
                                {{-- Table Body Ends --}}
                        </table>
                    </div>
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