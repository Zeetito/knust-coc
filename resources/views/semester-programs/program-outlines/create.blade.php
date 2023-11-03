<x-layout>
      
    <div class="container">

        <div class="card border-danger">

            <form action="{{route('store_program_outline',['semesterProgram'=>$semesterProgram])}}" method="post">
                    @csrf

                    <div class="card-header">
                        Create Sessions for <strong>{{$semesterProgram->name}}</strong>
                    </div>

                    <div class="card-body form-group">
                        
                                {{-- Program Name --}}
                                <div class="form-group">
                                        <label for="name">Session Name</label>
                                        <input required type="text" name="name" class="form-control"  id="name" placeholder="Session Name">
                                </div>
                                @error('name')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror

                                {{-- Comes After --}}   
                                <div class="form-group">
                                    <label for="start_date">Comes After</label>
                                    <select required name="position" id="position" calss="form-control">
                                        <option class="btn-info form-control" value="{{$semesterProgram->outline()->latest()->first()->position + 1}}">{{$semesterProgram->outline()->latest()->first()->name}}</option>
                                        @foreach($semesterProgram->outline()->get() as $session)
                                            <option value="{{($session->position + 1)}}">
                                                {{$session->name}}
                                            </option>
                                            @endforeach
                                        <option class="btn-info" value=1>To the Top</option>
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
                                    <input list="officiator_id" value="{{old('officiator_id_id')}}" class="search_box form-control" name="officiator_id" id="officiator_id_list"  autocomplete="off" placeholder="Search Name..." >
                                    <datalist id="officiator_id">
                                                @foreach($semesterProgram->all_officiators() as $officiator)
                                                    <option value="{{$officiator['officiator_id']}}">{{$officiator['name']}}</option>
                                                @endforeach
                                    </datalist>

                            
                                

                            </div>
                            @error('officiator_id')
                            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                            @enderror




                    </div>

                
                        

                    <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Create</button>
                    </div>

            </form>

        </div>
    </div>

</x-layout>
