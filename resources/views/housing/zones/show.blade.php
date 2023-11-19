<x-layout>
      
        <div class="container">
            
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-toggle="tab"  role="tab" aria-controls="members">Members</button>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab"  role="tab" aria-controls="residences">Residences</a>
                </li>
            </ul>
    
            
            
                
           
    
            {{-- Tab Div Begins --}}
            <div class="tab-content">

                {{-- Users Tab Begins --}}
                <div class="tab-pane active pre-scrollable " id="members" role="tabpanel">
                    <div>
                        {{-- Table Caption --}}
                        <h4>Members In: {{$zone->name}}</h4>
                        <span style=" ">
                                <form >
                                    <input type="text" id="for_members_list" class="search_box" data-url="#" placeholder="search name..." style="text-align:center;">
                                        <i class="fa fa-search"></i>
                                </form>
                        </span>         
                    </div>
                    <div>
                        <table class="table table-striped">
                            
        
                                {{-- Table Head --}}
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        
                                        <th>Residence</th>

                                </thead>
                                {{-- Table Body --}}
                                <tbody id="search_result_for_members_list">
                                    @foreach($zone->users() as $member)
                                        <tr id="tr_{{$member->id}}">
                                        
                                            {{-- Name And Avatar--}}
                                        
                                            <td>
                                                <a >
                                                    <img src="{{$member->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                                                </a>
                                                {{$member->fullname()}}
                                            </td>

                                            {{-- Risidence --}}
                                            <td>
                                                {{$member->biodata != null ? $member->biodata->residence->name : "No Residence"}}
                                            </td>

        
                                            {{-- Action  --}}
                                         
        
                                        </tr>
                                    @endforeach
                                </tbody>
                                {{-- Table Body Ends --}}
                        </table>

                    </div>
                </div>
                {{-- Users Tab Ends --}}
    
    
                {{-- Programs Tab Begins --}}
                <div class="tab-pane " id="residences" role="tabpanel">
                    <div>
                        <h4>Residence: {{$zone->name}}</h4>
                        <span style=" ">
                                <form >
                                    <input type="text" id="for_program_list" class="search_box" data-url="#" placeholder="search program..." style="text-align:center;">
                                        <i class="fa fa-search"></i>
                                </form>
                        </span>         
                    </div>
                    <div class="pre-scrollable">
                        <table class="table table-striped ">
                        
                            
                                {{-- Table Head --}}
                                <thead>
                                    <tr>
                                        <th>Residence Name</th>

                                        <th>Zone</th>

                                        @allowedTo(['update_zone'])
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
                                                {{$residence->zone->name}}
                                            </td>

                                            @allowedTo(['update_zone'])
                                            <td>
                                                <a class="btn check_button btn-secondary" id="{{$residence->id}}" data-url="#">
                                                    <i class="fa fa-eye"></i>
                                                </a>    
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