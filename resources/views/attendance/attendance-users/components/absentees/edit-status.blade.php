<form action="{{route('udpate_absentee_status',['attendance'=>$attendance , 'user'=>$user])}}" method="post">
    @csrf
    @method('put')
        <div class="modal-title" id="myModalLabel">
            <span style=" ">
                    <h4 style="text-align:center">Edit Status</h4>
        </div>
        <div class="modal-body">
                {{-- User Name --}}
                <p>Edit {{$user->fullname()}} Status. </p>
                {{-- <input type="text"  value="{{$officiator}}" class="search_box form-control" name="user_id" id="for_user_list"  autocomplete="off" readonly hidden required>
                <input type="text"  value="{{App\Models\User::find($officiator)->fullname()}}" class="search_box form-control" name="" id=""  autocomplete="off" readonly > --}}
                Was <strong>{{$user->fullname()}}</strong> Available ?
                <select class="form-control" name="is_present" id="" required>
                    <option value="">Select</option>
                    <option value="0">Yes (No Good Reason)</option>
                    <option value="2">No (Good Reason Given)</option>
                </select>

                
                    <input type="text" name="reason" placeholder="Reason, If No." class="mt-3 form-control" >

            </span>
            <br>
            {{-- Officiating Role --}}
        </div>
    <div class="modal-footer">
        <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
    </div>                                  
</form>