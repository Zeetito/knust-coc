
<form action="{{route('update_officiator',['semesterProgram'=>$semesterProgram, 'officiator'=>$officiator , 'status'=>$status, 'role'=>$role])}}" method="post">
    @csrf
    @method('put')
        <div class="modal-title" id="myModalLabel">
            <span style=" ">
                    <h4 style="text-align:center">Edit Officiator Role</h4>
        </div>
        <div class="modal-body">
            {{-- User Name --}}
            <input type="text"  value="{{$officiator}}" class="search_box form-control" name="user_id" id="for_user_list"  autocomplete="off" readonly hidden required>
            <input type="text"  value="{{App\Models\User::find($officiator)->fullname()}}" class="search_box form-control" name="" id=""  autocomplete="off" readonly >
            {{-- <i class="fa fa-search"></i>
            <datalist id="search_result_for_user_list">
                    @if(empty($users))
                        <option>Search User</option>
                    @else
                    
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->fullname()}}</option>
                        @endforeach

                    @endif
            </datalist> --}}
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
    </div>
    <div class="modal-footer">
        <input type="submit" name="submit_user" value="Save" class="form-control btn btn-secondary">  
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>                                  
</form>