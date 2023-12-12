<x-layout>
        
        <div class="card">
                <div class="">
    
                    {{-- Each Whole Table Screen --}}
                    <div class="process-bar">
                        <div class="process-bar">
                            <div class="process-order">
                                <h3 style="text-align:center">Programs for the Semester</h3>
                                {{-- Search Program bar --}}
                                <span>
                                    <form >
                                        {{-- <input type="text" id="for_semester_program_list" class="search_box" data-url="#" placeholder="search name..." style="text-align:center;"> --}}
                                            {{-- <i class="fa fa-search"></i> --}}
                                    </form>
                                </span>
                                <span>
                                    <form >
                                        <select type="text" id="_for_semester_program_list" class="filter_box" data-url="{{route('filter_semester_programs')}}" placeholder="search name..." style="text-align:center;">    
                                            {{-- <option>
                                                Filter By
                                            </option> --}}
                                            {{-- A list of all semesters in from now to the past --}}

                                            @foreach(App\Models\AcademicYear::orderByDesc('start_year')->get() as $academic_year)
                                                @foreach($academic_year->semesters->sortByDesc('name') as $semester)
                                                        <option value={{$semester->id}}>
                                                            {{$academic_year->start_year."-".$academic_year->end_year." Sem ".$semester->name}}
                                                        </option>
                                                @endforeach
                                            @endforeach

                                        </select>        
                                        <i class="fa fa-filter"></i>
                                             
                                    </form>
                                </span>

                                {{-- New Semester Program Button --}}
                                @allowedTo(['create_attendance'])
                                <span class="btn btn-info float-right mb-2" data-toggle="modal" data-target="#myModal" data-url="{{route('add_semester_program')}}" >
                                    New Semester Program
                                </span>
                                @endallowedTo

                            </div>
    
                            {{-- Attendance Table --}}
                            <div class="" >
    
                                    <div class="card-body">
                                        @if($semester_programs != null)
                                            <table class="table table-striped">
                                                {{-- Table Head --}}
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Date</th>
                                                        {{-- <th>End Date</th> --}}
                                                        {{-- <th>#</th> --}}
                                                        <th>Venue</th>
                                                        {{-- <th>Status</th> --}}
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                {{-- Table Body --}}
                                                        <tbody id="search_result_for_semester_program_list">
                                                        @foreach($semester_programs->orderByDesc('start_date')->get() as $semester_program)

                                                            <tr id="tr_{{$semester_program->id}}">
                                                                <td>
                                                                {{$semester_program->name}}
                                                                </td>
                                                                <td>{{$semester_program->get_start_date()->format('Y-M-d-D')}}</td>
                                                                
                                                                {{-- <td>{{$semester_program->get_end_date()->format('Y-M-d-D')}}</td> --}}
                                                                
                                                                {{-- <td>{{$semester_program->academic_period()}}</td> --}}
                                                                
                                                                <td> {{$semester_program->venue}}</td>
                                                                <td>
                                                                    {{-- View Attendance Session --}}
                                                                    <a href="{{route('show_semester_program',['semesterProgram'=> $semester_program])}}">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>

                                                                </td>
                                                                {{-- <td>
                                                                    <span class="badge badge-success">Active</span>
                                                                </td> --}}
                                                            </tr>
                                                        @endforeach

                                                        </tbody>
                                                {{-- Table Body Ends --}}
                                            </table>
                                            
                                        @else
                                        No Programs To show
                                        @endif

                                    </div>
                            
                             
                            </div>
                            {{--Users Table Ends--}}
    
                            {{-- {{$semester_programs->links()}} --}}
                           
                        </div>
                    </div>
                    {{-- Whole Table Screen Ends --}}
    

    
                </div> <!-- end of dashboard container -->
    
            </div>
            <!-- /.conainer-fluid -->
    
</x-layout>