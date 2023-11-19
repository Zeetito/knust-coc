<x-layout>

    <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>User Profile</strong>
                    
                </div>
                <div class="card-body">

                    <form action="{{route('update_profile',['user'=>$user])}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            @method('put')
                            {{-- UserName --}}
                            <div class="form-group row">
                                {{-- <label class="col-md-3 form-control-label">Hello</label> --}}
                                <div class="col-md-6">
                                    <p class="form-control-static">Hello {{$user->username}} Help us know more about you</p>
                                </div>
                            </div>

                            <div class="form-group row">
                            

                                {{-- Other Name --}}
                                {{-- <label class="col-md-3 form-control-label" for="text-input">First Name</label> --}}
                                {{-- <div class="col-md-3 mb-4">
                                    <input type="text"  value="{{old('othername')}}" name="othername" class="form-control" placeholder="Other Name">
                                        {{-- <span class="help-block">Other Name</span> --}}
                                        {{-- Error Message --}}
                                        {{-- @error('othername') --}}
                                        {{-- <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p> --}}
                                        {{-- @enderror --}}
                                {{-- </div> --}}

                            {{-- Program List for Each College --}}
                                {{-- Program Id --}}
                                <div class="col-md-3 mb-4">
                                    <h6>Program Of Study</h6>
                                    <input list="search_result_for_program_list" data-url="{{route('profile_search_programs')}}" value="{{old('program_id',$user->program()->name)}}" autocomplete="off" class="search_box form-control" name="program_id" id="for_program_list" placeholder="Search Program..." >
                                        <datalist id="search_result_for_program_list">
                                            @if(empty($programs))
                                                <option>Search Program</option>
                                            @else
                                                @foreach($programs as $program)
                                                    <option value="{{$program->id}}"> {{$program->name}} </option>
                                                @endforeach
        
                                            @endif
                                        </datalist>
                                    {{-- <span class="help-block">Residence</span> --}}
        
                                </div>

                                {{-- Zone Id --}}
                                <div class="col-md-3 mb-4">
                                    <h6>Zone</h6>
                                        <select class="form-control" name="zone_id" id="zones">
                                            <option value="">SELECT ZONE</option>
                                            @foreach(App\Models\Zone::all() as $zone)
                                            <option value="{{$zone->id}}"> {{$zone->name}} </option>
                                        @endforeach
                                        </select>
                                    {{-- <span class="help-block">Zone</span> --}}
                                    {{-- Error Message --}}
                                        @error('zone_id')
                                        <p class='m=0 small alert alert-danger shadow-sm'>{{"You Must Select A Zone"}}</p>
                                        @enderror
                                </div>

                                {{-- Year --}}
                                <div class="col-md-3 mb-4">
                                    <h6>Year</h6>
                                <select class="form-control" value="{{old('year',$user->year())}}" name="year" id="years">
                                    
                                    <option value="{{$user->year()}}" >{{$user->year()}}</option>
                                            @for($i=1; $i<=8; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor

                                        </select>
                                    {{-- <span class="help-block">Year</span> --}}
                                    {{-- Error Message --}}
                                        @error('year')
                                        <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                        @enderror
                                </div>

                                {{-- Residence List for Each Zone --}}
                                {{-- Residence Id --}}
                                <div class="col-md-3 mb-4">
                                    <h6>Residence</h6>
                                    <input list="search_result_for_residence_list" autocomplete="off" id="for_residence_list" value="{{old('residence_id',$user->residence()->name)}}"  data-url="{{route('profile_search_residences')}}" class=" search_box form-control" name="residence_id" id="residence" placeholder="Residence search..." >
                                    <datalist id="search_result_for_residence_list">
                                        @if(empty($residences))
                                            <option>Search residence...</option>
                                        @else
                                    
                                        @foreach($residences as $residence)
                                            <option value="{{$residence->name}}">{{$residence->zone->name}}</option>
                                        @endforeach

                                        @endif
                                        </datalist>
                                    {{-- <span class="help-block">Residence</span> --}}

                                </div>

                                {{-- Room --}}
                                {{-- <label class="col-md-3 mb-4 form-control-label" for="text-input">First Name</label> --}}
                                <div class="col-md-3 mb-4">
                                    <h6>Room Number</h6>
                                    <input type="text"  value="{{old('room',$user->room())}}" name="room" class="form-control" placeholder="Room">
                                        {{-- <span class="help-block">Room</span> --}}
                                        {{-- Error Message --}}
                                        @error('room')
                                        <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                        @enderror
                                </div>

                            </div>
                        
                            

                        {{-- Upload Profile Pic Option --}}
                            <div class="form-group row">
                                {{-- <label class="col-md-3 mb-4 form-control-label" for="file-input">File input</label> --}}
                                <a href="{{route('edit_avatar_form',$user->id )}} ">
                                    <div class="btn col-md-9">
                                    Change Avatar
                                    </div>
                                </a>
                            </div>
                            <button type="submit" name="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Save changes</button>
                        
                    </form>
                </div>
                <div class="card-footer">
                    {{-- <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button> --}}
                </div>
            </div>

       
        </div>
   
</x-layout>