<form action="{{route('update_program_outline',['semesterProgram'=>$semesterProgram, 'programOutline'=>$programOutline->id])}}" method="post">
    @csrf
    @method('PUT')
        <div class="modal-title" id="myModalLabel">
            <span style=" ">
                    <h4 style="text-align:center">Confirm</h4>
        </div>
        <div class="modal-body">
            {{-- <p>Are you sure you want to <strong>delete</strong> the {{$programOutline->name}} Session ? </p> --}}

           {{-- Program Name --}}
           <div class="form-group">
            <label for="name">Session Name</label>
            <input required type="text" name="name" class="form-control" value="{{$programOutline->name}}" id="name">
        </div>
        @error('name')
        <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
        @enderror

        {{-- Comes After --}}   
        <div class="form-group">
            <label for="start_date">Comes After</label>
            <select required name="position" id="position"  calss="form-control">
                <option calss="form-control" value="{{$programOutline->position}}">Select</option>
                @foreach($semesterProgram->outline()->get() as $session)
                    <option value="{{($session->position + 1)}}">
                        {{$session->name}}
                    </option>
                @endforeach
                <option value=1>To the Top</option>
            </select>
        </div>
        @error('position')
        <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
        @enderror

        {{-- Start Time  Not required--}}
        <div class="form-group">
            <label for="start_time">Start Time</label>
            <input type="time"  name="start_time" class="form-control" value="{{old('start_time')}}" id="start_time">
        </div>
        @error('start_time')
        <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
        @enderror

    {{-- End Time  not required--}}
        <div class="form-group">
            <label for="end_time">End Date (Leave Empty If Same as Start Date) </label>
            <input type="time"  name="end_time" class="form-control" value="{{old('end_time')}}" id="end_time">
        </div>
        @error('end_time')
        <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
        @enderror

    {{-- Officiator Id --}}
    <div class="form-group">
        <h6>OFFICIATOR</h6>
            <label for="program_officiators">Select From Officiators</label>
            <input list="officiator_id" value="{{old('officiator_id',$programOutline->officiator_id)}}" class="search_box form-control" name="officiator_id" id="officiator_id_list"  autocomplete="off" placeholder="Search Name..." >
            <datalist id="officiator_id">
                        @foreach($semesterProgram->all_officiators() as $officiator)
                            <option value="{{$officiator['officiators_programs_id']}}">{{$officiator['name']}}</option>
                        @endforeach
            </datalist>


        

    </div>
    @error('officiator_id')
    <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
    @enderror

    </div>
    <div class="modal-footer">
        <input type="submit" name="submit_user" value="Save" class="form-control btn btn-secondary">  
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
    </div>                                  
</form>