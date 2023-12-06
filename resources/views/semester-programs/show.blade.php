<x-layout>
      
        <div class="container">
            
            <ul class="nav nav-tabs" role="tablist">
                
                <li class="nav-item">
                    <button class="nav-link active" data-toggle="tab"  role="tab" aria-controls="officiators">Officiators</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-toggle="tab"   role="tab" aria-controls="program_outline">Program Outline</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-toggle="tab"   role="tab" aria-controls="images"><i class="fa fa-camera"></i></button>
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
    
                        {{-- Table h5 --}}
                        <h5>Officiators For : {{$semester_program->name}}</h5>
                        @if($semester_program->user_officiators() != null)
                            {{-- Table Head --}}
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    
                                    <th>Officiating Role</th>

                                    @allowedTo(['update_semester_program'])
                                        <th>Actions</th>
                                     @endallowedTo
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
                                         @allowedTo(['delete_officiator'])
                                         <td>
                                            <button  type="button" data-toggle="modal" data-target="#myModal" class="btn get_content btn-danger" id="{{"user_".$officiator->pivot->officiating_role_id}}" data-url="{{route('confirm_officiator_delete',['semesterProgram'=>$semester_program, 'officiator'=>$officiator->officiator_id , 'status'=>$officiator->pivot->is_user, 'role'=>$officiator->pivot->officiating_role_id])}}">
                                                <i class="fa fa-remove"></i>
                                            </button>       

                                            <button  type="button" data-toggle="modal" data-target="#myModal" class="btn get_content btn-info" id="{{"user_".$officiator->pivot->officiating_role_id}}" data-url="{{route('edit_officiator',['semesterProgram'=>$semester_program, 'officiator'=>$officiator->officiator_id , 'status'=>$officiator->pivot->is_user, 'role'=>$officiator->pivot->officiating_role_id])}}">
                                                <i class="fa fa-pencil"></i>
                                            </button>  
                                        </td>
                                        @endallowedTo
    
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
                                         @allowedTo(['delete_officiator'])
                                         <td>
                                            <button  type="button" data-toggle="modal" data-target="#myModal" class="btn  btn-danger"  data-url="{{route('confirm_officiator_delete',['semesterProgram'=>$semester_program, 'officiator'=>$officiator->officiator_id , 'status'=>$officiator->pivot->is_user, 'role'=>$officiator->pivot->officiating_role_id])}}">
                                                <i class="fa fa-remove"></i>
                                            </button>         

                                            <button  type="button" data-toggle="modal" data-target="#myModal" class="btn  btn-info"  data-url="{{route('edit_officiator',['semesterProgram'=>$semester_program, 'officiator'=>$officiator->officiator_id , 'status'=>$officiator->pivot->is_user, 'role'=>$officiator->pivot->officiating_role_id])}}">
                                                <i class="fa fa-pencil"></i>
                                            </button>      
                                        </td>
                                        @endallowedTo
    
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
                            <a href="{{route('create_program_outline',['semesterProgram'=>$semester_program])}}" class="btn mb-3 btn-info float-right">Add New Session</a>
                            @endcan
                           <h5>Sessions for : {{$semester_program->name}}</h5>
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
                                         <td>{{++$counter.".  ".$session->name}} </td>
                                         @can('update',$semester_program)
                                         <td>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal"  data-url="{{route('confirm_program_outline_delete',['semesterProgram'=>$semester_program, 'programOutline'=>$session->id])}}">
                                                <i class="fa fa-remove"></i>
                                            </button>    
                                            <button  type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"  data-url="{{route('confirm_program_outline_update',['semesterProgram'=>$semester_program, 'programOutline'=>$session->id])}}">
                                                <i class="fa fa-pencil"></i>
                                            </button>   
                                        </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                            {{-- Table Body Ends --}}
                    </table>
                </div>
                {{-- Users Tab Ends --}}
                
                {{-- Images --}}
                <div class="tab-pane" id="images" role="tabpanel">
                    @allowedTo(['update_semester_program'])
                    <div class="card-body">
                        <form action="{{route('store_image')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                @csrf
    
                                <label for="image">Choose Image:</label>
                                <input type="file" name="image" id="image" accept="image/*" required>
                                @error('image')
                                    <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror
    
                                {{-- <label for="imageable_type">imageable Type:</label> --}}
                                <input type="text" value="App\Models\SemesterProgram" name="imageable_type" id="imageable_type" hidden required>
    
                                {{-- <label for="imageable_id">imageable ID:</label> --}}
                                <input type="text" name="imageable_id" value="{{$semester_program->id}}" id="imageable_id" hidden required>
    
    
                            <button type="submit" name="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
    
                        </form>
                    </div>
                    @endallowedTo

                    @foreach($semester_program->images as $photo )
                    <div class="card">
                        <span ><i class="fa fa-trash"></i></span>
                        <img class="image-display" src="{{asset('storage/images/'.$photo->url) }}" alt="photo">
                    </div>
                    @endforeach 

                </div>
                {{-- Users Tab Ends --}}
    

                
                {{-- Tab Div ends --}}
            </div>
        </div>
    
    </x-layout>