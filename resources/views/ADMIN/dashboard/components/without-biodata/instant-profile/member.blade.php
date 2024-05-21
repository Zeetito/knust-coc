<form action="{{route('store_profile',['user'=>$user])}}" method="post" enctype="multipart/form-data" class="form-horizontal">

    @csrf
        <div class="modal-title" id="myModalLabel">
            <h5 style="text-align:center">Create Profile For Member - {{$user->name}}</h5>
        </div>

        <div class="modal-body form-group ">

         {{-- Status --}}
         <div class="mb-2">
            <h6>Status</h6>
            <select class="form-control" value="{{old('status')}}" name="status" id="status" required>
            
                <option value="">Select</option>
                <option value="student">Student</option>
                <option value="ns">Ns Personelle</option>
                <option value="other">Other</option>
            

            </select>
            {{-- <span class="help-block">Year</span> --}}
            {{-- Error Message --}}
                @error('status')
                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                @enderror
        </div>


        {{-- Residence Id --}}
         <div class="mb-2"> 
            <h6>Residence</h6>
            <input list="search_result_for_residence_list" autocomplete="off" id="for_residence_list" value="{{old('residence_id')}}"  data-url="{{route('profile_search_residences')}}" class=" search_box form-control" name="residence_id" id="residence" placeholder="Residence search..." >
            <datalist id="search_result_for_residence_list">
                @if(empty($residences))
                    <option>Search residence...</option>
                @else
            
                @foreach($residences as $residence)
                    <option value="{{$residence->name}}">{{$residence->zone->name}}</option>
                @endforeach

                @endif
                </datalist>

        </div>


        {{-- Room --}}
            {{-- <label class="col-md-3 mb-4 form-control-label" for="text-input">First Name</label> --}}
            <div class="mb-2">
                <h6>Room Number</h6>
                <input type="text"  value="{{old('room')}}" name="room" class="form-control" placeholder="Room">
                    {{-- <span class="help-block">Room</span> --}}
                    {{-- Error Message --}}
                    @error('room')
                    <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                    @enderror
            </div>





        {{-- Program Id --}}
        <div class="mb-2">
            <h6>Program Of Study</h6>
            <input list="search_result_for_program_list" data-url="{{route('profile_search_programs')}}" value="{{old('program_id')}}" autocomplete="off" class="search_box form-control" name="program_id" id="for_program_list" placeholder="Search Program..." >
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

         {{-- Year --}}
         <div class="mb-2">
            <h6>Year</h6>
            <select class="form-control" value="{{old('year')}}" name="year" id="years">
            
                {{-- <option value="{{$user->year()}}" >{{$user->year()}}</option> --}}
                <option value="">Select</option>
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

        <div class="mb-2">
            <input type="submit" value="Create" class="btn btn-success">
        </div>

        
</form>

