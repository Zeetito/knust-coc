<form action="{{route('update_officiator',['semesterProgram'=>$semesterProgram, 'officiator'=>$officiator , 'status'=>$status, 'role'=>$role])}}" method="post">
    @csrf
    @Method('PUT')
            {{-- Name --}}
            <div class="modal-title" id="myModalLabel">
                <span style=" ">
                        <h4 style="text-align:center">Edit Officiator Role</h4>
            </div>
            <label for="guest_name">Guest Name</label>
            <input type="text"  value="{{App\Models\Guest::find($officiator)->fullname}}" class="form-control" id="guest_name" readonly >
            @error('guest_name')
            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
            @enderror

            <div class="modal-body">
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

                <div class="modal-footer">
                    <input type="submit" name="submit_guest" value="Save" class="form-control btn btn-secondary">  
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>   
            </div>
</form>