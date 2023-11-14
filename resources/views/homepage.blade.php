<x-layout>
      
        
                    <div class="container-fluid">
                        <div class="dashboard-container">

                            {{-- Each DashBoard Item --}}
                            <div class="process-bar-container">
                                <div class="process-bar">
                                    <div class="process-order">
                                        <h3 style="text-align:center">Upcoming Programs</h3>
                                    </div>

                                    {{-- Progarm Items List --}}
                                    <div class="pre-scrollable" >
                                        {{-- Each Program Item --}}
                                        
                                        @if(App\Models\Semester::active_semester()->upcoming_programs == null )

                                                        <h3>NO PROGRAMS TO SHOW</h3>

                                        @else

                                            @foreach(App\Models\Semester::active_semester()->upcoming_programs as $semester_program )
                                                <div class="container">
                                                    <div class="bg-Primary" >
                                                            <h3>{{$semester_program->name }}</h3>
                                                            <h3>{{$semester_program->academic_period() }}</h3>
                                                            <h3>From:{{$semester_program->start_date }} </h3>
                                                            <h3>to:{{$semester_program->end_date }} </h3>
                                                            <h3>Venue:{{$semester_program->venue }} </h3>
                                                            <a class="" href="{{route('show_semester_program',['semesterProgram'=>$semester_program])}}">
                                                                <p>More Info</p>
                                                                <hr class="warning">
                                                            </a>
                                                    </div>
                                                </div>
                                            @endforeach

                                        @endif
                            
                                       
                                        {{-- Each Program Ends here --}}
                                    </div>
                                    {{-- Program Item List Ends here --}}
                                    <div class="process-billing">
                                        <h3>Upcoming Programs</h3>
                                    </div>
                                </div>
                            </div>
                            {{-- Dashboard Item Ends --}}

                            {{-- Info About Program --}}
                            <div class="process-view-container program_info">
                                <p style="font-weight:bolder">
                                    See Project Info here
                                </p>
                               
                            </div>
                            {{-- Info About Program Ends --}}

                        </div> <!-- end of dashboard container -->
        
                    </div>
                    <!-- /.conainer-fluid -->
                
</x-layout>