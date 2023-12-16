<form action="{{route('give_permission_to',['permission'=>$permission])}}" method="post">
        @csrf
            <div class="modal-title" id="myModalLabel">
                <span style=" ">
                        <h4 style="text-align:center">Confirm</h4>
            </div>
            <div class="modal-body">
                {{-- User Name --}}
                <strong class="h5">You are giving assigning the permission to {{$permission->name}}</strong>

                <input list="officiator_id" value="{{old('user_id')}}" class=" form-control" name="user_id" id="officiator_id_list"  autocomplete="off" placeholder="Search Name..." >
                <datalist id="officiator_id">
                            @foreach(App\Models\User::where('is_activated',1)->get() as $user)
                                {{-- <option value="{{$user->id}}">{{$user->fullname().'-'.$user->zone() ?" --Zone: ".$user->zone()->name : "None"}}</option> --}}
                                <option value="{{$user->id}}">{{$user->fullname()}}</option>
                            @endforeach
                </datalist>
    
    
            </span>
            <br>
            {{-- Officiating Role --}}
        </div>
        <div class="modal-footer">
            <input type="submit" name="submit_user" value="Yes" class="form-control btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
    </form>