    {{-- Header --}}
    <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{$attendance->meeting->name}} : {{$attendance->created_at->format("M-d-D")}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
    {{-- Body --}}
    <div class="modal-body">
         Do You really want to <strong>uncheck</strong> <strong>{{$member->firstname." ".$member->lastname}} ? </strong>
    </div>
    {{-- Footer --}}
    <div class="modal-footer">
        <button type="button" class=" btn btn-secondary" data-dismiss="modal">Cancel</button>

        <button type="button" id="{{$member->id}}"  class="btn btn-primary  check_button " data-url="{{route('check_user',['attendance'=>$attendance->id , 'user'=>$member->id])}}">Yes</button>
    </div>