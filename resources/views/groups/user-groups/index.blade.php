<x-layout>
        
    <div class="container-fluid">
            <div class="dashboard-container">

                {{-- Each Whole Table Screen --}}
                <div class="process-bar">
                    <div class="process-bar">
                        <div class="process-order">
                            <h3 style="text-align:center">These Are Groups you belong To</h3>
                            {{-- Search Program bar --}}
                            <span>
                                <form >
                                    {{-- <input type="text" id="for_semester_program_list" class="search_box" data-url="#" placeholder="search name..." style="text-align:center;"> --}}
                                        {{-- <i class="fa fa-search"></i> --}}
                                </form>
                            </span>
                            {{-- <span> --}}
                                {{-- <form > --}}
                                    {{-- <select type="text" id="_for_semester_program_list" class="filter_box" data-url="{{route('filter_semester_programs')}}" placeholder="search name..." style="text-align:center;">     --}}
                                        {{-- <option>
                                            Filter By
                                        </option> --}}
                                        {{-- A list of all semesters in from now to the past --}}

                                        {{-- @foreach(App\Models\AcademicYear::orderByDesc('start_year')->get() as $academic_year)
                                            @foreach($academic_year->semesters->sortByDesc('name') as $semester)
                                                    <option value={{$semester->id}}>
                                                        {{$academic_year->start_year."-".$academic_year->end_year." Sem ".$semester->name}}
                                                    </option>
                                            @endforeach
                                        @endforeach --}}

                                    {{-- </select>         --}}
                                    {{-- <i class="fa fa-filter"></i> --}}
                                         {{--  --}}
                                {{-- </form> --}}
                            {{-- </span> --}}

                            {{-- New Semester Program Button --}}
                            {{-- @allowedTo(['create_attendance']) --}}
                            <span class="btn btn-info float-right mb-2" data-toggle="modal" data-target="#myModal" data-url="{{route('add_semester_program')}}" >
                                Create Group
                            </span>
                            {{-- @endallowedTo --}}

                        </div>

                        {{-- Attendance Table --}}
                        <div class="" >

                                <div class="card-body">
                                    @if($user->groups != "[]")
                                        <table class="table table-striped">
                                            {{-- Table Head --}}
                                            <thead>
                                                <tr>
                                                    <th>Group Name</th>
                                                    {{-- <th>End Date</th> --}}
                                                    {{-- <th>Status</th> --}}
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            {{-- Table Body --}}
                                                    <tbody id="search_result_for_semester_program_list">
                                                    @foreach($user->groups as $group)

                                                        <tr id="tr_{{$group->id}}">
                                                            <td>
                                                            {{$group->name}}
                                                            </td>

                                                            <td>
                                                                {{-- View Attendance Session --}}
                                                                <a title="View" href="{{route('show_group',['group'=> $group])}}">
                                                                    <i class="fa fa-key"></i>
                                                                </a>
                                                                
                                                                @if(auth()->user()->is_admin_for($group))
                                                                <span title="Edit Group" data-toggle="modal" data-target="#myModal" data-url="{{route('edit_group',['group'=>$group])}}"  >
                                                                    <i class="fa fa-pencil"></i>
                                                                </span>
                                                                @endif

                                                                @if(auth()->user()->is_creator_for($group))
                                                                <span title="Delete Group" data-toggle="modal" data-target="#myModal" data-url="{{route('confirm_group_delete',['group'=>$group])}}"  >
                                                                    <i class="fa fa-trash"></i>
                                                                </span>
                                                                @endif


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
                                    No Groups to Show
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