<form action="{{route('delete_program_outline',['semesterProgram'=>$semesterProgram, 'programOutline'=>$programOutline->id])}}" method="post">
    @csrf
    @method('delete')
        <div class="modal-title" id="myModalLabel">
            <span style=" ">
                    <h4 style="text-align:center">Confirm</h4>
        </div>
        <div class="modal-body">
            {{-- User Name --}}
            <p>Are you sure you want to <strong>delete</strong> the {{$programOutline->name}} Session ? </p>
        </span>
        <br>
        {{-- Officiating Role --}}
    </div>
    <div class="modal-footer">
        <input type="submit" name="submit_user" value="Yes" class="form-control btn btn-secondary">  
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
    </div>                                  
</form>