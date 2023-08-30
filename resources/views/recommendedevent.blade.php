@extends('layouts.app')

@section('content')

<div class="container">
  <div class="mb-2">
    <a href="/home" style="text-decoration: none">Home</a> > <small> Recommended Event</small>
  </div>
    <h3 class="mb-4">Recommended Event</h3>
    <div class="row gap-3">
      @foreach ($recommendedEvents as $recommendedevent)
        <a class="card text-decoration-none text-dark" href="{{ route('eventdetail', ['id'=>$recommendedevent->id]) }}" style="height:max-content">
          <div class="row g-0 allign-item-center">
              <div class="col-md-4">
                <img src="{{$recommendedevent->image ? asset('storage/'.$recommendedevent->image) : asset('images/No-Image-Placeholder.png')}}" class="img-fluid" alt="gambar-{{$recommendedevent->name}}">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <div class="card-title">
                    <h4>{{$recommendedevent->name}}</h4>
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
                  <p class="card-text fw-light">Slot Available: {{$recommendedevent->max_slot == -1 ? 'No Limit' : $recommendedevent->max_slot}}</p>
                  <small class="card-text">Posted by {{$recommendedevent->community->name}}</small>
                </div>
              </div>
            </div>
        </a>
      @endforeach
    </div>

    <div class="paginating">
      {{$recommendedEvents->links()}}
    </div>
</div>
@endsection
