@extends('layouts.app')

@section('content')

<div class="container my-3">
    <h3 class="mb-4">Events containing the word "{{$search}}"</h3>
    <div class="d-flex">
        <div class="p-2">
            <form id="formsearch" role="search" method="GET" action="{{route('search')}}">
                <div class="container-fluid rounded-3 p-0" style="border:1px solid lightgrey; width:300px">
                    <div class="row my-3 px-2">
                        <div class="col">
                            <h4>Filter</h4>
                        </div>
                        <div class="col text-end">
                            <button class="btn btn-sm btn-primary fs-6" type="submit" id="submitfilter">Submit</button>
                        </div>
                    </div>
                    <div class="accordion" style="" id="accordionSat">
                        <div class="accordion-item">
                            <h6 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsesat" aria-expanded="true" aria-controls="collapsesat" >SAT Point</button>
                            </h6> 

                            <div id="collapsesat" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <div class="form-check">
                                        <label class="form-check-label"><small>Yes</small></label>
                                        <input class="form-check-input" type="radio" id="checksat" name="checksat" value="yes">
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label"><small>No</small></label>
                                        <input class="form-check-input" type="radio" id="checksat" name="checksat" value="no">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="accordion" id="accordionComserv">
                        <div class="accordion-item">
                            <h6 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsecomserv" aria-expanded="true" aria-controls="collapsecomserv" >Community Service Hour</button>
                            </h6> 

                            <div id="collapsecomserv" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <div class="form-check">
                                        <label class="form-check-label"><small>Yes</small></label>
                                        <input class="form-check-input" type="radio" id="checkcomserv" name="checkcomserv" value="yes">
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label"><small>No</small></label>
                                        <input class="form-check-input" type="radio" id="checkcomserv" name="checkcomserv" value="no">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="accordion" id="accordionCertificate">
                        <div class="accordion-item">
                            <h6 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsecertificate" aria-expanded="true" aria-controls="collapsecertificate" >E-Certificate</button>
                            </h6> 

                            <div id="collapsecertificate" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <div class="form-check">
                                        <label class="form-check-label"><small>Yes</small></label>
                                        <input class="form-check-input" type="radio" id="checkcertificate" name="checkcertificate" value="yes">
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label"><small>No</small></label>
                                        <input class="form-check-input" type="radio" id="checkcertificate" name="checkcertificate" value="no">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="accordion" id="accordionCategory">
                        <div class="accordion-item">
                            <h6 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsecategory" aria-expanded="true" aria-controls="collapsecategory">Category</button>
                            </h6> 

                            <div id="collapsecategory" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    @foreach ($categories as $category)
                                    <div class="form-check mb-2">
                                        <label class="form-check-label"><small>{{$category->name}}</small></label>
                                        <input class="form-check-input" type="checkbox" id="checkcategory" name="categories[]" value="{{$category->id}}">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="accordion" id="accordionFee">
                        <div class="accordion-item">
                            <h6 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefee" aria-expanded="true" aria-controls="collapsefee">Registration Fee</button>
                            </h6> 

                            <div id="collapsefee" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <div class="form-check">
                                        <label class="form-check-label"><small>Free</small></label>
                                        <input class="form-check-input" type="radio" id="checkfee" name="checkfee" value="free">
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label"><small>Paid</small></label>
                                        <input class="form-check-input" type="radio" id="checkfee" name="checkfee" value="paid">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="accordion" id="accordionCommunity">
                        <div class="accordion-item">
                            <h6 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsecommunity" aria-expanded="true" aria-controls="collapsecommunity">Community</button>
                            </h6> 

                            <div id="collapsecommunity" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    @foreach ($communities as $community)
                                        <div class="form-check mb-2">
                                            <label class="form-check-label"><small>{{$community->name}}</small></label>
                                            <input class="form-check-input" type="checkbox" id="checkcommunity" name="communities[]" value="{{$community->id}}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
                
        </div>
        <div class="p-2 flex-grow-1 content-start">
            <div id="contentevent" class="p-2 bg-light ms-md-4 ms-sm-2" style="width:100%">
                <div class="row gap-3">
                    @if ($events->isEmpty())
                    No search result for "{{$search}}"
                    @else
                    @foreach ($events as $event)
                    {{-- <div class="col"> --}}
                        <a class="card text-decoration-none text-dark" href="{{ route('eventdetail', ['id'=>$event->id]) }}" style="height:max-content">
                            <div class="row g-0 align-items-center">
                                <div class="col-md-4">
                                    <img src="{{$event->image ? asset('storage/'.$event->image) : asset('images/No-Image-Placeholder.png')}}" class="img-fluid" alt="gambar-{{$event->name}}">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h4>{{$event->name}}</h4>
                                            <span class="badge rounded-pill text-bg-info">{{$event->category->name}}</span>
                                            @if ($event->has_sat == 'true')
                                                <span class="badge rounded-pill text-bg-primary">SAT</span>
                                            @endif
                                            @if ($event->has_comserv == 'true')
                                                <span class="badge rounded-pill text-bg-primary">Comserv</span>
                                            @endif
                                            @if ($event->has_certificate == 'true')
                                                <span class="badge rounded-pill text-bg-primary">Certificate</span>
                                            @endif
                                        </div>
                                        <p class="card-text fw-light">{{$event->date->format('l, j F Y - H:i \W\I\B')}}</p>
                                        <p class="card-text fw-light">Slot Available: {{$event->max_slot == -1 ? 'No Limit' : $event->max_slot}}</p>
                                        <p class="card-text fw-light">Fee: {{$event->price == 0 ? 'Free' : 'Rp. '.number_format($event->price,2,',','.')}}</p>
                                        <small class="card-text">Posted by {{$event->community->name}}</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    {{-- </div> --}}
                    @endforeach    
                    @endif
                
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const form = document.getElementById('formsearch');
    document.getElementById('formsearch').addEventListener('submit', function(event){
        event.preventDefault();
        var searchvalue = "{{$search}}";
        console.log(searchvalue);
        var prevsearch = document.createElement('input');
            prevsearch.type = 'hidden';
            prevsearch.name = 'search';
            prevsearch.value = searchvalue;
            console.log(prevsearch);
            form.appendChild(prevsearch);
            form.submit();
    });
</script>
@endsection
