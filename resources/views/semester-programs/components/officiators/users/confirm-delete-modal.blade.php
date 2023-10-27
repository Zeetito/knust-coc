
<form action="{{route('remove_officiator',['semesterProgram'=>$semesterProgram, 'officiator'=>$officiator , 'status'=>$status, 'role'=>$role])}}" method="post">
    @csrf
    @method('delete')
        <div class="modal-title" id="myModalLabel">
            <span style=" ">
                    <h4 style="text-align:center">Confirm</h4>
        </div>
        <div class="modal-body">
            {{-- User Name --}}
            <p>Are you sure you want to withdraw this role from {{App\Models\User::find($officiator)->fullname()}}  </p>
            {{-- <input type="text"  value="{{$officiator}}" class="search_box form-control" name="user_id" id="for_user_list"  autocomplete="off" readonly hidden required>
            <input type="text"  value="{{App\Models\User::find($officiator)->fullname()}}" class="search_box form-control" name="" id=""  autocomplete="off" readonly > --}}
           

            <input type="checkbox" name="status" value="user" hidden checked>

        </span>
        <br>
        {{-- Officiating Role --}}
    </div>
    <div class="modal-footer">
        <input type="submit" name="submit_user" value="Yes" class="form-control btn btn-secondary">  
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
    </div>                                  
</form>