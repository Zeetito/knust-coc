<x-layout>
    <div class="contianer row">
            <div class="card col-12">

                <div class="card-header">
                    <strong>User Images</strong>

                </div>
                @can('update',$user)
                <div class="card-body">
                    <form action="{{route('store_image')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf

                            <label for="image">Choose Image:</label>
                            <input type="file" name="image" id="image" accept="image/*" required>
                            @error('image')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                            @enderror

                            {{-- <label for="imageable_type">Imageable Type:</label> --}}
                            <input type="text" value="App\Models\User" name="imageable_type" id="imageable_type" hidden required>

                            {{-- <label for="imageable_id">Imageable ID:</label> --}}
                            <input type="text" name="imageable_id" value="{{$user->id}}" id="imageable_id" hidden required>


                        <button type="submit" name="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>

                    </form>
                </div>
                <div class="card-footer">
                    {{-- <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button> --}}
                </div>
            </div>
            @endcan

            @foreach($user->photos as $photo )
            <div class="card">
                <span ><i class="fa fa-trash"></i></span>
                <img class="image-display" src="{{asset('storage/images/'.$photo->url) }}" alt="photo">
            </div>
            @endforeach

        </div>


    </div>

</x-layout>