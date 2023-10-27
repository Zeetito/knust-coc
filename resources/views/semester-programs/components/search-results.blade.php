@foreach($semester_programs as $semester_program)

    <tr id="tr_{{$semester_program->id}}">
        <td>
        {{$semester_program->name}}
        </td>
        <td>{{$semester_program->get_start_date()->format('Y-M-d-D')}}</td>
        
        <td>{{$semester_program->get_end_date()->format('Y-M-d-D')}}</td>
        
        <td>{{$semester_program->academic_period()}}</td>
        
        <td> {{$semester_program->venue}}</td>
        <td>
            {{-- View Attendance Session --}}
            <a href="{{route('show_attendance_users',$semester_program->id)}}">
                <i class="fa fa-eye"></i>
            </a>

        </td>
        {{-- <td>
            <span class="badge badge-success">Active</span>
        </td> --}}
    </tr>
@endforeach