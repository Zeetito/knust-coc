<form action="{{route('switch_attendance_session',['attendance'=>$attendance])}}" method="post">
        @csrf
        @method('post')
            <div class="modal-title" id="myModalLabel">
                <span style=" ">
                        <h4 style="text-align:center">Confirm</h4>
                </div>
                <div class="modal-body">
                    {{-- User Name --}}
                    <p>Are you sure you want to <strong>End / Start</strong> This Attendance Session ? </p>
                </span>
            <br>
            {{-- Officiating Role --}}
        </div>
        <div class="modal-footer">
            <input type="submit" name="submit_user" value="Yes" class="form-control btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>