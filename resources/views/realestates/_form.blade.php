@php
    // dd($estate);
    $isEdit = isset($estate);
    
    $name            = old('name', $isEdit ? $estate->name : '');
    $real_state_type = old('real_state_type', $isEdit ? $estate->real_state_type : '');
    $street          = old('street', $isEdit ? $estate->street : '');
    $external_number = old('external_number', $isEdit ? $estate->external_number : '');
    $internal_number = old('internal_number', $isEdit ? $estate->internal_number : '');
    $neighborhood    = old('neighborhood', $isEdit ? $estate->neighborhood : '');
    $city            = old('city', $isEdit ? $estate->city : '');
    $country         = old('country', $isEdit ? $estate->country : '');
    $rooms           = old('rooms', $isEdit ? $estate->rooms : '');
    $bathrooms       = old('bathrooms', $isEdit ? $estate->bathrooms : '');
    $comments        = old('comments', $isEdit ? $estate->comments : '');
@endphp

<form action="{{ $formAction }}" method="POST" id="propertyForm">
    @csrf
    
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $name }}" required>
    </div>
    <div class="form-group">
        <label for="real_state_type">Real Estate Type:</label>
        <select name="real_state_type" id="real_state_type" class="form-control" required>
            <option value="">Select type</option>
            <option value="house" {{ $real_state_type == 'house' ? 'selected' : '' }}>House</option>
            <option value="department" {{ $real_state_type == 'department' ? 'selected' : '' }}>Department</option>
            <option value="land" {{ $real_state_type == 'land' ? 'selected' : '' }}>Land</option>
            <option value="commercial_ground" {{ $real_state_type == 'commercial_ground' ? 'selected' : '' }}>Commercial Ground</option>
        </select>
    </div>
    <div class="form-group">
        <label for="street">Street:</label>
        <input type="text" name="street" id="street" class="form-control" value="{{ $street }}" required>
    </div>
    <div class="form-group">
        <label for="external_number">External Number:</label>
        <input type="text" name="external_number" id="external_number" class="form-control" value="{{ $external_number }}" required>
    </div>
    <div class="form-group">
        <label for="internal_number">Internal Number (if applicable):</label>
        <input type="text" name="internal_number" id="internal_number" class="form-control" value="{{ $internal_number }}">
    </div>
    <div class="form-group">
        <label for="neighborhood">Neighborhood:</label>
        <input type="text" name="neighborhood" id="neighborhood" class="form-control" value="{{ $neighborhood }}" required>
    </div>
    <div class="form-group">
        <label for="city">City:</label>
        <input type="text" name="city" id="city" class="form-control" value="{{ $city }}" required>
    </div>
    <div class="form-group">
        <label for="country">Country (ISO Code):</label>
        <input type="text" name="country" id="country" class="form-control" value="{{ $country }}" maxlength="2" required>
    </div>
    <div class="form-group">
        <label for="rooms">Rooms:</label>
        <input type="number" name="rooms" id="rooms" class="form-control" value="{{ $rooms }}" required>
    </div>
    <div class="form-group">
        <label for="bathrooms">Bathrooms:</label>
        <input type="number" name="bathrooms" id="bathrooms" class="form-control" value="{{ $bathrooms }}" required>
    </div>
    <div class="form-group">
        <label for="comments">Comments:</label>
        <input type="text" name="comments" id="comments" class="form-control" value="{{ $comments }}">
    </div>
    <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Update' : 'Create' }}</button>
</form>
