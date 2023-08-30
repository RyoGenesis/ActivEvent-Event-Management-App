@extends('layouts.app')

@section('content')

<div class="container">
  <div class="mb-2">
    <a href="/home" style="text-decoration: none">Home</a> > <small> Popular Event</small>
  </div>
    <h3 class="mb-4">Popular Event</h3>
    <div class="row gap-3">
      @foreach ($popularevents as $popularevent)
        <a class="card text-decoration-none text-dark" href="{{ route('eventdetail', ['id'=>$popularevent->id]) }}" style="height:max-content">
          <div class="row g-0 allign-item-center">
              <div class="col-md-4">
                <img src="{{$popularevent->image ? asset('storage/'.$popularevent->image) : asset('images/No-Image-Placeholder.png')}}" class="img-fluid" alt="gambar-{{$popularevent->name}}">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <div class="card-title">
                    <h4>{{$popularevent->name}}</h4>
                    <span class="badge rounded-pill text-bg-info">{{$popularevent->category->name}}</span>
                    @if ($popularevent->has_sat == 'true')
                        <span class="badge rounded-pill text-bg-primary">SAT</span>
                    @endif
                    @if ($popularevent->has_comserv == 'true')
                        <span class="badge rounded-pill text-bg-primary">Comserv</span>
                    @endif
                    @if ($popularevent->has_certificate == 'true')
                        <span class="badge rounded-pill text-bg-primary">Certificate</span>
                    @endif
                  </div>
                  <p class="card-text fw-light">{{$popularevent->date->format('l, j F Y - H:i \W\I\B')}}</p>
                  <p class="card-text fw-light">Slot Available: {{$popularevent->max_slot == -1 ? 'No Limit' : $popularevent->max_slot}}</p>
                  <small class="card-text">Posted by {{$popularevent->community->name}}</small>
                </div>
              </div>
            </div>
        </a>
      @endforeach
    </div>

    <div class="paginating">
      {{$popularevents->links()}}
    </div>
</div>
@endsection
