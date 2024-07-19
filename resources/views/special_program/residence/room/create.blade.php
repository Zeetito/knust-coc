<div class="">

    <div class="card-header">
        Add Room - {{$special_program_residence->name}}
    </div>

    <div class="card-body">
            {{-- Form Here --}}
            <form action="{{route('store_special_program_residence_room',['special_program_residence'=>$special_program_residence])}}" method="POST">
                @csrf
                {{-- Name --}}
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control mb-3" required>
                
                {{-- Floor --}}
                <label for="floor">Floor</label>
                <select class="form-control mb-3" name="floor" id="floor">
                    <option value="">Select</option>
                    <option value="first">first</option>
                    <option value="second">second</option>
                    <option value="third">third</option>
                    <option value="fourth">fourth</option>
                    <option value="fifth">fifth</option>
                </select>

                {{-- Size --}}
                <label for="size">Size</label>
                <select class="form-control mb-3" name="size" id="size">
                    <option value="">Select</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>

                </select>
        

                {{-- Submit --}}
                <input type="submit" value="Submit" class="form-control btn btn-success mb-3">



            </form>
    </div>



</div> <!-- end of dashboard container -->