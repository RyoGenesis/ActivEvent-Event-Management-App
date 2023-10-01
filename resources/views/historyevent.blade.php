@extends('layouts.app')

@section('title','ActivEvent | Event History')

@section('content')
<div class="container mx-auto">
    <div class="row">
        <div class="col-1">
            <a href="{{ url()->previous() }}" class="fa fa-xl fa-arrow-left" style="text-decoration:none; color:black"></a>
        </div>
        <div class="col-2">
            <h3>Event History</h3>
        </div>
    </div>
    <div class="table-responsive-sm">
        <table id="eventHistory" class="table mt-2">
            <thead>
                <th scope="col" class="fs-4">#</th>
                <th scope="col" class="fs-4">Event name</th>
                <th scope="col" class="fs-4">Held by</th>
                <th scope="col" class="fs-4">Status</th>
                <th scope="col" class="fs-4">Reason</th>
            </thead>
            <tbody>
                @foreach ($historyevents as $event)
                    <tr class="table-light">
                        <th class="fw-light fs-5"></th>
                        <th class="fw-light fs-5">{{$event->name}}</th>
                        <th class="fw-light fs-5">{{$event->community->display_name}}</th>
                        <th class="fw-light fs-5">
                            @if ($event->pivot->status == 'Registered')
                            <p class="text-success">
                                {{$event->pivot->status}}
                            </p>
                            @else
                            <p class="text-danger">
                                {{$event->pivot->status}}
                            </p>
                            @endif
                        </th>
                        <th class="fw-light fs-5">{{$event->pivot->reasoning ?? '-'}}</th>
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
                "lengthMenu": [20, 50],
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