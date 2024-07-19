<x-layout>
        
    <div class="card">
            <div class="">

                <div class="card-header">
                    App participant - {{$special_program->name}}

                    <a href="{{route('special_program_participants',['special_program'=>$special_program->id])}}" class="float-end btn btn-info">
                        All Participants
                    </a>

                </div>

                <div class="card-body">
                        {{-- Form Here --}}
                        <form action="{{route('store_special_program_participant',['special_program'=>$special_program])}}" method="POST">
                            @csrf

                            <label for="congregation">Congregation</label>
                            <input list="congregations" type="text" value="{{ old('congregation') }}" name="congregation" id="congregation" class="form-control mb-3" required>
                            
                            <datalist id="congregations">
                                    <option value="KNUST">
                                    <option value="UCC">
                                    <option value="Safari">
                                    <option value="Opera">
                                    <option value="Edge">
                            </datalist>


                            {{-- firstname --}}
                            <label for="firstname">Firstname</label>
                            <input type="text" name="firstname" id="firstname" class="form-control mb-3" required>

                            {{-- lastname --}}
                            <label for="lastname">Lastname</label>
                            <input type="text" name="lastname" id="lastname" class="form-control mb-3" required>

                            {{-- othername --}}
                            <label for="othername">Othername</label>
                            <input type="text" name="othername" id="othername" class="form-control mb-3">
                            
                            {{-- gender --}}
                            <label for="gender">Gender</label><label class="text-danger"></label>
                            <select class="form-control mb-3" name="gender" id="">
                                <option value="">Select</option>
                                <option value="m">Male</option>
                                <option value="f">Female</option>
                            </select>

                            {{-- activeContact --}}
                            <label for="phone">Active Contact</label><label class="text-danger"></label>
                            <input type="text" name="phone" id="phone" class="form-control mb-3" required>

                            {{-- Submit --}}
                            <input type="submit" value="Submit" class="form-control btn btn-success mb-3">


                        </form>
                </div>



            </div> <!-- end of dashboard container -->

        </div>
        <!-- /.conainer-fluid -->

</x-layout>