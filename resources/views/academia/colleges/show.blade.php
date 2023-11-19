<x-layout>
      
        <div class="container">
            
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-toggle="tab"  role="tab" aria-controls="users">Users</button>
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
                        <caption>Users In: {{$college->name}}</caption>
                        <span style=" ">
                                <form >
                                    <input type="text" id="for_user_list" class="search_box" data-url="{{route('search_college_user',['college'=>$college])}}" placeholder="search name..." style="text-align:center;">
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
                                        
                                        <th>Program</th>
                                        
                                        @can('update',$college)
                                        <th>Actions</th>
                                        @endcan
                                    </tr>
                                </thead>
                                {{-- Table Body --}}
                                <tbody id="search_result_for_user_list">
                                    @foreach($college->users() as $user)
                                        <tr id="tr_{{$user->id}}">
                                        
                                            {{-- Name And Avatar--}}
                                        
                                            <td>
                                                <a >
                                                    <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                                                </a>
                                                {{$user->fullname()}}
                                            </td>

                                            {{-- Program of Study --}}
                                            <td>
                                                {{$user->program() == Null ? "No Program" : $user->program()->name}}
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
                    <div>
                        <caption>Programs in: {{$college->name}}</caption>
                        <span style=" ">
                                <form >
                                    <input type="text" id="for_program_list" class="search_box" data-url="{{route("search_college_program",['college'=>$college])}}" placeholder="search program..." style="text-align:center;">
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

                                        <th>Type</th>

                                        @can('update',$college)
                                        <th>Actions</th>
                                        @endcan
                                    </tr>
                                </thead>
                                {{-- Table Body --}}
                                <tbody id="search_result_for_program_list">
                                    @foreach($programs as $program)
                                        <tr id="tr_{{$program->id."_".$program->created_at}}">

                                            <td>{{$program->name}} </td>

                                            {{-- Program Type --}}
                                            <td>
                                                {{$program->type == "ug" ? "UnderGraduate" : "PostGraduate"}}
                                            </td>

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

                
                {{-- Tab Div ends --}}
            </div>
        </div>
    
    </x-layout>