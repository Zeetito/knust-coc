<x-layout>
    <div class="container">
        <div class="row card">
            
            @allowedTo(['create_fishing_out'])
            {{-- Fishing Out --}}
            <div class="col-sm-12 col-lg-4 col- col-md-6 card-body">
                <div class="h3"> Fishing Out</div>

                <div> Something Goes Here </div>

                <div class="btn btn-warning" data-toggle="modal" data-target="#myModal" data-url="{{route('fishing_out_create')}}" >
                    Create A Fishing Out Session.
                </div>
            </div>
            @endallowedTo
            {{-- Visitation --}}
            <div class="col-sm-12 col-lg-4 col- col-md-6 card-body">
                <div class="h3"> Visitation</div>

                <div> Something Goes Here </div>

                <div class="btn btn-warning">
                    Create A Visitation Session.
                </div>
            </div>
            {{-- Evangelism --}}
            <div class="col-sm-12 col-lg-4 col- col-md-6 card-body">
                <div class="h3"> Evangelism</div>

                <div> Something Goes Here </div>

                <div class="btn btn-warning">
                    Create A Evangelism Session.
                </div>
            </div>

        </div>
    </div>
</x-layout>