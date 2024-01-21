<x-layout>
<form action="{{route('bulk_handle_guests_requests')}}" class="bg-white" method="post">
    @csrf
        <div class="card-body modal-title" id="myModalLabel">
                  Bulk Handle Requests

                  <a href="{{route('show_guest_requests')}}" class="btn btn-info float-right">Back</a>
        </div>

        <div class="modal-body">

          

            <div id="search_result_for_user_list" class=" row ">
                {{-- Each Account will sit in this --}}
                @foreach(App\Models\Guest::guest_requests()->get() as $request)
                
                    
                    <div class="col-sm-3 col-md-3 mt-3">
                        {{-- If User is a Fresher --}}
                        {{-- @if($request->guest()->status == 'fresher') --}}
                        
                        @if($request->is_assigned() == true)
                        <div class="card text-white bg-success" >
                            @else
                            <div class="card text-white bg-info" >
                                @endif
                                <div class="card-body">

                                <input type="checkbox" class=""  name="requests[]" value="{{$request->id}}">
                                
                                
    
                                <div class=" mb-0">{{$request->created_at->diffInDays(now())}} Days Ago</div>
                                <small class="text-uppercase font-weight-bold">{{$request->guest()->fullname}}</small><br>
                                <small class="text-uppercase font-weight-bold">Status:{{$request->guest()->status." (".$request->method." ".$request->type.")" }}</small><br>
                                <small class="text-uppercase font-weight-bold">Request:({{$request->method." ".$request->type}})</small><br>
                                <div class="font-weight-bold">Contact: {{"wa.me/+233".$request->guest()->contact}}</div>

    
                             
                            </div>
                        </div>
                        {{-- @endif --}}
    
    
                    </div>
                    
                @endforeach
            </div>



        </div>
        
        <div class="modal-footer">
            <input type="submit" name="submit" value="Grant" class=" btn btn-secondary">  
            <input type="submit" name="submit" value="Deny" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>
</x-layout>  