<x-ladmin-auth-layout>
    <x-slot name="title">Dashboard</x-slot>
    <div class="m-3">
        <p class="fs-4 fw-bold">Hello, {{auth()->user()->display_name}}</p>
        
        <div class="mb-4">
            <p class="fw-bold fs-5">Participants Count Summary</p>
            @if ($user->community_id == 1)
                <select class="form-select mb-3" id="groupby" name='groupby_community' style="width: 400px">
                    <option selected value="">Choose Community</option>
                    @foreach ($communities as $community)
                        <option value="{{$community->id}}">{{$community->name}}</option>
                    @endforeach
                </select>
            @endif
            
            @foreach ($charts as $chart)
                <div class="p-6 m-20 bg-white rounded shadow mb-5">
                    {!! $chart->container() !!}
                </div>
                <script src="{{$chart->cdn()}}"></script>
                {{$chart->script()}}
            @endforeach
        </div>

        {{-- featuring events latest active, near closing, already past but latest, last updated, waiting approval--}}
        <div class="row mb-2">
            <p class="fw-bold fs-5">Latest Active Events</p>
            @forelse ($latestActive as $event)
            <div class="col-12 col-sm-4 p-1">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title event-name">{{$event->name}}</h5>
                        <p class="card-text">By : {{$event->community->display_name}}</p>
                        <p class="card-text">Event Type : {{$event->category->display_name}}</p>
                        <div class="btn-event-dashboard">
                            <a href="{{ route('ladmin.event.show', [$event->id, 'back' => route('ladmin.event.index')]) }}" class="btn btn-warning">View</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col m-5">
                <p class="text-center fw-bold">No events</p>
            </div>
            @endforelse
        </div>
        <div class="row mb-2">
            <p class="fw-bold fs-5">Near Finished</p>
            @forelse ($nearClosing as $event)
            <div class="col-12 col-sm-4 p-1">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title event-name">{{$event->name}}</h5>
                        <p class="card-text">By : {{$event->community->display_name}}</p>
                        <p class="card-text">Event Type : {{$event->category->display_name}}</p>
                        <div class="btn-event-dashboard">
                            <a href="{{ route('ladmin.event.show', [$event->id, 'back' => route('ladmin.event.index')]) }}" class="btn btn-warning">View</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col m-5">
                <p class="text-center fw-bold">No events</p>
            </div>
            @endforelse
        </div>
        <div class="row mb-2">
            <p class="fw-bold fs-5">Recently Finished</p>
            @forelse ($recentlyFinished as $event)
            <div class="col-12 col-sm-4 p-1">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title event-name">{{$event->name}}</h5>
                        <p class="card-text">By : {{$event->community->display_name}}</p>
                        <p class="card-text">Event Type : {{$event->category->display_name}}</p>
                        <div class="btn-event-dashboard">
                            <a href="{{ route('ladmin.event.show', [$event->id, 'back' => route('ladmin.event.index')]) }}" class="btn btn-warning">View</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col m-5">
                <p class="text-center fw-bold">No events</p>
            </div>
            @endforelse
        </div>
        <div class="row mb-2">
            <p class="fw-bold fs-5">Last Updated</p>
            @forelse ($latestUpdated as $event)
            <div class="col-12 col-sm-4 p-1">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title event-name">{{$event->name}}</h5>
                        <p class="card-text">By : {{$event->community->display_name}}</p>
                        <p class="card-text">Event Type : {{$event->category->display_name}}</p>
                        <div class="btn-event-dashboard">
                            <a href="{{ route('ladmin.event.show', [$event->id, 'back' => route('ladmin.event.index')]) }}" class="btn btn-warning">View</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col m-5">
                <p class="text-center fw-bold">No events</p>
            </div>
            @endforelse
        </div>
        <div class="row mb-2">
            <p class="fw-bold fs-5">Waiting Approval</p>
            @forelse ($waitingApproval as $event)
            <div class="col-12 col-sm-4 p-1">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title event-name">{{$event->name}}</h5>
                        <p class="card-text">By : {{$event->community->display_name}}</p>
                        <p class="card-text">Event Type : {{$event->category->display_name}}</p>
                        <div class="btn-event-dashboard">
                            <a href="{{ route('ladmin.event.show', [$event->id, 'back' => route('ladmin.event.index')]) }}" class="btn btn-warning">View</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col m-5">
                <p class="text-center fw-bold">No events</p>
            </div>
            @endforelse
        </div>
    </div>
</x-ladmin-auth-layout>

<script>
    $(document).ready(function(){
        $('#groupby').change(function(){
            var selectedValue = $(this).val();

            console.log(selectedValue);

            window.location.href = '/administrator?groupby_community=' + selectedValue;
        });
    });
</script>