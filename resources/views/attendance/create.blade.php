 {{-- @can('create,attendance') --}}
 <div class="card border-danger">

        <form action="{{route('create_attendance')}}" method="post">
                @csrf

                <div class="card-header">
                    Create New Attendance Session
                </div>


                <div class="card-body">

                        {{-- Type --}}
                        <div class="form-group">

                                <label for="semester_program_id">Semester Program </label>
                                <select name="semester_program_id" class="form-control"  id="semester_programs">
                                        <option value=" ">Select Program</option>
                                        @foreach(App\Models\Semester::active_semester()->upcoming_programs as $semester_program)
                                            <option value="{{$semester_program->id}}">{{$semester_program->name." -".now()->diffInDays($semester_program->start_date)." Days"}}</option>
                                        @endforeach
                                </select>
                                @error('semester_program_id')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror

                                <label for="meeting_id">Meeting Type</label>
                                <select class="form-control" name="meeting_id" required id="meeting_id">
                                        <option value="">Select</option>
                                        @foreach(App\Models\Meeting::all() as $meeting)
                                                <option value="{{$meeting->id}}">{{$meeting->name}}</option>
                                        @endforeach
                                </select>
                                @error('meeting_id')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror

                        </div>

                </div>

              
                    

                <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Create</button>
                </div>

            </form>

</div>
    {{-- @endcan --}}