<form action="{{route('store_image')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
    @csrf
        <div class="modal-title" id="myModalLabel">
                    <h5 style="text-align:center">Upload Image</h5>
        </div>

        <div class="modal-body">
            <div class="card-body">


                        <label for="image">Choose Image:</label>
                        <input type="file" name="image" id="image" accept="image/*" required>
                        @error('image')
                            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                        @enderror

                        {{-- <label for="imageable_type">Imageable Type:</label> --}}
                        <input type="text" value="App\Models\SemesterProgram" name="imageable_type" id="imageable_type" hidden required>

                        {{-- <label for="imageable_id">Imageable ID:</label> --}}
                        <input type="text" name="imageable_id" value="{{$semesterProgram->id}}" id="imageable_id" hidden required>
            </div>
            <div class="card-footer">
                {{-- <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button> --}}
            </div>
        </div>
        </div>
        
        <div class="modal-footer">
            <input type="submit" name="submit" value="Upload" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>
