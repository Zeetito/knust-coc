 {{-- @can('create,attendance') --}}
 <div class="card border-danger">

        <form action="{{route('create_semester_program')}}" method="post">
                @csrf

                <div class="card-header">
                    Create Semester Program
                </div>


                <div class="card-body">
                       
                            {{-- Program Name --}}
                            <div class="form-group">
                                    <label for="name">Program Name</label>
                                    <input required type="text" name="name" class="form-control"  id="name" placeholder="Program Name">
                            </div>
                            @error('name')
                            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                            @enderror

                        {{-- venue --}}
                           <div class="form-group">
                                <label for="venue">Venue</label>
                                <input type="text" name="venue" class="form-control" value="{{old('venue','Unity Hall Basement')}}" id="venue" placeholder="What's The Venue">
                            </div>
                            @error('venue')
                            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                            @enderror

                        {{-- Related Ministry --}}


                        {{-- Start Date  required--}}
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="datetime-local" required name="start_date" class="form-control" value="{{old('start_date')}}" id="start_date">
                            </div>
                            @error('start_date')
                            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                            @enderror

                        {{-- End Date  not required--}}
                            <div class="form-group">
                                <label for="end_date">End Date (Leave Empty If Same as Start Date) </label>
                                <input type="datetime-local"  name="end_date" class="form-control" value="{{old('end_date')}}" id="end_date">
                            </div>
                            @error('end_date')
                            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                            @enderror





                </div>

              
                    

                <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Create</button>
                </div>

        </form>

    </div>
    {{-- @endcan --}}