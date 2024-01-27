@extends('layouts.app')

@section('title','ActivEvent | Event History')

@section('content')
<div class="container mx-auto">
    <div class="row">
        <div class="col-1">
            <a href="{{ url()->previous() }}" class="fa fa-xl fa-arrow-left" style="text-decoration:none; color:black"></a>
        </div>
        <div class="col">
            <h3>Event History</h3>
        </div>
    </div>
    <div class="table-responsive-sm mt-3">
        <table id="eventHistory" class="table pt-2">
            <thead>
                <th scope="col" class="fs-5">#</th>
                <th scope="col" class="fs-5">Event name</th>
                <th scope="col" class="fs-5">Held by</th>
                <th scope="col" class="fs-5">Date</th>
                <th scope="col" class="fs-5">Status</th>
                <th scope="col" class="fs-5">Benefit</th>
                <th scope="col" class="fs-5">Reason</th>
            </thead>
            <tbody>
                @foreach ($historyevents as $event)
                    <tr class="table-light">
                        <th class="fw-light fs-5"></th>
                        <th class="fw-light fs-5">{{$event->name}}</th>
                        <th class="fw-light fs-5">{{$event->community->display_name}}</th>
                        <th>{{$event->date->format('d-m-Y H:i \W\I\B')}}</th>
                        <th class="fw-light fs-5">
                            @if ($event->status == 'Cancelled')
                                <p class="text-danger">
                                    Cancelled
                                </p>
                            @else
                                @if ($event->pivot->status == 'Registered')
                                <p class="text-success">
                                @else
                                <p class="text-danger">
                                @endif
                                    {{$event->pivot->status}}
                                </p>
                            @endif
                        </th>
                        <th class="fw-light fs-5">
                            @if ($event->date > \Carbon\Carbon::now() || (!$event->has_certificate && !$event->has_sat && !$event->has_comserv) || $event->pivot->status != 'Registered' || $event->status ==  'Cancelled')
                            -
                            @else
                                @if ($event->has_sat)
                                <span class="d-inline-flex rounded bg-warning p-1 m-1 fs-6 text-center">
                                    SAT Point ({{$event->sat_level->name}})
                                </span>
                                @endif
                                @if ($event->has_certificate)
                                <span class="d-inline-flex rounded bg-warning p-1 m-1 fs-6 text-center">
                                    Certificate
                                </span>
                                @endif
                                @if ($event->has_comserv)
                                <span class="d-inline-flex rounded bg-warning p-1 m-1 fs-6 text-center">
                                    Comserv Hour
                                </span>
                                @endif
                            @endif
                        </th>
                        <th class="fw-light fs-5">{{$event->pivot->status == 'Registered' ? '-' : ($event->pivot->reasoning ?? '-')}}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const table = $('#eventHistory').DataTable( {
                dom: 'lfrtip',
                "lengthMenu": [20, 30, 50],
                "columnDefs": [
                    { "searchable": false, "targets": [0] },
                    { "orderable": false, "targets": [0]}
                ]
            } );

            table.on('order.dt search.dt', function () {
                let i = 1;
    
                table.cells(null, 0, { search: 'applied', order: 'applied' })
                    .every(function (cell) {
                        this.data(i++);
                    });
            }).draw();
        }); 
    </script>
@endsection