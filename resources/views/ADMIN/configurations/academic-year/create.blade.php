<form action="{{route('store_new_academic_year')}}" method="post">
    @csrf
        <div class="modal-title" id="myModalLabel">
            <span style=" ">
                    <h4 style="text-align:center">Creating New Acadmic Year.</h4>
            </span>
        </div>
        <div class="modal-body">
                {{-- User Name --}}
                
                <strong>Are You Sure of What you're doing?</strong> <br>

                <strong>New Star Year</strong>
                <input type="text" class="form-control" name="start_year" value="{{$current_year->start_year + 1}}" readonly>
                
                <strong>New End Year</strong>
                <input type="text" class="form-control" name="end_year" value="{{$current_year->end_year + 1}}" readonly>

                
        </div>
    <div class="modal-footer">
        <input type="submit" name="submit_user" value="Yes" class=" btn btn-secondary">  
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
    </div>                                  
</form>