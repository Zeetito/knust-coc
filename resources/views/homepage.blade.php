<x-layout>
      
        
                    <div class="container-fluid">
                        <div class="dashboard-container">

                            {{-- Upcoming Programs --}}
                            <div class="card">
                                    <div class="process-order">
                                        <h3 style="text-align:center">Upcoming Programs</h3>
                                    </div>

                                    {{-- Progarm Items List --}}
                                    <div class=" " >
                                        {{-- Each Program Item --}}
                                        
                                        @if(App\Models\Semester::active_semester()->upcoming_programs == "[]" )

                                                        <h3>NO PROGRAMS TO SHOW</h3>

                                        @else
                                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                                    <ol class="carousel-indicators black">
                                                      @foreach(App\Models\Semester::active_semester()->upcoming_programs as $index => $semester_program)
                                                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
                                                      @endforeach
                                                    </ol>

                                                    <div class="carousel-inner">

                                                      @foreach(App\Models\Semester::active_semester()->upcoming_programs as $index => $semester_program) 
                                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                          @if( ($semester_program->images() !="[]" ))
                                                              <div class="bg-image" style= "background-image: url({{asset('storage/images/'.$semester_program->meeting->defaultImage->url)}});  height: 400px;    background-size: 100%; background-repeat: no-repeat;">
                                                          @else
                                                              <div class="bg-image" style= "background-image: url({{asset('storage/images/'.$semester_program->defaultImage())}});  height: 400px;    background-size: 100%; background-repeat: no-repeat;">
                                                          @endif
                                                                  <div class="text-uppercase text-white bg-info font-weight-bold h6" style="border-radius:15px; opacity:85%; padding:5px;">
                                                                      <span>Name: {{$semester_program->name}}</span> <br>
                                                                      <span>Date: {{$semester_program->start_date}}</span>
                                                                  <a href="{{route('show_semester_program',['semesterProgram' => $semester_program])}}">
                                                                      <span class=" bg-primary float-right">...See More<i class="fa fa-eye"></i></span>
                                                                  </a>
                                                                  </div>
                                                          </div>
                                                        </div>
                                                      @endforeach
                
                                                    </div>  
                                                    <a class="carousel-control-" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                      <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-" href="#carouselExampleIndicators" role="button" data-slide="next">
                                                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                      <span class="sr-only">Next</span>
                                                    </a>
                                                </div>

                                            {{-- @endforeach --}}

                                        @endif
                            
                                       
                                        {{-- Each Program Ends here --}}
                                    </div>
                                
                            </div>

                            {{-- Important Notice --}}
                            <div class="card">
                                <div class="process-order">
                                    <h3 style="text-align:center">Important Notices</h3>
                                    <span class="float-right"><i class="fa fa-bell"></i></span>
                                </div>
                            </div>

                            {{-- System Info --}}

                            {{-- Dashboard Item Ends --}}


                        </div> 
                    </div>
                    <!-- /.conainer-fluid -->
                
</x-layout>