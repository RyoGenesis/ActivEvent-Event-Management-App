@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="row">
        <div class="col-1">
            <a href="{{ url()->previous() }}" class="fa fa-xl fa-arrow-left" style="text-decoration:none; color:black"></a>
        </div>
        <div class="col-2">
            <h3>Pevious Event</h3>
        </div>
    </div>
    <table class="table mt-2">
        <thead>
            <th scope="col" class="fs-4">#</th>
            <th scope="col" class="fs-4">Event name</th>
            <th scope="col" class="fs-4">Status</th>
            <th scope="col" class="fs-4">Reason</th>
        </thead>
        <tbody>
            {{-- @php
                $i=1;
            @endphp --}}
            @foreach ($historyevents as $event)
                <tr class="table-light">
                    <th class="fw-light fs-5">{{$loop->iteration}}</th>
                    <th class="fw-light fs-5">{{$event->name}}</th>
                    <th class="fw-light fs-5">{{$event->pivot->status}}</th>
                    <th class="fw-light fs-5">{{$event->pivot->reasoning}}</th>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection