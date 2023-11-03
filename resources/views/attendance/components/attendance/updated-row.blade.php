<td>
        {{$attendance->meeting->name}}
     </td>
     <td>{{$attendance->created_at->format('Y-M-d-D')}}</td>
     <td> {{$attendance->venue}}</td>
     <td> {{$attendance->is_active === 0 ? "Ended":"In Session"}}</td>
     <td>
         @allowedTo(['view_attendance'])
         {{-- View Attendance Session --}}
          <a href="{{route('show_attendance_users',$attendance->id)}}">
             <i class="fa fa-eye"></i>
         </a>
         @endallowedTo

         {{-- Access Attendance Session --}}
         <a href="{{route('access_attendance_session',$attendance->id)}}">
             <i class="fa fa-key"></i>
         </a>

         @allowedTo(['delete_attendance'])
          {{--Confirm Delete Attendance Session --}}
          <span type="button" data-toggle="modal" data-target="#myModal" data-url="{{route("confirm_attendance_delete",["attendance"=>$attendance])}}" >
                 <i class="text-danger fa fa-trash"></i>
             </span> 
         @endallowedTo

         @allowedTo(['reset_attendance'])
          {{--Confirm Reset Attendance Session --}}
         <span type="button" data-toggle="modal" data-target="#myModal" data-url="{{route("confirm_attendance_reset",["attendance"=>$attendance])}}" >
             <i class="text-warning fa fa-repeat"></i>
         </span> 
         @endallowedTo

         {{-- <script>
                 // Get the PHP variable $go and convert it to a JavaScript variable.
                 var go = {{ $attendance->is_active }}; // Use 0 as a default value if $go is not set.
             
                 // Get a reference to the checkbox element by its ID.
                 var checkbox = document.getElementById('{{$attendance->id}}');
                 console.log(document.getElementById('{{$attendance->id}}'));
             
                         checkbox.checked = (go === 1);
                   
         </script> --}}
         @allowedTo(['update_attendance'])
               <label class="switch switch-text switch-info-outline-alt">
                 @if($attendance->is_active == 1)
                     <input type="checkbox"  class="switch-input" name="switch" id="{{$attendance->id}}" data-toggle="modal" data-target="#myModal" data-url ="{{route('confirm_attendance_switch',$attendance)}}" checked>
                             <span class="switch-label" data-on="On" data-off="Off"></span>
                             <span class="switch-handle"></span>
                     </label>
                 @else
                     <input type="checkbox"  class="switch-input" name="switch" id="{{$attendance->id}}" data-toggle="modal" data-target="#myModal" data-url ="{{route('confirm_attendance_switch',$attendance)}}" >
                             <span class="switch-label" data-on="On" data-off="Off"></span>
                             <span class="switch-handle"></span>
                     </label>
                 @endcan
               
         @endallowedTo
</td>