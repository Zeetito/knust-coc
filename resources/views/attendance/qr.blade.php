<x-guest_layout>

    <div class="mobilename">

        <input type="text" id="attendance_id" value="{{$attendance->id}}" hidden>
        <input type="text" id="user_id" value="{{auth()->user()->id}}" hidden>

        <input id="text" type="text" hidden value="{{route('check_user',['attendance'=>$attendance->id, 'user'=>auth()->user()->id ])}}" style="width:80%" /><br />
        <div class="container" id="qrcode">
        </div>

    </div>


</x-guest_layout>