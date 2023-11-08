<form action="{{route('update_unavailable_members_status',['user'=>$user])}}" method="post">
    @csrf
    @method('put')
        <div class="modal-title" id="myModalLabel">
                    <h5 style="text-align:center">Update Account Status</h5>
        </div>

        <div class="modal-body">
                <div class="h1">
                    <i>
                        <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                    </i>
                </div>

                <div class=" mb-0">{{$user->created_at->diffInDays(now())}} Days Ago</div>
                <small class="text-muted text-uppercase font-weight-bold">{{$user->fullname()." ".$user->status(). " (". $user->unavailable_member_category().")" }}</small>
                <div class="progress progress-white progress-xs mt-3">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p>{{$user->unavailable_member_info() != null ? $user->unavailable_member_info():""}}</p>

                {{-- INPUTS --}}
                <div>
                    <strong>Change Availability Status</strong>
                    <select name="is_available" id="is_available">
                        <option value="">Select</option>
                        <option value="1">Mark as Available</option>
                    </select>
                </div>
                <br>
        </div>
        
        <div class="modal-footer">
            <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>