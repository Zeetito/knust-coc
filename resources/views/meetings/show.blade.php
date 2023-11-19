<x-layout>
      
        
    <div class="container-fluid">

                {{-- Each Whole Table Screen --}}
                <div class=" card process-bar">
                        <div class="process-order">
                            <h3 style="text-align:center">{{$meeting->name}}</h3>
                            {{-- <span>
                                    <form >
                                        <input type="text" class="search_box" data-url="" placeholder="search name..." style="text-align:center;">
                                            <i class="fa fa-search"></i>
                                    </form>
                            </span> --}}
                        </div>

                        <div class="" >

                                <div class="card-body">
                                        {{-- Form Pic --}}
                                        <div class="contianer row">
                                                <div class="card col-12">
                                    
                                                    <div class="card-header">
                                                        <strong>User Images</strong>
                                    
                                                    </div>
                                                    <div class="card-body">
                                                        <form action="{{route('store_default_image')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                                @csrf
                                    
                                                                <label for="image">Choose Image:</label>
                                                                <input type="file" name="image" id="image" accept="image/*" required>
                                                                @error('image')
                                                                    <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                                                @enderror
                                    
                                                                {{-- <label for="defaultImageable_type">defaultImageable Type:</label> --}}
                                                                <input type="text" value="App\Models\Meeting" name="defaultImageable_type" id="defaultImageable_type" hidden required>
                                    
                                                                {{-- <label for="defaultImageable_id">defaultImageable ID:</label> --}}
                                                                <input type="text" name="defaultImageable_id" value="{{$meeting->id}}" id="defaultImageable_id" hidden required>
                                    
                                    
                                                            <button type="submit" name="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                                    
                                                        </form>
                                                    </div>
                                                    <div class="card-footer">
                                                        {{-- <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button> --}}
                                                    </div>
                                                </div>

                                                
                                    
                                                @foreach($meeting->defaultImages as $photo )
                                                <div class="card">
                                                    <span ><i class="fa fa-trash"></i></span>
                                                    <img class="image-display" src="{{asset('storage/images/'.$photo->url) }}" alt="photo">
                                                </div>
                                                @endforeach
                                    
                                            </div>
                                    
                                    
                                        </div>

                                </div>
                        
                         
                        </div>

                       
                </div>
                {{-- Whole Table Screen Ends --}}

    </div>
        <!-- /.conainer-fluid -->

</x-layout>