@foreach($requests as $request)

<div class="col-sm-3 col-md-3 mt-3">
    {{-- If User is a Fresher --}}
    {{-- @if($request->guest()->status == 'fresher') --}}

    @if($request->is_assigned() == true)
        <div class="card text-white bg-success" >
    @else
        <div class="card text-white bg-info" >
    @endif
        <div class="card-body">
            
            

            @if($request->created_at->diffInDays(now()) > 0)
            <div class=" mb-0">{{$request->created_at->diffInDays(now())}} Days Ago</div>
            @else
                <div class=" mb-0">{{$request->created_at->diffInHours(now())}} Hours Ago</div>
            @endif

            <small class="text-uppercase font-weight-bold">{{$request->guest()->fullname}}</small><br>
            <small class="text-uppercase font-weight-bold">Status:{{$request->guest()->status." (".$request->method." ".$request->type.")" }}</small><br>
            <small class="text-uppercase font-weight-bold">Request:({{$request->method." ".$request->type}})</small><br>
            <div class="font-weight-bold">Contact: {{"wa.me/+233".$request->guest()->contact}}</div>
            @if($request->is_assigned() == false)
            <span class=" float-right btn fa fa-pencil" data-toggle="modal" data-target="#myModal" data-url="{{route('assign_guest_request',['guest_request'=>$request])}}" >Assign To</span>
            @else
            <span class=" float-right btn fa fa-check"  >Assigned - {{$request->assigned_user()->fullname()}}</span>
            @endif

         
        </div>
    </div>
    {{-- @endif --}}



</div>
                
@endforeach