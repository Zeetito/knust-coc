<form action="{{route('create_remark')}}" method="post">
    @csrf
        <div class=" m-2 modal-title" id="myModalLabel">
            <h6 style="text-align:center">Select Type Of Remark</h6>
        </div>
        <div class="modal-body">
            

            <select name="choice" class="form-control" id="" required>
                <option value="">Select type</option>
                @if(auth()->user()->is_ministry_member())
                    <option value="user">User</option>
                @endif
                <option value="smester_program">Semester Program</option>
            </select>

            <input type="text" name="semester_id" class="form-control" value={{App\Models\Semester::active_semester()->id}} hidden>

            <input type="text" name="model_type" hidden value="{{$model_type}}"  class="form-control">
            <input type="text" name="remarkerable_id" hidden value="{{$remarkerable_id}}"  class="form-control">

        </div>
        <div class="modal-footer">
            <input type="submit" name="submit_user" value="Go" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>                                  
</form>