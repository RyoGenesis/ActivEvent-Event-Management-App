@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center">
    <div class="card mx-3 " style="width:60rem">
        <img src="{{$event->image}}" class="card-img-top" alt="gambar {{$event->name}}">
        <div class="card-body">
            <h1 class="card-title mb-2">{{$event->name}}</h1>
            <div class="row">
                <div class="col">
                    <p class="card-text">
                        <small class="text-body-secondary">
                            {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->date)->format('Y-m-d')}}
                            {{-- {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->date)->format('H:i')}} --}}
                        </small>
                    </p>
                </div>
                <div class="col">
                    @auth
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRegister">
                            Register Now
                        </button>

                        <div class="modal" id="modalRegister">
                            <div class='modal-dialog'>
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirmation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class='fs-5 text-center'>
                                            Are you sure want to register to this event
                                        </p>
                                        <div class="container text-center">
                                            <div class="row mt-4">
                                                <div class="col">
                                                    <button>Confirm</button>
                                                </div>
                                                <div class="col">
                                                    <button>Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="/login" class="btn btn-primary" role="button">Register Now</a>
                    @endauth
                </div>
            </div>
            <p class="card-text">
                {{$event->status}}
            </p>
            <div class="row">
                <div class="col">
                    <p class="card-text">
                        <p class="fs-5 text-primary">Category acara</p>                
                        <small>
                            {{$event->category->name}}
                        </small>
                    </p>
                </div>
                <div class="col">
                    <p class="card-text">
                        <p class="fs-5 text-primary">Topik acara</p>                
                        <small>
                            {{$event->topic}}
                        </small>
                    </p>
                </div>

            </div>
            <p class="card-text">
                <p class="fs-5 text-primary"> Avaiable Slot</p>
                <p>{{$event->max_slot}}</p>
            </p>
            <p class="card-text">
                <p class="fs-5 text-primary"> Event Description</p>
                {{$event->description}} 
            </p>
        </div>
    </div>
</div>

@endsection