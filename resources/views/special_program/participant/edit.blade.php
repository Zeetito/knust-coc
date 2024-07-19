<div class="">

    <div class="card-header">
        Edit Participant - {{$participant->special_program->name}}
    </div>

    <div class="card-body">
            {{-- Form Here --}}
            <form action="{{route('update_special_program_participant',['special_program_participant'=>$participant])}}" method="POST">
                @csrf
                @method('PUT')

                <label for="congregation">Congregation</label>
                <input list="congregations" type="text" value="{{$participant->congregation ? $participant->congregation : " "}}" name="congregation" id="congregation" class="form-control mb-3" required>
                
                <datalist id="congregations">
                        <option value="KNUST">
                        <option value="UCC">
                        <option value="Safari">
                        <option value="Opera">
                        <option value="Edge">
                </datalist>


                {{-- firstname --}}
                <label for="firstname">Firstname</label>
                <input type="text"value="{{$participant->firstname ? $participant->firstname : " "}}" name="firstname" id="firstname" class="form-control mb-3" required>

                {{-- lastname --}}
                <label for="lastname">Lastname</label>
                <input type="text"value="{{$participant->lastname ? $participant->lastname : " "}}" name="lastname" id="lastname" class="form-control mb-3" required>

                {{-- othername --}}
                <label for="othername">Othername</label>
                <input type="text"value="{{$participant->othername ? $participant->othername : " "}}" name="othername" id="othername" class="form-control mb-3">
                
                {{-- gender --}}
                <label for="gender">Gender</label><label class="text-danger"></label>
                <select class="form-control mb-3"value="{{$participant->gender ? $participant->gender : " "}}" name="gender" id="">
                    <option value="">Select</option>
                    <option value="m">Male</option>
                    <option value="f">Female</option>
                </select>

                {{-- activeContact --}}
                <label for="phone">Active Contact</label><label class="text-danger"></label>
                <input type="text"value="{{$participant->phone ? $participant->phone : " "}}" name="phone" id="phone" class="form-control mb-3" required>

                <hr class="form-control">

                {{-- Residence --}}
                <label for="residence">Residence</label><label class="text-danger"></label>
                <select class="form-control mb-3 fetch_list" data-target="room" data-url="{{route('get_special_program_room_list',['special_program'=>$participant->special_program->id])}}" name="residence" id="residence">
                    <option value="">Select</option>
                    @foreach($participant->special_program->residences as $residence)
                        <option value="{{$residence->id}}" {{$participant->residence_id == $residence->id ? "selected" : ""}}>{{$residence->name  ." - Gender: ". $residence->gender}}</option>
                    @endforeach
                </select>

                {{-- Room --}}
                {{-- <label for="room">Room</label><label class="text-danger"></label>
                <select class="form-control mb-3" name="room" id="room">
                    <option value="">Select Residence First</option>
                </select> --}}
                <label for="room">Room</label>
                <input type="text" name="room" class="form-control mb-3">
                


                {{-- Submit --}}
                <input type="submit" value="Submit" class="form-control btn btn-success mb-3">


            </form>
    </div>



</div> <!-- end of dashboard container -->