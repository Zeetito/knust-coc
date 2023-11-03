@foreach($programs as $program)
<tr id="tr_{{$program->id."_".$program->created_at}}">

    <td>{{$program->name}} </td>

    <td>
            {{$program->type == "ug" ? "UnderGraduate" : "PostGraduate"}}
    </td>

    @can('update',$college)

    <td>
        <a class="btn check_button btn-secondary" id="{{$program->id."_".$program->created_at}}" data-url="#">
            <i class="fa fa-eye"></i>
        </a>    
    </td>
    @endcan
</tr>
@endforeach