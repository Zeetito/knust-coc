<div class="">

    <div class="card-header">
        Add Participant - {{$special_program_residence->name}}
    </div>

    <div class="card-body">
            {{-- Form Here --}}
            <form action="{{route('store_special_program_residence_participant',['special_program_residence'=>$special_program_residence])}}" method="POST">
                @csrf
                {{-- firstname --}}
                <label for="firstname">Firstname</label>
                <input type="text" name="firstname" firstname="firstname" id="firstname" class="form-control mb-3" required>
                {{-- Name --}}
                <label for="lastname">Lastname</label>
                <input type="text" name="lastname" lastname="lastname" id="lastname" class="form-control mb-3" required>
                {{-- Name --}}
                <label for="othername">Othername</label>
                <input type="text" name="othername" othername="othername" id="othername" class="form-control mb-3" >

                {{-- Contact --}}
                <label for="contact">Active Contact</label><label class="text-danger"></label>
                <input type="text" name="contact" contact="contact" id="contact" class="form-control mb-3" required>
                
                {{-- Gender --}}
                <label for="name">Gender</label>
                <select class="form-control mb-3"  name="gender" id="gender" required>
                    <option value="">Select</option>
                    <option value="m">Male</option>
                    <option value="f">Female</option>
                </select>

                {{-- Room --}}
                <label for="room">Room</label>
                <select class="form-control mb-3" name="room" id="">
                    <option value="">Select</option>
                    @foreach($special_program_residence->rooms as $room)
                        <option value="{{$room->id}}">{{$room->name  ." - Gender: ". $room->gender}}</option>
                    @endforeach
                </select>
                {{-- Submit --}}
                <input type="submit" value="Submit" class="form-control btn btn-success mb-3">



            </form>
    </div>



</div> <!-- end of dashboard container -->