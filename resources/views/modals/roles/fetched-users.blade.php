    {{-- Header --}}
    <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Assign User Role: {{$role->name}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
    {{-- Body --}}
    <div  style="height:205px" class="pre-scrollable search_result">
        
            
                    @foreach($users as $user)
                        <ul>
                             <span>{{$user->firstname." ".$user->lastname}} </span>
                             @can('assign',$role)
                             <span>
                                <a class="btn btn-info" href="#">
                                    <i class="fa fa-check"></i>
                                </a>     
                            </span>
                            @endcan
                        </ul>
                    @endforeach
              

    </div>
    {{-- Footer --}}
    <div class="modal-footer">
        <button type="button" class=" btn btn-secondary" data-dismiss="modal">Cancel</button>

        <button type="button" id=""  class="btn btn-primary  check_button " data-url="">Yes</button>
    </div>