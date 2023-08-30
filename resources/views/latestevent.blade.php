@extends('layouts.app')

@section('content')

<div class="container">
  <div class="mb-2">
    <a href="/home" style="text-decoration: none">Home</a> > <small> Latest Event</small>
  </div>
    <h3 class="mb-4">Latest Event</h3>
    @foreach ($latestevents as $latestevent)
      <div class="card mb-4 mx-auto" style="max-width: 1100px" data-clickable="true", data-href="/eventdetail/{{$latestevent->id}}">
        <div class="row g-0">
            <div class="col-md-4">
              <img src="{{$latestevent->image}}" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h3 class="card-title">{{$latestevent->name}}</h3>
                <div class='card-text'>
                  <p class="my-4">
                    @if ($latestevent->has_certificate == 'true')
                        <span span class="rounded-pill border border-success border-3 p-1 me-2 text-success fs-6 fw-bold">
                          E-Certificate                                
                        </span>
                    @endif
                        
                    @if ($latestevent->has_sat == 'true')
                        <span class="rounded-pill border border-3 border-info text-info p-1 me-2 fs-6 fw-bold">
                          SAT Point
                        </span>
                    @endif 

                    @if ($latestevent->has_comserv == 'true')
                        <span class="rounded-pill border border-3 border-warning text-warning p-1 me-2 fs- fw-bold">
                          Community Service Hour
                        </span>
                    @endif 
                  </p>
                <p class="fs-6 mt-2">
                    {{$latestevent->date}}
                </p>
                <p class="fs-6" >
                    Posted by {{$latestevent->community->name}}
                </p>
                </div>
              </div>
            </div>
          </div>
      </div>
    @endforeach
    <div class="paginating">
      {{$latestevents->links()}}
    </div>
</div>
@endsection

@section('scripts')
<script>
  $(document).ready(() => {
    $(document.body).on('click', '.card[data-clickable=true]', (e) => {
      var href = $(e.currentTarget).data('href');
      window.location = href;
    });
  })
</script>
@endsection
