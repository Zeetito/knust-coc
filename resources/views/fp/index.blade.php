<x-layout>
      
        
    <div class="bg-white">

                {{-- Each Whole Table Screen --}}
                <div class="process-bar">
                    <div class="process-bar">
                        <div class="process-order">
                            <h3 style="text-align:center">Forgot Password Requests ({{App\Models\FP::where('handled',0)->count()}}) </h3>

                        </div>

                        {{-- Attendance Table --}}
                        <div class="" >

                                <div class="card-body">
                                        <table class="table datatable table-striped table-bordered">
                                            {{-- Table Head --}}
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Reset Link</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            {{-- Table Body --}}
                                            <tbody class="search_result">
                                                @foreach(App\Models\FP::where('handled',0)->get() as $fp)

                                                    @if($fp->user())

                                                        <tr id="tr_{{$fp->id}}">
                                                                {{-- Role Name --}}
                                                            <td>
                                                            {{$fp->user()->fullname()}}
                                                            </td>
                                                            {{-- Number of Users --}}
                                                            <td>
                                                            {{$fp->email}}
                                                            </td>
                                                            
                                                            {{-- Description --}}
                                                            <td>
                                                            Hello {{$fp->user()->firstname}}, Please Use the link below to reset your password. <br>
                                                            <a href="{{route('fp_reset_page',['email'=>$fp->email])}}">{{route('fp_reset_page',['email'=>$fp->email])}}</a> 
                                                            </td>

                                                            {{-- Actions --}}
                                                            <td>
                                                                @if($fp->notified == 0)
                                                                    <a href="{{route('fp_notify',['fp'=>$fp])}}" class="btn btn-info">Mark Notified</a>
                                                                @else
                                                                    <span class="btn btn-success">Notified</span>
                                                                @endif
                                                            </td>
         
                                                        </tr>
                                                    @endif

                                                @endforeach

                                            </tbody>
                                            {{-- Table Body Ends --}}
                                        </table>
                                       
                                </div>
                        
                         
                        </div>
                        {{--Users Table Ends--}}

                        {{-- {{$role->links()}} --}}
                       
                    </div>
                </div>
                {{-- Whole Table Screen Ends --}}

               



        </div>
        <!-- /.conainer-fluid -->

</x-layout>