<x-layout>
      
        <div class="">
            
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-toggle="tab"  role="tab" aria-controls="members">Members</button>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"  role="tab" aria-controls="residences">Residences</a>
                </li>
            </ul>

            <a href="{{route('zones')}}" class="btn  ml-2 btn-primary float-right">Back To Zones</a>
            @allowedTo(['add_residence'])
                <span class="btn btn-primary float-right" data-url="{{route('create_residence',['zone'=>$zone->id])}}" data-toggle="modal" data-target="#myModal" >Add New Residence</span>
            @endallowedTo
            
            
                
           
    
            {{-- Tab Div Begins --}}
            <div class="tab-content">

                {{-- Users Tab Begins --}}
                <div class="tab-pane active " id="members" role="tabpanel">
                    <div>
                        {{-- Table Caption --}}
                        <h4>Members In: {{$zone->name}}</h4>
                        <span style=" ">
                                <form >
                                    <input type="text" id="for_members_list" class="search_box" data-url="{{route("search_zone_members",['zone'=>$zone])}}" placeholder="search name..." style="text-align:center;">
                                        <i class="fa fa-search"></i>
                                </form>
                        </span>         
                    </div>

                    <div id="search_result_for_members_list" class=" row ">
                            {{-- Each Account will sit in this --}}
                        @foreach($zone->users() as $user)

                            <div class="col-sm-4 col-md-4 mt-3">
                                {{-- If User is Ill --}}
                                
                                    <a class="card text-white bg-primary">
                                        <div class="card-body">
                                            <div class="h1 text-muted text-right mb-4">
                                                <i>
                                                    <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                                                </i>
                                            </div>
                                            <small class="text-uppercase font-weight-bold">Name: {{$user->fullname()}}</small> <br>
                                            
                                            <small class="text-uppercase font-weight-bold">Status: {{$user->status()}}</small> <br>
                                            <small class="text-uppercase font-weight-bold">Residence: {{$user->residence()?  $user->residence()->name : "None"}}</small><br>
                                            
                                            @if($user->hasAnyRole())
                                            <small class="text-uppercase font-weight-bold">Roles: @foreach($user->roles as $role){{$role->name}}, @endforeach </small>
                                            
                                            @endif

                                            <div class="progress progress-white progress-xs mt-3">
                                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </a>
                            
                            </div>

                        @endforeach

                       

                    </div>
                </div>
                {{-- Users Tab Ends --}}
    
    
                {{-- Programs Tab Begins --}}
                <div class="tab-pane " id="residences" role="tabpanel">
                    <div>
                        <h4>Residence: {{$zone->name}}</h4>
                        <span style=" ">
                                <form >
                                    <input type="text" id="for_program_list" class="" placeholder="search program..." style="text-align:center;">
                                        <i class="fa fa-search"></i>
                                </form>
                        </span>         
                    </div>
                    <div class="">
                        <table class="table table-striped ">
                        
                            
                                {{-- Table Head --}}
                                <thead>
                                    <tr>
                                        <th>Residence Name</th>

                                        <th>Description</th>

                                        @allowedTo(['update_residence'])
                                        <th>Actions</th>
                                        @endallowedTo
                                    </tr>
                                </thead>
                                {{-- Table Body --}}
                                <tbody id="search_result_for_program_list">
                                    @foreach($zone->residences as $residence)
                                        <tr id="tr_{{$residence->id}}">

                                            <td>{{$residence->name}} </td>

                                            {{-- Program Type --}}
                                            <td>
                                                {{$residence->description}}
                                            </td>

                                            @allowedTo(['update_residence'])
                                            <td>
                                                <span class="btn  btn-secondary" data-toggle="modal" data-target="#myModal" data-url="{{route('edit_residence',['residence'=>$residence])}}">
                                                    <i class="fa fa-pencil"></i>
                                                </span>    
                                                <span class="btn  btn-secondary" data-toggle="modal" data-target="#myModal" data-url="{{route('delete_residence_confirm',['residence'=>$residence])}}">
                                                    <i class="fa fa-trash"></i>
                                                </span>    
                                            </td>
                                            @endallowedTo
                                        </tr>
                                    @endforeach
                                </tbody>
                                {{-- Table Body Ends --}}
                        </table>
                    </div>
                </div>
                {{-- Users Tab Ends --}}
    
    
                
                <div class="tab-pane" id="messages" role="tabpanel">
                    3Messagess. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                    dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
                
                {{-- Tab Div ends --}}
            </div>
        </div>
    
    </x-layout>