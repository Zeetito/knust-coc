<form action="{{route('upload_file')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" class="form-control" name="file" accept=".pdf" required>
    
    <input name="type" type="text" value="{{$type}}" hidden>
    <input name="uploadable_type" type="text" value="{{$uploadable_type}}" hidden>
    <input name="uploadable_id" type="text" value="{{$uploadable_id}}" hidden>

    <button class=" btn form-control" type="submit">Upload File</button>
</form>