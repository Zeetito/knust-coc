<x-layout>
      
    <div class=" card ">

        <div class="container-fluid">
            <span class="float-right btn h2 bg-info">Zone: {{$user->zone()->name}}</span>
        </div>

        <div id="search_result_for_program_mate_list" class=" row ">
            {{-- Each Account will sit in this --}}
            @foreach($user->zone()->users() as $mate)
                <div class="col-sm-4 col-md-3 mt-3">
                    {{-- If User is a Fresher --}}

                    {{-- @if($user->inactive_account_reason() == 'fresher') --}}
                    <div class="card text-white bg-info" data-toggle="" data-target="#myModal" >
                        <div class="card-body">
                            <div class="h1 text-muted text-right mb-4">
                                <i>
                                    <a href="{{route('view_profile', $mate)}}">
                                        <img src="{{$mate->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                                    </a>
                                </i>
                            </div>
                            {{-- <div class=" mb-0">{{$mate->created_at->diffInDays(now())}} Days Ago</div> --}}
                            <small class="text-uppercase font-weight-bold">Name: {{$mate->fullname()}}</small> <br>
                            <small class="text-uppercase font-weight-bold">Residence: {{$mate->residence()->name}}</small> <br>
                            {{-- <small class="text-uppercase font-weight-bold">Room: {{$mate->biodata->room ? $mate->biodata->room : "None" }}</small> <br> --}}

                            <small class="text-uppercase font-weight-bold">Phone: {{$mate->phone ? $mate->phone->body:"None"}}</small> <br>
                            <small class="text-uppercase font-weight-bold">whatsapp: {{$mate->whatsapp ? $mate->whatsapp->body:"None"}}</small> <br>
                            
                            @if($mate->roles != "[]")

                            <small class="text-uppercase font-weight-bold">Roles: 
                                @foreach($mate->roles as $role)
                                    {{$role->name.", "}}
                                @endforeach
                            </small> <br>

                            @endif
                            
                      
                        </div>
                    </div>
            
                    {{-- @endif --}}


                </div>
            @endforeach
        </div>

    </div>

</x-layout>
