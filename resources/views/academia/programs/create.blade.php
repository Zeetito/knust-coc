 {{-- @can('create,attendance') --}}
 <div class="card border-danger">

    <form action="{{route('store_program')}}" method="post">
            @csrf

            <div class="card-header">
                Adding New Program
            </div>


            <div class="card-body">

                    {{-- Type --}}
                    <div class="form-group">


                            {{-- Name of Program --}}
                            <label for="name">Name of Program </label>
                                    <input type="text" name="name" class="form-control" placeholder="Eg. BSC.Computer Science" required>
                            </select>
                            @error('name')
                            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                            @enderror

                            {{-- Select Type --}}
                            <label for="type">Type </label>
                            <select name="type" class="form-control"  id="type" required>
                                    <option value=" ">Select Type</option>
                                        <option value="ug">UnderGraduate</option>
                                        <option value="pg">PostGraduate</option>
                            </select>
                            @error('type')
                            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                            @enderror

                            {{-- Select College --}}
                            <label for="college_id">College </label>
                            <select name="college_id" class="form-control"  id="college_id" required>
                                    <option value=" ">Select College</option>
                                    @foreach(App\Models\College::all() as $college)
                                        <option value="{{$college->id}}">{{$college->name}}</option>
                                    @endforeach
                            </select>
                            @error('college_id')
                            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                            @enderror

                            {{-- Select Faculty --}}
                            <label for="faculty_id">Select Faculty (Optional) </label>
                            <select name="faculty_id" class="form-control"  id="faculty_id">
                                    <option value=" ">Select faculty</option>
                                    @foreach(App\Models\Faculty::all() as $faculty)
                                        <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                                    @endforeach
                            </select>
                            @error('faculty_id')
                            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                            @enderror
                            
                            {{-- Select Department --}}
                            <label for="department_id">Select Department (Optional) </label>
                            <input type="text" list="department_id" name="department_id" placeholder="Search Department name" class="form-control">
                            <datalist    id="department_id">
                                    <option value=" ">Select department</option>
                                        @foreach(App\Models\Department::all() as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach
                            </datalist>
                            @error('department_id')
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