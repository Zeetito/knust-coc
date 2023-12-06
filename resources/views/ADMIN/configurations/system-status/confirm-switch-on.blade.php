<form action="{{route('switch_system_online')}}" method="post">
    @csrf
        <div class="modal-title" id="myModalLabel">
            <span style=" ">
                    <h4 style="text-align:center">Confirm</h4>
            </span>
        </div>
        <div class="modal-body">
                {{-- User Name --}}
                <p>Do You want to switch the system <strong>online</strong> ? </p>

                <div class="h6">This is allow all users to access accessible features of the system</div>

                <select class="form-control" name="response" required>
                    <option value="">Select</option>
                    <option value="">Not Sure</option>
                    <option value="1">Yes</option>
                    <option value="">Maybe</option>
                </select>
                
        </div>
    <div class="modal-footer">
        <input type="submit" name="submit_user" value="Yes" class=" btn btn-secondary">  
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
    </div>                                  
</form>