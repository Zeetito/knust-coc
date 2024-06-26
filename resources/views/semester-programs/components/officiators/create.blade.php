<x-layout>

    <div class="container card">
        <div calss="animated fadeIn">

            <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <div class="card mt-2">
                            <div class="card-header">
                                Add User As Officator
                                {{-- View Outline again Icon --}}
                                <a href="{{route('show_semester_program',['semesterProgram'=>$semester_program])}}">
                                    <span class="badge-pill badge-info float-right">
                                        <i class="fa fa-eye" title="View Outline">View Outline</i>
                                    </span>
                                </a>
                            </div>
                            
                            
                            <div class="card-body">

                                {{-- User Officiator Form --}}
                                <form action="{{route('store_officiator',['semesterProgram'=>$semester_program])}}" method="post">
                                    @csrf
                                    <span style=" ">
                                            <h4 style="text-align:center">Add Users</h4>
                                        {{-- User Name --}}
                                        <input list="search_result_for_user_list" data-url="{{route('search_user_officiator')}}" value="{{old('user_id')}}" class="search_box form-control" name="user_id" id="for_user_list"  autocomplete="off" placeholder="Search Name..." required>
                                        <i class="fa fa-search"></i>
                                        <datalist id="search_result_for_user_list">
                                                @if(empty($users))
                                                    <option>Search User</option>
                                                @else
                                                
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->fullname()}}</option>
                                                    @endforeach
        
                                                @endif
                                        </datalist>
                                        @error('user_id')
                                        <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                        @enderror

                                        <input type="checkbox" name="status" value="user" hidden checked>
 
                                    </span>
                                    <br>
                                    {{-- Officiating Role --}}
                                    <span style=" ">
                                        <label for="officiating_role_list">Assign Role</label>
                                        <input list="search_result_officiating_role_list" value="{{old('user_officiating_role_id')}}" class="search_box form-control" name="user_officiating_role_id" id="officiating_role_list"  autocomplete="off" placeholder="Search Name..." required>
                                        <datalist id="search_result_officiating_role_list">
                                                    @foreach(App\Models\SemesterProgram::all_officiating_roles() as $officiating_role)
                                                        <option value="{{$officiating_role->id}}">{{$officiating_role->name}}</option>
                                                    @endforeach
                                        </datalist>
                                        @error('user_officiating_role_id')
                                        <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                        @enderror
                                    </span>
                                        <input type="submit" name="submit_user" value="ADD OFFICIATOR" class="form-control btn btn-secondary">                                    
                                </form>
                                
                            </div>
                        </div>
                    </div>
                    <!--/.col-->
                   
                    <!--/.col-->
                    <div class="col-sm-6 col-md-6">
                        <div class="card mt-2">
                            <div class="card-header">
                                Add Guest As Officiator
                            </div>
                            <div class="card-body">
                               
                                {{-- Guest Officiators Form --}}
                                <form action="{{route('store_officiator',['semesterProgram'=>$semester_program])}}" method="post">
                                    @csrf
                                    {{-- Name --}}
                                    <label for="guest_name">Guest Name</label>
                                    <input type="text" name="guest_name" value="{{old('guest_name')}}" class="form-control" autocomplete="off" id="guest_name">
                                    @error('guest_name')
                                    <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                    @enderror

                                    {{-- Gender --}}
                                    <label  for="guest_gender">Gender</label>
                                    <select class="form-control" name="guest_gender" id="guest_gender">
                                        <option value="">Select</option>
                                        <option value="m">Male</option>
                                        <option value="f">Female</option>
                                    </select>
                                    @error('guest_gender')
                                    <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                    @enderror

                                    {{-- Local Church --}}
                                    <label for="local_congregation">Local Congregation</label>
                                    <input type="text" value="{{old('local_congregation')}}" name="local_congregation" class="form-control" id="local_congregation" required>
                                    @error('local_congregation')
                                    <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                    @enderror

                                    {{-- Officiating Role --}}
                                    <label for="guest_officiating_role">Officiating Role</label>
                                    <input list="guest_officiating_role" value="{{old('guest_officiating_role_id')}}" class="search_box form-control" name="guest_officiating_role_id" id="guest_officiating_role_list"  autocomplete="off" placeholder="Search Name..." >
                                    <datalist id="guest_officiating_role">
                                                @foreach(App\Models\SemesterProgram::all_officiating_roles() as $officiating_role)
                                                    <option value="{{$officiating_role->id}}">{{$officiating_role->name}}</option>
                                                @endforeach
                                    </datalist>
                                    @error('guest_officiating_role_id')
                                    <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                    @enderror

                                    <input type="checkbox"  name="status" value="guest"hidden checked>
                                    <input type="submit" value="ADD OFFICIATOR" class="form-control btn btn-secondary">

                                </form>

                            </div>
                        </div>
                    </div>
                   
            </div>
        </div>

    </div>

</x-layout>