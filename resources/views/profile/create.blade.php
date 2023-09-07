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
                                <p class="form-control-static">Hello {{$user->username}} Help us know more about you</p>
                            </div>
                        </div>

                        <div class="form-group row">
                           

                             {{-- Other Name --}}
                            {{-- <label class="col-md-3 form-control-label" for="text-input">First Name</label> --}}
                            <div class="col-md-3 mb-4">
                                <input type="text"  value="{{old('othername')}}" name="othername" class="form-control" placeholder="Other Name">
                                    {{-- <span class="help-block">Other Name</span> --}}
                                     {{-- Error Message --}}
                                     @error('othername')
                                     <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                     @enderror
                            </div>

                          {{-- Program List for Each College --}}
                            {{-- Program Id --}}
                            <div class="col-md-3 mb-4">
                                <input list="programs" class="form-control" name="program_id" id="program" placeholder="program search..." >
                                <datalist id="programs">
                                  <option value="computer science">
                                  <option value="environmental science">
                                  <option value="something else">
                                </datalist>
                            {{-- <span class="help-block">Residence</span> --}}

                        </div>


                            {{-- Zone Id --}}
                            <div class="col-md-3 mb-4">
                                    <select class="form-control" name="zone" id="zones">
                                        <option>SELECT ZONE</option>
                                        <option>BOADI</option>
                                        <option>CAMPUS</option>
                                        <option>SHALOM</option>
                                        <option>NEWSITE</option>
                                    </select>
                                 {{-- <span class="help-block">Zone</span> --}}
                                {{-- Error Message --}}
                                    @error('zone')
                                    <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                    @enderror
                            </div>

                            {{-- Year --}}
                            <div class="col-md-3 mb-4">
                            <select class="form-control" value="{{old('year',$profile->year)}}" name="year" id="years">
                                <option value=" ">SELECT YEAR</option>

                                @for($i=1; $i<=8; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor

                            </select>
                                    @error('year')
                                    <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                    @enderror
                            </div>

                            {{-- Residence List for Each Zone --}}
                            {{-- Residence Id --}}
                            <div class="col-md-3 mb-4">
                                    <input list="residences" class="form-control" name="residence" id="residence" placeholder="Residence search..." >
                                    <datalist id="residences">
                                      <option value="Happy Family">
                                      <option value="Shalom">
                                      <option value="Independence Hall">
                                    </datalist>
                                {{-- <span class="help-block">Residence</span> --}}

                            </div>

                               {{-- Room --}}
                            {{-- <label class="col-md-3 mb-4 form-control-label" for="text-input">First Name</label> --}}
                            <div class="col-md-3 mb-4">
                                <input type="text"  value="{{old('room')}}" name="room" class="form-control" placeholder="Room">
                                    {{-- <span class="help-block">Room</span> --}}
                                     {{-- Error Message --}}
                                     @error('room')
                                     <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                     @enderror
                            </div>

                        </div>
                       
                        

                        {{-- Upload Profile Pic Option --}}
                        <div class="form-group row">
                            {{-- <label class="col-md-3 mb-4 form-control-label" for="file-input">File input</label> --}}
                            <div class="col-md-9">
                                Upload a profile picture
                               
                            </div>
                        </div>
                    <button type="submit" name="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                       
                    </form>
                </div>
                <div class="card-footer">
                    {{-- <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button> --}}
                </div>
            </div>

       
        </div>
   
</x-layout>