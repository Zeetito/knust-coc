<form action="{{route('store_new_semester')}}" method="post">
    @csrf
        <div class="modal-title" id="myModalLabel">
            <span style=" ">
                    <h4 style="text-align:center">Creating New Semester.</h4>
            </span>
        </div>
        <div class="modal-body">
                {{-- User Name --}}
                
                <strong>Are You Sure of What you're doing?</strong> <br>

                <strong>New Star Date</strong>
                <input type="date" class="form-control" name="start_date"  required><br>
                
                <strong>New End Date</strong>
                <input type="date" class="form-control" name="end_date"  required><br>
                
                <strong>Type In Password to Confirm</strong>
                <input type="password" class="form-control" name="password"  required><br>
                
        </div>
    <div class="modal-footer">
        <input type="submit" name="submit_user" value="Yes" class=" btn btn-secondary">  
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    </div>                                  
</form>