<x-layout>

        <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>User Profile</strong>
                        
                    </div>
                    <div class="card-body">
                    <form action="{{route('create_profile')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            {{-- UserName --}}
                            <div class="form-group row">
                                {{-- <label class="col-md-3 form-control-label">Hello</label> --}}
                                <div class="col-md-6">
                                    <p class="form-control-static">Hello {{$user->username}}</p>
                                </div>
                            </div>
    
                           
                            
    
                               
    
                            </div>
                           
                            
    
                            <div class="form-group row">
                                {{-- <label class="col-md-3 form-control-label" for="file-input">File input</label> --}}
                                <div class="col-md-9">
                                    Upload a profile picture
                                    <input type="file" id="file-input" name="dp">
                                </div>
                            </div>
                        <button type="submit" name="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Update Profile Picture</button>
                           
                        </form>
                    </div>
                    <div class="card-footer">
                        {{-- <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button> --}}
                    </div>
                </div>
    
           
            </div>
       
    </x-layout>