<form action="{{route('handle_user_request',['user_request'=>$user_request])}}" method="post">
    @csrf
        <div class="modal-title" id="myModalLabel">
                    <h5 style="text-align:center">Handle User Request</h5>
        </div>

        <div class="container-fluid">
                <div class="h6 bg bg-danger">
                   This Action Cannot Be Undone
                </div>

                <div class=" mb-0">{{$user_request->created_at->diffInDays(now())}} Days Ago</div>
                    <small class="text-uppercase font-weight-bold">{{$user_request->user()->fullname()." - ".$user_request->user()->status()." (".$user_request->method." ".$user_request->type.")" }}</small>
                    <div class="progress progress-white progress-xs mt-3">
                        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                {{-- View Difference Between The Previous and the New --}}
                <div class="row">
                    <div class=" col-6">
                        {{-- Display old resource attributes --}}
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Previous</th>
                                </tr>
                            </thead>
                            
                            <tbody>

                                @foreach($old_resource as $key => $value)
                                <tr>
                                    <td><strong>{{ $key }}</strong>: {{ $value }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                
                    <div class=" col-6">
                        {{-- Display new resource attributes --}}
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Update</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($new_resource as $key => $value)
                                <tr>
                                    <td><strong>{{ $key }}</strong>: {{ $value }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
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
