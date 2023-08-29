<x-ladmin-auth-layout>
    <x-slot name="title">Event Details</x-slot>
    <div>
        <div class="row mb-1">
            {{-- name --}}
            <div class="col">
                <p class="fw-bold mb-1">Name</p>
                <p>{{$event->name}}</p>
            </div>
            {{-- community--}}
            <div class="col">
                <p class="fw-bold mb-1">Associated Community</p>
                <p>{{$event->community->name}}</p>
            </div>
        </div>
        <div class="row">
            {{-- status--}}
            <div class="col">
                <p class="fw-bold mb-1">Current Status</p>
                <p>{{$event->status}}</p>
            </div>
            {{-- location --}}
            <div class="col">
                <p class="fw-bold mb-1">Location</p>
                <p>{{$event->location}}</p>
            </div>
        </div>
        <div class="row">
            {{-- date--}}
            <div class="col">
                <p class="fw-bold mb-1">Event Date</p>
                <p>{{$event->date->format('d/m/Y H:i')}}</p>
            </div>
            {{-- registration end --}}
            <div class="col">
                <p class="fw-bold mb-1">Registration End Date</p>
                <p>{{$event->registration_end->format('d/m/Y H:i')}}</p>
            </div>
        </div>
        <div class="row">
            {{-- category--}}
            <div class="col">
                <p class="fw-bold mb-1">Category</p>
                <p>{{$event->category->name}}</p>
            </div>
            {{-- topic --}}
            <div class="col">
                <p class="fw-bold mb-1">Topic</p>
                <p>{{$event->topic}}</p>
            </div>
        </div>
        <div class="row">
            {{-- speaker--}}
            <div class="col">
                <p class="fw-bold mb-1">Speaker</p>
                <p>{{$event->speaker ?? '-'}}</p>
            </div>
            {{-- contact person --}}
            <div class="col">
                <p class="fw-bold mb-1">Contact Person</p>
                <p>{{$event->contact_person ?? '-'}}</p>
            </div>
        </div>
        <div class="row">
            {{-- certificate--}}
            <div class="col">
                <p class="fw-bold mb-1">Provide Certificate</p>
                <p></p>
                {{$event->has_certificate ? '<p class="text-success">Yes</p>' : '<p class="text-danger">No</p>'}}
            </div>
            {{-- comserv --}}
            <div class="col">
                <p class="fw-bold mb-1">Provide Community Service Hours</p>
                {{$event->has_comserv ? '<p class="text-success">Yes</p>' : '<p class="text-danger">No</p>'}}
            </div>
        </div>
        <div class="row">
            {{-- sat provide--}}
            <div class="col">
                <p class="fw-bold mb-1">Provide SAT</p>
                {{$event->has_sat ? '<p class="text-success">Yes</p>' : '<p class="text-danger">No</p>'}}
            </div>
            {{-- sat level --}}
            <div class="col">
                <p class="fw-bold mb-1">SAT Level</p>
                <p>{{$event->sat_level_id ? $event->sat_level->name : '-'}}</p>
            </div>
        </div>
        <div class="row">
            {{-- BGA--}}
            <div class="col">
                <p class="fw-bold mb-1">Selected BGA</p>
                <p>
                @if ($event->has_sat)
                    @foreach ($event->bgas as $bga)
                        @if ($loop->last)
                            {{$bga->name}}
                        @else
                            {{$bga->name}}, 
                        @endif
                    @endforeach
                @else
                    -
                @endif
                </p>
            </div>
            {{-- Associated majors--}}
            <div class="col">
                <p class="fw-bold mb-1">Target Majors</p>
                <p>
                @forelse ($event->majors as $major)
                    @if ($loop->last)
                        {{$major->name}}
                    @else
                        {{$major->name}}, 
                    @endif
                @empty
                    -
                @endforelse
                </p>
            </div>
        </div>
        <div class="row">
            {{-- major excl--}}
            <div class="col">
                <p class="fw-bold mb-1">Major exclusive</p>
                {{$event->exclusive_major ? '<p class="text-success">Yes</p>' : '<p class="text-danger">No</p>'}}
            </div>
            {{-- member excl --}}
            <div class="col">
                <p class="fw-bold mb-1">Community member exclusive</p>
                {{$event->exclusive_member ? '<p class="text-success">Yes</p>' : '<p class="text-danger">No</p>'}}
            </div>
        </div>
        <div class="row">
            {{-- form link --}}
            <div class="col">
                <p class="fw-bold mb-1">Additional form link</p>
                <p>{{$event->additional_form_link ?? '-'}}</p>
            </div>
            {{-- highlight --}}
            <div class="col">
                <p class="fw-bold mb-1">Event is highlighted</p>
                {{$event->is_highlighted ? '<p class="text-success">Yes</p>' : '<p class="text-danger">No</p>'}}
            </div>
        </div>
        <div class="row">
            {{-- price --}}
            <div class="col">
                <p class="fw-bold mb-1">Price</p>
                <p>{{$event->price == 0 ? 'Free' : 'Rp. '. number_format($event->price,2,',','.')}}</p>
            </div>
            {{-- max slot --}}
            <div class="col">
                <p class="fw-bold mb-1">Max Slot</p>
                <p>{{$event->max_slot == -1 ? 'No max slot' : $event->max_slot}}</p>
            </div>
        </div>
        <div class="row">
            {{-- image --}}
            <div class="col">
                <p class="fw-bold mb-1">Poster Image</p>
                @if ($event->image)
                <div class="flex-grow-1 d-flex align-items-center align-self-center mb-4">
                    <img src="{{asset('storage/'.$event->image)}}" class="img-fluid" alt="event image poster">
                </div>
                @else
                <p>No image yet</p>
                @endif
            </div>
        </div>
        <div class="row">
            {{-- description--}}
            <div class="col">
                <p class="fw-bold mb-1">Description</p>
                <p>{!! $event->description !!}</p>
            </div>
        </div>
    </div>
</x-ladmin-auth-layout>