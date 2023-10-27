<x-layout>
      
        <div class="container">
            
            <ul class="nav nav-tabs" role="tablist">
                
                <li class="nav-item">
                    <button class="nav-link active" data-toggle="tab"  role="tab" aria-controls="officiators">Officiators</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-toggle="tab"   role="tab" aria-controls="program_outline">Program Outline</button>
                </li>

            </ul>
    
            
            
                
           
    
            {{-- Tab Div Begins --}}
            <div class="tab-content">
                {{-- Users Tab Begins --}}
                <div class="tab-pane active" id="officiators" role="tabpanel">
                    <table class="table table-striped">
                            {{-- Add New User Button --}}
                            @can('update',$semester_program)
                            {{-- <span data-url="{{route('fetch_role_users_modal',$role)}}" class="get_content btn mb-3 btn-info float-right">Add User</span> --}}
                            <a href="{{route('add_officiator_form',['semesterProgram'=>$semester_program])}}" class="btn mb-3 btn-info float-right">Add Officiator</a>
                            @endcan
    
                        {{-- Table Caption --}}
                        <caption>Officiators For : {{$semester_program->name}}</caption>
                        @if($semester_program->user_officiators() != null)
                            {{-- Table Head --}}
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    
                                    <th>Officiating Role</th>

                                    @can('update',$semester_program)
                                    <th>Actions</th>
                                     @endcan
                                </tr>
                            </thead>
                            {{-- Table Body --}}
                            <tbody id="search_result_for_officiator_list">

                                {{-- User Officiators --}}
                                @foreach($semester_program->user_officiators as $officiator)
                                    <tr id="tr_{{"user_".$officiator->pivot->officiating_role_id}}">
                                      
                                        {{-- Name And Avatar--}}
                                    
                                         <td>
                                            <a >
                                                <img src="{{$officiator->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                                            </a>
                                             {{$officiator->fullname()}}
                                        </td>

                                        {{-- Officiating Roles --}}
                                        <td>
                                            {{$semester_program->officiator_role($officiator)->name}}
                                        </td>
    
                                         {{-- Action  --}}
                                         @can('update',$semester_program)
                                         <td>
                                            <button  type="button" data-toggle="modal" data-target="#myModal" class="btn get_content btn-danger" id="{{"user_".$officiator->pivot->officiating_role_id}}" data-url="{{route('confirm_officiator_delete',['semesterProgram'=>$semester_program, 'officiator'=>$officiator->id , 'status'=>$officiator->pivot->is_user, 'role'=>$officiator->pivot->officiating_role_id])}}">
                                                <i class="fa fa-remove"></i>
                                            </button>       
                                            <button  type="button" data-toggle="modal" data-target="#myModal" class="btn get_content btn-info" id="{{"user_".$officiator->pivot->officiating_role_id}}" data-url="{{route('edit_officiator',['semesterProgram'=>$semester_program, 'officiator'=>$officiator , 'status'=>$officiator->pivot->is_user, 'role'=>$officiator->pivot->officiating_role_id])}}">
                                                <i class="fa fa-pencil"></i>
                                            </button>  
                                        </td>
                                        @endcan
    
                                    </tr>
                                @endforeach

                                {{-- Guest Officiators --}}
                                @foreach($semester_program->guest_officiators as $officiator)
                                    <tr id="tr_{{"guest_".$officiator->pivot->officiating_role_id}}">
                                      
                                        {{-- Name And Avatar--}}
                                    
                                         <td>
                                             {{$officiator->fullname}}
                                        </td>

                                        {{-- Officiating Roles --}}
                                        <td>    
                                            {{$semester_program->officiator_role($officiator)->name}}
                                        </td>
    
                                         {{-- Action  --}}
                                         @can('update',$semester_program)
                                         <td>
                                            <button  type="button" data-toggle="modal" data-target="#myModal" class="btn get_content btn-danger" id="{{"guest_".$officiator->pivot->officiating_role_id}}" data-url="{{route('confirm_officiator_delete',['semesterProgram'=>$semester_program, 'officiator'=>$officiator->id , 'status'=>$officiator->pivot->is_user, 'role'=>$officiator->pivot->officiating_role_id])}}">
                                                <i class="fa fa-remove"></i>
                                            </button>         

                                            <button  type="button" data-toggle="modal" data-target="#myModal" class="btn get_content btn-info" id="{{"guest_".$officiator->pivot->officiating_role_id}}" data-url="{{route('edit_officiator',['semesterProgram'=>$semester_program, 'officiator'=>$officiator->id , 'status'=>$officiator->pivot->is_user, 'role'=>$officiator->pivot->officiating_role_id])}}">
                                                <i class="fa fa-pencil"></i>
                                            </button>      
                                        </td>
                                        @endcan
    
                                    </tr>
                                @endforeach
                                


                            </tbody>
                            {{-- Table Body Ends --}}
                        @else
                            <div class="Container">NO PROGRAMS TO SHOW</div>
                        @endif
                    </table>
                </div>
                {{-- Users Tab Ends --}}
    
    
                {{-- Permissions Tab Begins --}}
                <div class="tab-pane" id="program_outline" role="tabpanel">
                    <table class="table table-striped">
                        {{-- Add New Permission Button --}}
                            @can('update',$semester_program)
                            <a href="" class="btn mb-3 btn-info float-right">Add New Session</a>
                            @endcan
                           <caption>Sessions for : {{$semester_program->name}}</caption>
                            {{-- Table Head --}}
                            <thead>
                                <tr>
                                    <th>Session Name</th>
                                    @can('update',$semester_program)
                                        <th>Actions</th>
                                    @endcan
                                </tr>
                            </thead>
                            {{-- Table Body --}}
                            <tbody class="search_result">
                                @foreach($semester_program->sessions() as $session)
                                    <tr id="tr_{{$session->id}}">
                                         <td>{{$session->name}} </td>
                                         @can('update',$semester_program)
                                         <td>
                                            <a class="btn check_button btn-danger" id="{{$session->id}}" data-url="#">
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
                
                {{-- Tab Div ends --}}
            </div>
        </div>
    
    </x-layout>