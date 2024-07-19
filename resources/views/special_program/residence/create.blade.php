<div class="">

    <div class="card-header">
        Add Residence - {{$special_program->name}}
    </div>

    <div class="card-body">
            {{-- Form Here --}}
            <form action="{{route('store_special_program_residence',['special_program'=>$special_program])}}" method="POST">
                @csrf
                {{-- Name --}}
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control mb-3" required>
                
                {{-- StartDate --}}
                <label for="location">Location-Link</label>
                <input type="text" location="location" name="location" id="location" class="form-control mb-3" >
        

                {{-- Submit --}}
                <input type="submit" value="Submit" class="form-control btn btn-success mb-3">



            </form>
    </div>



</div> <!-- end of dashboard container -->