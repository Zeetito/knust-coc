<x-layout>

        <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>User Avatar</strong>
                        
                    </div>
                    <div class="card-body">
                        <form action="{{route('update_avatar',auth()->id() )}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                @csrf
                                {{-- UserName --}}
                                <div class="form-group row">
                                    {{-- <label class="col-md-3 form-control-label">Hello</label> --}}
                                    <div class="col-md-6">
                                        <p class="form-control-static">User: <strong>{{$user->username}}</strong> </p>
                                    </div>

                                    {{-- Show User Old Avatar --}}
                                    <div class="col-md-3">
                                            <div  style="color:blue; font-weight:bold; border-radius:250px; border-color:black; border-width:2px"   href="{{route('view_profile',auth()->user()->id)}}" >
                                                Current Avatar :
                                            <img src="{{asset('storage/img/avatars/'.$user->avatar)}}" class="img-avatar" alt="Profile Picture">
                                            </div>
                                    </div>


                                </div>
        
                                                        
                                
        
                                <div class="form-group row">
                                    {{-- <label class="col-md-3 form-control-label" for="file-input">File input</label> --}}
                                    <div class="col-md-9">
                                        Upload a profile picture
                                        <input type="file" id="file-input" name="avatar">
                                    </div>
                                </div>
                                    @error('avatar')
                                    <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                    @enderror

                            <button type="submit" name="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Update Profile Picture</button>
                            
                        </form>

                    </div>
                    <div class="card-footer">
                        {{-- <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button> --}}
                    </div>
                </div>
    
           
        </div>
       
    </x-layout>