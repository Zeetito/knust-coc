<form action="{{route('store_ministry_account_session',['ministry'=>$ministry])}}" method="post">
    @csrf
        <div class="card-body modal-title" id="myModalLabel">
                    <h5 style="text-align:center">Creating Account Session</h5>

                    <div class="h6">
                        {{$ministry->name}}
                    </div>
        </div>

        <div class="modal-body">

            <strong>Name Of Session</strong>
            <input type="text" name="name" class="form-control" value="{{old('name')}}" required>

            <strong>Type</strong>
            <select name="type" id="type" class="form-control" required>
                <option value="">Select</option>
                <option value="calculate">Calculate</option>
                <option value="text_record">Text Record</option>
            </select>
            
            <input type="text" name="accountable_id" value="{{$ministry->id}}" readonly hidden required>
            <input type="text" name="accountable_type" value="App\Models\Role" readonly hidden required>

            

        </div>
        
        <div class="modal-footer">
            <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>
