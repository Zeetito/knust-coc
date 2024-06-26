<form action="{{route('store_ministry_account_record',['account'=>$account])}}" method="post">
    @csrf
        <div class="card-body modal-title" id="myModalLabel">
                    <h5 style="text-align:center">Creating New Record</h5>

                    <div class="h6">
                        {{$account->name}}
                    </div>
        </div>

        <div class="modal-body">

            <strong>Name</strong>
            <input type="text" name="item" class="form-control" value="{{old('item')}}" required>

            <strong>Info</strong>
            <textarea type="text" name="info" class="form-control"  required>
                {{old('info')}}
            </textarea>


            <strong>Value</strong>
            <input type="text" name="value" class="form-control" value="{{old('value')}}" required>

            @if($account->type == "calculate")
            <strong>Operation</strong>
            <select name="sign" id="" class="form-control">
                <option value="p">Add</option>
                <option value="n">Subtract</option>
            </select>
            @else
            <input type="text" name="sign" value="p" readonly hidden required>
            @endif


            <input type="text" name="account_id" value="{{$account->id}}" readonly hidden required>
        
            
            {{-- <input type="text" name="accountable_type" value="App\Models\Role" readonly hidden required> --}}

            

        </div>
        
        <div class="modal-footer">
            <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>
