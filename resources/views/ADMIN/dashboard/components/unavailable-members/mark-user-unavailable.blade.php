<form action="{{route('mark_user_unavailable',['user'=>$user])}}" method="post">
    @csrf
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
                <small class="text-muted text-uppercase font-weight-bold">{{$user->fullname()." ".$user->status(). " (". $user->inactive_account_reason().")" }}</small>
                <div class="progress progress-white progress-xs mt-3">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                {{-- INPUTS --}}
                <div calss="form-group">
                    <label class="form" for="is_available">Change Account Status</label>
                    <select class="form-control" name="is_available" required id="is_available">
                        <option value="">Select</option>
                        <option value="1">Mark Unavailable</option>
                    </select>

                    {{-- Category --}}
                    <label class="form" for="category">Category</label>
                    <select class="form-control" name="category" required id="category">
                        <option value="">Select</option>
                        <option value="not_yet_in">Not Yet In</option>
                        <option value="travelled">Travelled</option>
                        <option value="sick">Sick</option>
                    </select>

                    {{-- Info / Reason --}}
                    <label class="form" for="info">Info / Reason</label>
                    <input type="text" class="form-control" name="info" required id="info" placeholder="eg...Gone for field trip">

                </div>
        </div>
        
        <div class="modal-footer">
            <input type="submit" class="form-control" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>