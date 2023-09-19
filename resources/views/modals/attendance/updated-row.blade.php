
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
            {{-- @if($attendance->is_active === 1)
                <script>
                    var value = '$value'
                    document.getElementById("session_checkbox"+value).setAttribute("checked", "checked");
                </script>
            @else
                <script>
                        document.getElementById("session_checkbox"+"$attendance->is_active").removeAttribute("checked");
                </script>
                @endif
                --}}

                    <script>
                        // Get the PHP variable $go and convert it to a JavaScript variable.
                        var go = {{ $attendance->is_active }}; // Use 0 as a default value if $go is not set.
                        var id = {{$attendance->id}}
                    
                        // Get a reference to the checkbox element by its ID.
                        var checkbox = document.getElementById(id);
                    
                        // Set the checked property based on the value of the JavaScript variable.
                        checkbox.checked = (go === 1);
                    </script>
               
                
                <label class="switch switch-text switch-info-outline-alt">
                <input id="{{$attendance->id}}" data-url ="{{route('switch_attendance_session',$attendance->id)}}"   type="checkbox" class="toggle_button switch-input">
                        <span class="switch-label" data-on="On" data-off="Off"></span>
                        <span class="switch-handle"></span>
                    </label>
        </td>
         {{-- <td> --}}
            {{-- <span class="badge badge-success">Active</span> --}}
        {{-- </td>  --}}
