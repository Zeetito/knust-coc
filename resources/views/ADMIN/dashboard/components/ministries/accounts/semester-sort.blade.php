<x-layout>

    {{-- This Page May contain A History Of All Activities of the Welfare. --}}
    {{-- SubPages may contain sub features --}}
    <div class="card-body bg-white">

        <a href="{{route('ministry_index',['ministry'=>$ministry])}}" class="btn-secondary btn float-right">Go Back</a>

        <div class="h6 " >
            {{$ministry->name}} Space...
        </div>

        <div class="row nav">

            @foreach(App\Models\Semester::all()->sortByDesc('created_at') as $semester)

                @if($ministry->has_account_for($semester) || $semester->is(App\Models\Semester::active_semester()))

                    <div class="col-4">

                        <a href="{{route('ministry_account_sessions',['ministry'=>$ministry,'semester'=>$semester])}}">
                            <img class="list-folder" src="{{asset('img/folder.png')}}" alt="master">
                            
                            <div>{{$semester->academicYear->name()." - Sem ".$semester->name}}</div>
                        </a>
        
                    </div>

                @endif

            @endforeach
                       
        </div>

    </div>

</x-layout>