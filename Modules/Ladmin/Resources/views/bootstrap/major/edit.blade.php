<x-ladmin-auth-layout>
    <x-slot name="title">Edit Major</x-slot>
    <form action="{{ route('ladmin.major.update') }}" method="POST">
        @csrf
        <div class="row d-flex align-items-center mb-3">
            <label for="name" class="form-label col-lg-3">Name <span class="text-danger">*</span></label>
            <x-ladmin-input id="name" type="text" class="col" required name="name" 
                value="{{ old('name', $major->name) }}" placeholder="Name" />
        </div>
        <div class="row d-flex align-items-center mb-3">
            <label for="faculty_id" class="form-label col-lg-3">Faculty <span class="text-danger">*</span></label>
            <div class="col">
                <select name="faculty_id" id="faculty_id" class="form-select form-control @error('faculty_id') is-invalid @enderror">
                    <option value="" disabled>Select faculty</option>
                    @foreach ($faculties as $faculty)
                        <option {{ $faculty->id == $major->faculty_id ? 'selected' : '' }} value="{{$faculty->id}}">
                            {{ $faculty->name }}</option>
                    @endforeach
                </select>
                @error('faculty_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="text-end">
            <x-ladmin-button>Submit</x-ladmin-button>
        </div>
    </form>
</x-ladmin-auth-layout>