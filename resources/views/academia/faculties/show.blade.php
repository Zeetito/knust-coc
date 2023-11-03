<x-layout>
      
    <div class="container">
        
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" data-toggle="tab"  role="tab" aria-controls="users">Users</button>
            </li>
           
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab"  role="tab" aria-controls="departments">Departments</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="tab"  role="tab" aria-controls="programs">Programs</a>
            </li>
        </ul>

        
        
            
       

        {{-- Tab Div Begins --}}
        <div class="tab-content">

            {{-- Users Tab Begins --}}
            <div class="tab-pane active pre-scrollable " id="users" role="tabpanel">
                <div>
                    {{-- Table Caption --}}
                    <caption>Users In: {{$faculty->name}}</caption>
                    <span style=" ">
                            <form >
                                <input type="text" id="for_user_list" class="search_box" data-url="{{route("search_faculty_user",['faculty'=>$faculty])}}" placeholder="search name..." style="text-align:center;">
                                    <i class="fa fa-search"></i>
                            </form>
                    </span>                    
                </div>
                <div>
                    <table class="table table-striped">
                        
    
                            {{-- Table Head --}}
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    
                                    <th>Departments</th>
                                    
                                    <th>Program</th>

                                    {{-- @can('update',$faculty)
                                    <th>Actions</th>
                                    @endcan --}}
                                </tr>
                            </thead>
                            {{-- Table Body --}}
                            <tbody id="search_result_for_user_list">
                                @foreach($users as $user)
                                    <tr id="tr_{{$user->username}}">
                                    
                                        {{-- Name And Avatar--}}
                                    
                                        <td>
                                            <a >
                                                <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                                            </a>
                                            {{$user->fullname()}}
                                        </td>

                                        {{-- Department --}}
                                        <td>
                                            {{$user->department() == null ? "No Department": $user->department()->name}}
                                        </td>
    
                                        {{-- Program --}}
                                        <td>
                                            {{$user->program->name}}
                                        </td>
    
                                        {{-- Action 
                                        @can('update',$faculty)
                                        <td>
                                            <a class="btn check_button btn-danger" id="{{$user->id}}" data-url="#">
                                                <i class="fa fa-remove"></i>
                                            </a>     
                                        </td>
                                        @endcan --}}
    
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
                <div>
                    <caption>Programs in: {{$faculty->name}}</caption>
                    <span style=" ">
                            <form >
                                <input type="text" id="for_program_list" class="search_box" data-url="{{route("search_faculty_program",['faculty'=>$faculty])}}" placeholder="search program..." style="text-align:center;">
                                    <i class="fa fa-search"></i>
                            </form>
                    </span>         
                </div>
                <div class="pre-scrollable">
                    <table class="table table-striped ">
                    
                        
                            {{-- Table Head --}}
                            <thead>
                                <tr>
                                    <th>Program Name</th>
                                    
                                    <th>Status</th>

                                    @can('update',$faculty)
                                    <th>Actions</th>
                                    @endcan
                                </tr>
                            </thead>
                            {{-- Table Body --}}
                            <tbody id="search_result_for_program_list">
                                @foreach($programs as $program)
                                    <tr id="tr_{{$program->id."_".$program->created_at}}">
                                        {{-- Program Name --}}
                                        <td>{{$program->name}} </td>
                                        {{-- Status --}}
                                        <td>{{$program->status == "pg"? "PostGraduate":"UnderGraduate"}}</td>
                                        
                                        @can('update',$faculty)

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


            
            <div class="tab-pane" id="departments" role="tabpanel">
                3Messagess. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
            
            {{-- Tab Div ends --}}
        </div>
    </div>

</x-layout>