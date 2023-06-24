<x-ladmin-auth-layout>
    <x-slot name="title">Add New Event</x-slot>
    <form action="{{ route('ladmin.student_user.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- name --}}
        <div class="row d-flex align-items-center mb-3">
            <label for="name" class="form-label col-lg-3">Name <span class="text-danger">*</span></label>
            <x-ladmin-input id="name" type="text" class="col" required name="name" 
                value="{{ old('name') }}" placeholder="Name" />
        </div>
        {{-- community id --}}
        <div class="row d-flex align-items-center mb-3">
            <label for="community_id" class="form-label col-lg-3">Associated community <span class="text-danger">*</span></label>
            <div class="col">
                <select name="community_id" id="community_id" class="form-select form-control @error('community_id') is-invalid @enderror">
                    <option value="{{$community->id}}" selected>{{ $community->name }}</option>
                </select>
                @error('community_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        {{-- location --}}
        <div class="row d-flex align-items-center mb-3">
            <label for="location" class="form-label col-lg-3">Location <span class="text-danger">*</span></label>
            <x-ladmin-input id="location" type="text" class="col" required name="location" 
                value="{{ old('location') }}" placeholder="Location" />
        </div>
        {{-- date --}}
        <div class="row d-flex align-items-center mb-3">
            <label for="date" class="form-label col-lg-3">Event date <span class="text-danger">*</span></label>
            <input type="datetime-local" id="date" name="date" value="{{ old('date') ?? null }}" 
                class="col form-control @error('date') is-invalid @enderror" placeholder="Event Date" required/>
            @error('date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        {{-- regis end date --}}
        <div class="row d-flex align-items-center mb-3">
            <label for="registration_end" class="form-label col-lg-3">Registrastion end date <span class="text-danger">*</span></label>
            <input type="datetime-local" id="registration_end" name="registration_end" value="{{ old('registration_date') ?? null }}" 
                class="col form-control @error('registration_end') is-invalid @enderror" placeholder="Registration End Date" required/>
            @error('registration_end')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        {{-- category --}}
        <div class="row d-flex align-items-center mb-3">
            <label for="category_id" class="form-label col-lg-3">Category <span class="text-danger">*</span></label>
            <div class="col">
                <select name="category_id" id="category_id" data-placeholder="Select category" class="form-select form-control @error('category_id') is-invalid @enderror">
                    <option></option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        {{-- topic --}}
        <div class="row d-flex align-items-center mb-3">
            <label for="topic" class="form-label col-lg-3">Topic <span class="text-danger">*</span></label>
            <x-ladmin-input id="topic" type="text" class="col" required name="topic"
                value="{{ old('topic') }}" placeholder="Topic" />
        </div>
        {{-- description --}}
        <div class="row d-flex align-items-center mb-3">
            <label for="topic" class="form-label col-lg-3">Description <span class="text-danger">*</span></label>
            <textarea name="description" id="description" class="col form-control" rows="10">

            </textarea>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        {{-- speaker --}}
        <div class="row d-flex align-items-center mb-3">
            <label for="speaker" class="form-label col-lg-3">Speaker</label>
            <x-ladmin-input id="speaker" type="text" class="col" name="speaker"
                value="{{ old('speaker') }}" placeholder="Speaker" />
        </div>
        {{-- has certificate --}}
        <div class="row d-flex align-items-center mb-3">
            <label for="has_certificate" class="form-label col-lg-3">Provide certificate</label>
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="has_certificate" name="has_certificate" aria-label="Provide certificate">
                </div>
                @error('has_certificate')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- has comserv --}}
        <div class="row d-flex align-items-center mb-3">
            <label for="has_comserv" class="form-label col-lg-3">Provide community service hour</label>
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="has_comserv" name="has_comserv" aria-label="Provide community service hour">
                </div>
                @error('has_comserv')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- SAT level and has SAT --}}
        <div class="row d-flex align-items-center mb-3">
            <label for="sat_level_id" class="form-label col-lg-3">SAT level</label>
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="has_sat" name="has_sat">
                    <label class="form-check-label" for="has_sat">
                        Provide SAT
                    </label>
                </div>
                <select name="sat_level_id" id="sat_level_id" data-placeholder="Select SAT Level" class="form-select form-control @error('sat_level_id') is-invalid @enderror" disabled>
                    <option></option>
                    @foreach ($sat_levels as $level)
                        <option value="{{$level->id}}">{{ $level->name }}</option>
                    @endforeach
                </select>
                @error('sat_level_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- contact person --}}
        <div class="row d-flex align-items-center mb-3">
            <label for="contact_person" class="form-label col-lg-3">Contact person</label>
            <x-ladmin-input id="contact_person" type="text" class="col" name="contact_person"
                value="{{ old('contact_person') }}" placeholder="Contact Person" />
        </div>
        {{-- form link --}}
        <div class="row d-flex align-items-center mb-3">
            <label for="additional_form_link" class="form-label col-lg-3">Additional form link</label>
            <x-ladmin-input id="additional_form_link" type="text" class="col" name="additional_form_link"
                value="{{ old('additional_form_link') }}" placeholder="Additional Form Link" />
        </div>
        {{-- image --}}
        <div class="row d-flex align-items-center mb-3">
            <label for="image" class="form-label col-lg-3">Poster image</label>
            <input type="file" class="col form-control" name="image" id="image">
            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        {{-- price --}}
        <div class="row d-flex align-items-center mb-3">
            <label for="price" class="form-label col-lg-3">Price</label>
            <x-ladmin-input id="price" type="number" class="col" name="price"
                value="{{ old('price') ?? 0 }}" placeholder="Price" min="0" />
        </div>
        {{-- max slot --}}
        <div class="row d-flex align-items-center mb-3">
            <div class="col-lg-3">
                <label for="max_slot" class="form-label">Maximum slot</label>
                <span class="text-muted">Leave it empty if event has no maximum slot</span>
            </div>
            <x-ladmin-input id="max_slot" type="number" class="col" name="max_slot"
                value="{{ old('max_slot') }}" placeholder="Maximum Slot" />
        </div>
        {{-- majors --}}
        <div class="row d-flex align-items-center mb-3">
            <label for="majors" class="form-label col-lg-3">Majors <span class="text-danger">*</span></label>
            <div class="col">
                <select name="majors[]" id="majors" data-placeholder="Select majors" class="form-select form-control @error('majors') is-invalid @enderror" multiple>
                    @foreach ($majors as $major)
                        <option value="{{$major->id}}">{{ $major->name }}</option>
                    @endforeach
                </select>
                @error('majors')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- excl major --}}
        <div class="row d-flex align-items-center mb-3">
            <label for="exclusive_major" class="form-label col-lg-3">Major exclusive</label>
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="exclusive_major" name="exclusive_major" aria-label="Major exclusive">
                </div>
                @error('exclusive_major')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- excl member --}}
        <div class="row d-flex align-items-center mb-3">
            <label for="exclusive_member" class="form-label col-lg-3">Community member exclusive</label>
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="exclusive_member" name="exclusive_member" aria-label="Community member exclusive">
                </div>
                @error('exclusive_member')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="text-end">
            <x-ladmin-button>Submit</x-ladmin-button>
        </div>
    </form>
    <x-slot name="scripts">
        <script>
            $('#category_id').select2({
                theme: "bootstrap-5",
                width: $( this ).data('width') ? $(this).data('width') : $(this).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
            });

            $('#majors').select2({
                theme: "bootstrap-5",
                width: $( this ).data('width') ? $(this).data('width') : $(this).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: false,
                allowClear: true,
            });

            $(document).ready(function() {
                // $('#faculty_id').change(function() {
                //     $.ajax({
                //         url : '{{ env("APP_URL") }}' + '/api/faculty-majors',
                //         type : 'get',
                //         data : {
                //             id: $(this).val(),
                //         },
                //         success : function (response) {
                //             var majorId = $("#major_id");
                //             majorId.html('');
                //             majorId.append("<option></option>");
                //             $.each(response, function (i, item) {
                //                 majorId.append("<option value='" + item['id'] + "'>" + item['name'] + "</option>");
                //             });
                //             majorId.prop('disabled',false);
                //         },
                //         error: function(err) {
                //         }
                //     })
                // });
            });
        </script>
    </x-slot>
</x-ladmin-auth-layout>