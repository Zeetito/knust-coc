<x-layout>
    <div class="card">

                <div class="modal-title" id="myModalLabel">
                    <span style=" ">
                            <h4 style="text-align:center">Confirm</h4>
                </div>
                <div class="modal-body">
                        {{-- User Name --}}
                        <p>You are Printing Absentees for {{isset($zone ) ? $zone->name:$name}} Zone(s). </p>
                        {{-- <input type="text"  value="{{$officiator}}" class="search_box form-control" name="user_id" id="for_user_list"  autocomplete="off" readonly hidden required>
                        <input type="text"  value="{{App\Models\User::find($officiator)->fullname()}}" class="search_box form-control" name="" id=""  autocomplete="off" readonly > --}}
                    
            
                        <input type="checkbox" name="status" value="user" hidden checked>
            
                    </span>
                    <br>
                    {{-- Officiating Role --}}
                </div>
            <div class="modal-footer">
                {{-- <button data-toggle="modal" data-target="#myModal" data-url="{{route('select_absentee_file_type',['attendance'=>$attendance,'zone'=>$zone])}}" >Yes</button> --}}
                <a type="button" href="{{route($back,['attendance'=>$attendance])}}" class="btn btn-secondary" data-dismiss="modal">Go Back</a>
            </div>                                  


            <form action="{{route('print_absentee_file',['attendance'=>$attendance,'zone'=>$zone])}}" method="post">
                @csrf

                    <div class="modal-body">
                            {{-- User Name --}}
                            <p>Please Select The file type</p>
                            <select name="file_type" id="file_type">
                                <option value="pdf">PDF</option>
                                <option value="excel">Excel</option>
                            </select>
                        
                        <br>
            
                    </div>
                <div class="modal-footer">
                    <input type="submit"   name="submit_user" value="Print" class="float-left btn btn-secondary">  
                </div>                                  
            </form>

    </div>
</x-layout>