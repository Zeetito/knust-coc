<x-layout>
        
    <div class="container-fluid">
            <div class="dashboard-container">

                {{-- Each Whole Table Screen --}}
                <div class="process-bar">
                    <div class="process-bar">
                        <div class="process-order">
                            <h3 style="text-align:center">Pending Invites</h3>
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

                        </div>

                        {{-- Attendance Table --}}
                        <div class="" >

                                <div class="card-body">
                                    @if($user->invites != "[]")
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
                                                    @foreach($user->invites as $invite)

                                                        <tr id="tr_{{$invite->id}}">
                                                            <td>
                                                            {{$invite->name}}
                                                            </td>

                                                            <td>
                                                                {{-- View Attendance Session --}}
                                                                <span class="btn" data-toggle="modal" data-target="#myModal" data-url="{{route('handle_invite_form',['user'=>$user, 'group'=>$invite])}}">
                                                                    <i title="Respond" class="fa fa-reply"></i>
                                                                </span>

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
                                    No Invites to Show
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