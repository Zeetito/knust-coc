<x-layout>

        <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>User Profile</strong>
                        
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                            {{-- UserName --}}
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label">Username</label>
                                <div class="col-md-9">
                                    <p class="form-control-static">{{$user->username}}</p>
                                </div>
                            </div>

                            {{-- FirstName --}}
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">First Name</label>
                                <div class="col-md-9">
                                <input type="text"  value="{{old('firstname', empty($profile->firstname) ? $profile->firstname : " ")}}" name="firstname" class="form-control" placeholder="Text">
                                    <span class="help-block">Firstname</span>
                                </div>
                            </div>
                            

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="file-input">File input</label>
                                <div class="col-md-9">
                                    <input type="file" id="file-input" name="file-input">
                                </div>
                            </div>
                           
                        </form>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                        {{-- <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button> --}}
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <strong>Inline</strong>
                        Form
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="form-inline">
                            <div class="form-group">
                                <label for="exampleInputName2">Name</label>
                                <input type="text" class="form-control" id="exampleInputName2" placeholder="Jane Doe">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail2">Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail2" placeholder="jane.doe@example.com">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                        <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
                    </div>
                </div>
            </div>
       
</x-layout>