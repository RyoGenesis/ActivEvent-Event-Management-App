<div class="row d-flex align-items-center mb-3">
    <label for="username" class="form-label col-lg-3">Username <span class="text-danger">*</span></label>
    <x-ladmin-input id="username" type="text" class="col" required name="username"
        value="{{ old('username', $admin->username) }}" placeholder="Username" />
</div>

<div class="row d-flex align-items-center mb-3">
    <label for="display_name" class="form-label col-lg-3">Display Name <span class="text-danger">*</span></label>
    <x-ladmin-input id="display_name" type="text" class="col" required name="display_name"
        value="{{ old('display_name', $admin->display_name) }}" placeholder="Display Name" />
</div>

<div class="row d-flex align-items-center mb-3">
    <label for="email" class="form-label col-lg-3">E-mail Address <span class="text-danger">*</span></label>
    <x-ladmin-input id="email" type="email" :readonly="$admin->id === auth()->id()" class="col" required name="email"
        value="{{ old('email', $admin->email) }}" placeholder="E-mail Address" />
</div>

<div class="row d-flex align-items-center mb-3">
    <label for="community_id" class="form-label col-lg-3">Associated Community <span class="text-danger">*</span></label>
    <div class="col">
        <select name="community_id" id="community_id" class="form-select form-control @error('community_id') is-invalid @enderror">
            <option value="" selected disabled>Select associated community</option>
            @foreach ($communities as $community)
                <option {{ $community->id == old('community_id',$admin->community_id) ? 'selected' : '' }} value="{{$community->id}}">
                    {{ $community->name }}</option>
            @endforeach
        </select>
        @error('community_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>

<div class="row d-flex align-items-center mb-3">
    <label for="password" class="form-label col-lg-3">
        Password
        @if (!$admin->id)
            <span class="text-danger">*</span>
        @endif
    </label>
    <x-ladmin-input id="password" type="password" :required="!$admin->id" class="col" name="password"
        placeholder="Password" />
</div>

<div class="row d-flex align-items-center mb-3">
    <label for="password_confirmation" class="form-label col-lg-3">
        Password Confirmation
        @if (!$admin->id)
            <span class="text-danger">*</span>
        @endif
    </label>
    <x-ladmin-input id="password_confirmation" :required="!$admin->id" type="password" class="col"
        name="password_confirmation" placeholder="Password Confirmation" />
</div>
