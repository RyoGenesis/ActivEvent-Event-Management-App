@extends('layouts.app')

@section('title','ActivEvent | Recommended Events For You')

@section('content')

<div class="container">
  <div class="mb-2">
    <a href="/home" style="text-decoration: none">Home</a> > <small> Recommended Events</small>
  </div>
    <h3 class="mb-4">Recommended Events For You</h3>
    <div class="row gap-3" id="card-event-row">
      @forelse ($recommendedEvents as $recommendedevent)
        <a class="card card-event" href="{{ route('eventdetail', ['id'=>$recommendedevent->id]) }}" style="height:max-content">
          <div class="row g-0 allign-item-center">
              <div class="col-md-4">
                <img src="{{$recommendedevent->image ? asset('storage/'.$recommendedevent->image) : asset('images/No-Image-Placeholder.png')}}" class="img-fluid card-event-img" alt="gambar-{{$recommendedevent->name}}">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <div class="card-title">
                    <h4 class="card-event-name" title="{{$recommendedevent->name}}">{{$recommendedevent->name}}</h4>
                    <span class="badge rounded-pill text-bg-info">{{$recommendedevent->category->name}}</span>
                    @if ($recommendedevent->has_sat == 'true')
                        <span class="badge rounded-pill text-bg-primary">SAT</span>
                    @endif
                    @if ($recommendedevent->has_comserv == 'true')
                        <span class="badge rounded-pill text-bg-primary">Comserv</span>
                    @endif
                    @if ($recommendedevent->has_certificate == 'true')
                        <span class="badge rounded-pill text-bg-primary">Certificate</span>
                    @endif
                  </div>
                  <p class="card-text fw-light">{{$recommendedevent->date->format('l, j F Y - H:i \W\I\B')}}</p>
                  <p class="card-text fw-light">Slot Limit: {{$recommendedevent->max_slot == -1 ? 'No Limit' : $recommendedevent->max_slot}}</p>
                  <small class="card-text">Posted by {{$recommendedevent->community->name}}</small>
                </div>
              </div>
            </div>
        </a>
      @empty
      <div class="mx-auto py-5 text-center">
        <p class="fs-4">No recommendation for you at the moment.</p>
        <p>But don't worry! Next time you check in, there might be some for you!</p>
      </div>
      @endforelse
    </div>

    <div class="paginating">
      {{$recommendedEvents->links()}}
    </div>
</div>
@endsection
