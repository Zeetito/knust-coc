<x-layout>
      
        
        <div class="container-fluid">
                <div class="dashboard-container">
    
                    {{-- Each Whole Table Screen --}}
                    <div class="process-bar">
                        <div class="process-bar">
                            <div class="process-order">
                                <h3 style="text-align:center">Attendance Sessions</h3>
                                <span>
                                    <form >
                                        <input list="meetings" type="text" class="search_box" data-url="{{route('search_attendance')}}" placeholder="search name..." style="text-align:center;">
                                            <i class="fa fa-search"></i>
                                            <datalist id="meetings">
                                                @foreach(App\Models\Meeting::where('is_active','=',1)->get()->sortBy('name') as $meeting)
                                                    <option value ="{{$meeting->name}}">
                                                @endforeach
                                              </datalist>                                            
                                    </form>
                            </span>
                            </div>
    
                            {{-- Attendance Table --}}
                            <div class="pre-scrollable" >
    
                                    <div class="card-body">
                                            <table class="table table-striped">
                                                {{-- Table Head --}}
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Date</th>
                                                        <th>Venue</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                {{-- Table Body --}}
                                                <tbody class="search_result">
                                                   @foreach($attendances as $attendance)

                                                    <tr id="tr_{{$attendance->id}}">
                                                        <td>
                                                           {{$attendance->meeting->name}}
                                                        </td>
                                                        <td>{{$attendance->created_at->format('Y-M-d-D')}}</td>
                                                        <td> {{$attendance->venue}}</td>
                                                        <td> {{$attendance->is_active === 0 ? "Ended":"In Session"}}</td>
                                                        <td>
                                                            @can('view',$attendance)
                                                            {{-- View Attendance Session --}}
                                                             <a href="{{route('show_attendance',$attendance->id)}}">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            @endcan

                                                            {{-- Access Attendance Session --}}
                                                            <a href="{{route('access_attendance_session',$attendance->id)}}">
                                                                <i class="fa fa-key"></i>
                                                            </a>

                                                            @can('delete',$attendance)
                                                             {{-- Delete Attendance Session --}}
                                                             <a href="#">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                            @endcan

                                                            @can('update',$attendance)
                                                             {{-- Reset Attendance Session --}}
                                                             <a href="{{route('reset_attendance',$attendance->id)}}">
                                                                <i class="fa fa-undo"></i>
                                                            </a>
                                                            @endcan

                                                            <script>
                                                                    // Get the PHP variable $go and convert it to a JavaScript variable.
                                                                    var go = {{ $attendance->is_active }}; // Use 0 as a default value if $go is not set.
                                                                
                                                                    // Get a reference to the checkbox element by its ID.
                                                                    var checkbox = document.getElementById('{{$attendance->id}}');
                                                                    console.log(document.getElementById('{{$attendance->id}}'));
                                                                
                                                                            checkbox.checked = (go === 1);
                                                                      
                                                            </script>
                                                            
                                                                  <label class="switch switch-text switch-info-outline-alt">
                                                                  <input id="{{$attendance->id}}" data-url ="{{route('switch_attendance_session',$attendance->id)}}"   type="checkbox" class="toggle_button switch-input">
                                                                        <span class="switch-label" data-on="On" data-off="Off"></span>
                                                                        <span class="switch-handle"></span>
                                                                  </label>
                                                        </td>
                                                        {{-- <td>
                                                            <span class="badge badge-success">Active</span>
                                                        </td> --}}
                                                    </tr>
                                                  @endforeach

                                                </tbody>
                                                {{-- Table Body Ends --}}
                                            </table>
                                           
                                    </div>
                            
                             
                            </div>
                            {{--Users Table Ends--}}
    
                            {{$attendances->links()}}
                           
                        </div>
                    </div>
                    {{-- Whole Table Screen Ends --}}
    
                    {{-- Create new Attendance Session Div --}}

                   @include('attendance.create')
    
                </div> <!-- end of dashboard container -->
    
            </div>
            <!-- /.conainer-fluid -->
    
</x-layout>