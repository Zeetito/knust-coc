@foreach($users as $user)
<div class="col-sm-3 col-md-2 mt-3 " >
    {{-- If User is a Fresher --}}

    {{-- @if($user->inactive_account_reason() == 'fresher') --}}
    <div class="card text-white bg-info accordion accordion-button accordion-item" id={{"accordion_".$user->username}} data-bs-target="{{"#collapse".$user->username}}" data-bs-toggle="collapse" aria-controls="{{"collapse".$user->username}}">
    {{-- <div class="card text-white bg-info accordion accordion-button accordion-item" data-toggle="modal" data-target="#myModal"  data-url="{{route('edit_user_request',['user_request'=>$user])}}"> --}}
        <div class="card-body">
            <div class="h1 text-muted text-right mb-4">
                 <i>
                     <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture"> 
                </i> 
            </div>
            <div class=" mb-0">{{$user->pending_requests->sortByDesc('created_at')->first()->created_at->diffInDays(now())}} Days Ago</div>
            <small class="text-uppercase font-weight-bold">{{$user->fullname()}}</small> <br>
            <small class="text-uppercase font-weight-bold">Status: {{$user->status()}}</small> <br>
            <small class="text-uppercase font-weight-bold">Zone: {{$user->zone() ? $user->zone()->name : "None"}} </small> <br>
            <small class="text-uppercase font-weight-bold">Phone: {{$user->phone->body}} </small><br>
            <small class="text-uppercase font-weight-bold">whatsapp: {{$user->whatsapp->body}} </small><br>
            <div class="progress progress-white progress-xs mt-3">
                {{-- <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div> --}}
            </div>
        </div>
    </div>

    {{-- @endif --}}

    <div id={{"collapse".$user->username}} class="accordion-collapse collapse" data-bs-parent={{"#accordion_".$user->username}}>    
        <table class="table table-bordered table-striped table-sm accordion-body">
            <thead>
                <tr>
                    <th>
                        Type
                    </th>

                    <th>
                        Created...
                    </th>

                    <th>
                        Respond
                    </th>
                </tr>
            </thead>
            <tbody>

                @foreach($user->pending_requests as $request)
                <tr>
                    <td>
                        {{$request->type}}
                    </td>
                    <td>
                        {{$request->created_at->diffInDays(now())." Days Ago" }}
                    </td>
                    <td data-toggle="modal" data-target="#myModal"  data-url="{{route('edit_user_request',['user_request'=>$request])}}"   class="btn fa fa-reply ">
                        {{$request->method}}
                    </td>
                </tr>
                
                @endforeach
            </tbody>
        </table>                
    </div>

</div>
@endforeach