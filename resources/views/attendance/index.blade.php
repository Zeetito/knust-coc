<x-layout>
      
        
        <div class="container-fluid">
                <div class="dashboard-container">
    
                    {{-- Each Whole Table Screen --}}
                    <div class="process-bar">
                        <div class="process-bar">
                            <div class="process-order">
                                <h3 style="text-align:center">Attendance Sessions</h3>
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
                                                <tbody>
                                                   @foreach($attendances as $attendance)

                                                    <tr id="tr_{{$attendance->id}}">
                                                        <td>
                                                           {{$attendance->meeting->name}}
                                                        </td>
                                                        <td>{{$attendance->created_at->format('Y-M-d-D')}}</td>
                                                        <td> {{$attendance->venue}}</td>
                                                        <td> {{$attendance->is_active === 0 ? "Ended":"In Session"}}</td>
                                                        <td>
                                                            {{-- View Attendance Session --}}
                                                             <a href="{{route('show_attendance',$attendance->id)}}">
                                                                <i class="fa fa-eye"></i>
                                                            </a>    
                                                            {{-- Delete Attendance Session --}}
                                                             <a href="#">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                            {{-- Access Attendance Session --}}
                                                            <a href="{{route('access_attendance_session',$attendance->id)}}">
                                                                <i class="fa fa-key"></i>
                                                            </a>

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