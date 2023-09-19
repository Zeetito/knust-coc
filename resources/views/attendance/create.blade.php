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
                                <label for="venue">Type Of Gathering</label>
                                <select id="select" name="meeting_type" class="form-control">
                                    <option value=" ">Please select</option>

                                    @foreach($meetings as $meeting)
                                    <option value="{{$meeting->id}}">{{$meeting->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            @error('meeting_type')
                            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                            @enderror
                         {{-- Venue --}}
                           <div class="form-group">
                                <label for="venue">Venue</label>
                           <input type="text" name="venue" class="form-control" value="{{old('venue','Unity Hall Basement')}}" id="venue" placeholder="What's this Session for ? eg: Sunday Service">
                            </div>
                            @error('venue')
                            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                            @enderror
                </div>

              
                    

                <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Create</button>
                </div>

            </form>

        </div>
    {{-- @endcan --}}