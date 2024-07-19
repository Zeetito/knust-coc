<x-layout>
        
    <div class="card">
            <div class="">

                <div class="card-header">
                    Create Special Program
                </div>

                <div class="card-body">
                        {{-- Form Here --}}
                        <form action="{{route('store_special_program')}}" method="POST">
                            @csrf
                            {{-- Name --}}
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control mb-3" required>
                            
                            {{-- StartDate --}}
                            <label for="start_date">Start Date</label>
                            <input type="date" start_date="start_date" name="start_date" id="start_date" class="form-control mb-3" required>
                            
                            {{-- endtDate --}}
                            <label for="end_date">End Date</label>
                            <input type="date" end_date="end_date" name="end_date" id="end_date" class="form-control mb-3" >

                            {{-- Submit --}}
                            <input type="submit" value="Submit" class="form-control btn btn-success mb-3">



                        </form>
                </div>



            </div> <!-- end of dashboard container -->

        </div>
        <!-- /.conainer-fluid -->

</x-layout>