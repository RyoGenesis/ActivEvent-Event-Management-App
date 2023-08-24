@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="row">
        <div class="col">
            <h3>Pevious Event</h3>
        </div>
    </div>
    <table class="table">
        <thead>
            <th scope="col">#</th>
            <th scope="col">Event name</th>
            <th scope="col">date</th>
            <th scope="col">Status</th>
            <th class="col">Reason</th>
        </thead>
        <tbody>
            {{-- @php
                $i=1;
            @endphp --}}
            @foreach ($historyevents as $event)
                <tr class="table-light">
                    <th>{{$loop->iteration}}</th>
                    <th>{{$event->name}}</th>
                    <th>{{$event->date}}</th>
                    <th>{{$event->status}}</th>
                    <th>{{$event->reasoning}}</th>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection