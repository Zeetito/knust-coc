<x-layout>

    {{-- This Page May contain A History Of All Activities of the Welfare. --}}
    {{-- SubPages may contain sub features --}}
    <div class="card-body bg-white">

        <a href="{{route('admin_home')}}" class="btn-secondary btn float-right">Go Back</a>

        <div class="h6 " >
            {{$ministry->name}} Space
        </div>

        <div class="row nav">

            {{-- History --}}
            <div class="col-3">

                <a href="">
                    <img class="list-folder" src="{{asset('img/folder.png')}}" alt="master">
                    
                    <div>History</div>
                </a>

            </div>


            {{-- Accoutns --}}
            <div class="col-3">

                <a href="{{route('ministry_account_sessions_semesters',['ministry'=>$ministry])}}">
                    <img class="list-folder" src="{{asset('img/folder.png')}}" alt="master">
                    
                    <div>Accounts</div>
                </a>

            </div>



            {{-- Shared Items --}}
            <div class="col-3">

                <a href="{{route('ministry_received_items',['ministry'=>$ministry])}}">
                    <img class="list-folder" src="{{asset('img/folder.png')}}" alt="master">
                    
                    <div>Shared Items</div>
                </a>

            </div>

            {{-- Archive --}}
            <div class="col-3">

                <a href="">
                    <img class="list-folder" src="{{asset('img/folder.png')}}" alt="master">
                    
                    <div>Archive</div>
                </a>

            </div>
            
            {{-- Remarks --}}
            <div class="col-3">

                <a href="{{route('remarks_semester_sort',['ministry'=>$ministry])}}">
                    <img class="list-folder" src="{{asset('img/folder.png')}}" alt="master">
                    
                    <div>Remarks/Notes</div>
                </a>

            </div>

            {{-- Specific To Welfare Ministry --}}
            
            {{-- <span class="col-3 btn"> <a class="btn" href="{{route('view_files',['uploadable_type'=>'App\Models\Role','uploadable_id'=>$ministry->id])}}">Files</a> </span> --}}
        </div>

    </div>

</x-layout>