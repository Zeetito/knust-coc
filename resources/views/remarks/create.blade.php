<x-layout>
      
        
    <div class="container-fluid">

                {{-- Each Whole Table Screen --}}
                <div class=" card process-bar">
                        <div class="process-order">
                            <h6 style="text-align:center">{{$remarkerable->name}}</h6> 
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
                                                        Remark / Note On <strong>{{$remarkable->fullname() ? $remarkable->fullname() : $remarkable->name}}</strong> - {{App\Models\Semester::active_semester()->academic_name()}}

                                                        <a href="{{route('home')}}" class="float-right btn btn-secondary m-2">Home</a>
                                                        
                                                        @foreach(auth()->user()->roles as $role)
                                                                    <a href="{{route('ministry_remark_session',['ministry'=>$role, 'semester'=>App\Models\Semester::active_semester()])}}" class="m-2  text-wrap float-right btn btn-secondary">{{$role->name}} Remark Session</a>
                                                        @endforeach
                                    
                                                    </div>
                                                    <div class="card-body">

                                                        <form action="{{route('store_remark',['remarkerable_type'=>$remarkerable_type,'remarkerable_id'=>$remarkerable->id, 'remarkable_id'=>$remarkable->id, 'remarkable_type'=>$remarkable_type])}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                                @csrf
                                    
                                                                <textarea name="body" id="" cols="30" rows="10" 
                                                                    placeholder="1. He has never been to Church"
                                                                >
                                                                {{old('body',$remarkable->remark_from($remarkerable_type, $remarkerable->id, App\Models\Semester::active_semester()->id))}}
                                                                </textarea>

                                                                {{-- <label for="defaultImageable_type">defaultImageable Type:</label> --}}
                                    
                                    
                                    
                                                            <button type="submit" name="submit" class="btn btn-sm btn-primary m-2"><i class="fa fa-dot-circle-o"></i> Submit</button>
                                    
                                                        </form>
                                                    </div>
                                                    <div class="card-footer">
                                                        {{-- <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button> --}}
                                                    </div>
                                                </div>

                                                
                                    
                                    
                                            </div>
                                    
                                    
                                        </div>

                                </div>
                        
                         
                        </div>

                       
                </div>
                {{-- Whole Table Screen Ends --}}

    </div>
        <!-- /.conainer-fluid -->

</x-layout>