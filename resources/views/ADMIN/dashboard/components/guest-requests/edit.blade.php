<form action="{{route('handle_guest_request',['guest_request'=>$guest_request])}}" method="post">
    @csrf
        <div class="modal-title" id="myModalLabel">
                    <h5 style="text-align:center">Handle Guest Request</h5>
        </div>

        <div class="modal-body">
                <div class="h6 bg bg-danger">
                   This Action Cannot Be Undone
                </div>

                {{-- Guest and The Resource --}}
                <div class="row ">
                    
                
                    <div class="bg-info col-12">
                        <h6>Data</h6>
                        {{-- Display new resource attributes --}}
                        <span>
                            @foreach($new_resource as $key => $value)
                                <li><strong>{{ $key }}</strong>: {{ $value }}</li>
                            @endforeach
                        </span>
                    </div>
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
