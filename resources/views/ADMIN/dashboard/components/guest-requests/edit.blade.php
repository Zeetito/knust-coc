<form action="{{route('handle_guest_request',['guest_request'=>$guest_request])}}" method="post">
    @csrf
        <div class="modal-title" id="myModalLabel">
                    <h5 style="text-align:center">Handle Guest Request</h5>
        </div>

        <div class="modal-body">
                <div class="h6 bg bg-danger">
                   This Action Cannot Be Undone
                </div>

                <div class=" mb-0">{{$guest_request->created_at->diffInDays(now())}} Days Ago</div>
                <small class="text-uppercase font-weight-bold">{{$guest_request->guest()->fullname." - ".$guest_request->guest()->status." (".$guest_request->method." ".$guest_request->type.")" }}</small>
                <div class="progress progress-white progress-xs mt-3">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                {{-- INPUTS --}}
                <div>
                    <strong>Action</strong>
                    <select name="action" id="action" required>
                        <option value="">Select</option>
                        <option value="grant">Grant Request</option>
                        <option value="deny">Deny Request</option>
                    </select>
                </div>
                <br>
        </div>
        
        <div class="modal-footer">
            <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>
