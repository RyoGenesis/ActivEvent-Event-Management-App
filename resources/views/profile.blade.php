@extends('layouts.app')

@section('content')
    <div class="container text-center"><h3>Profile</h3></div>

    <div class="d-flex justify-content-center">
        <div class="card" style="width:50rem">
            <div class="card-body ms-5  ps-5 pe-3">
                <div class="row mb-2">
                    <div class="col">
                        <h5 class="text-primary">Nama</h5>
                        <div class="fs-5"> Nama User</div>
                    </div>
                    <div class="col">
                        <h5 class="text-primary">NIM</h5>
                        <div>23019333313</div>
                    </div>
                    <div class="col">
                        <h5 class="text-primary">Major</h5>
                        <div>ComputerScience</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h5 class="text-primary">Email</h5>
                        <div>Email User</div>
                    </div>
                    <div class="col">
                        <h5 class="text-primary">Date of Birth</h5>
                        <div>2023-16-6</div>
                    </div>
                    <div class="col">
                        <h5 class="text-primary">Gender</h5>
                        <div>Male</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center mt-3 pt-3">
        <div class="row">
            <div class="col">
                <h3>Your Up Coming Event</h3>
            </div>
            <div class="col">
                <a href="/prevevent" class="btn btn-secondary"> Prev Event</a>
            </div>
        </div>
        <table class="table table-secondary mt-5">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Event name</th>
                    <th scope="col">date</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i=1;
                @endphp
                @foreach ($event as $event)
                    <tr class="table-light">
                        <th>{{$loop->iteration}}</th>
                        <th>{{$event->name}}</th>
                        <th>{{$event->date}}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection