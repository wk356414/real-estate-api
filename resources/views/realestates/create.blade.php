@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">Add New Property</h1>
    <form id="createPropertyForm" action="{{ route('realestates.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="real_state_type">Real Estate Type:</label>
            <select name="real_state_type" id="real_state_type" class="form-control" required>
                <option value="">Select type</option>
                <option value="house">House</option>
                <option value="department">Department</option>
                <option value="land">Land</option>
                <option value="commercial_ground">Commercial Ground</option>
            </select>
        </div>
        <div class="form-group">
            <label for="street">Street:</label>
            <input type="text" class="form-control" id="street" name="street" value="{{ old('street') }}" required>
        </div>
        <div class="form-group">
            <label for="external_number">External Number:</label>
            <input type="text" class="form-control" id="external_number" name="external_number" value="{{ old('external_number') }}" required>
        </div>
        <div class="form-group">
            <label for="internal_number">Internal Number (if applicable):</label>
            <input type="text" class="form-control" id="internal_number" name="internal_number" value="{{ old('internal_number') }}">
        </div>
        <div class="form-group">
            <label for="neighborhood">Neighborhood:</label>
            <input type="text" class="form-control" id="neighborhood" name="neighborhood" value="{{ old('neighborhood') }}" required>
        </div>
        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
        </div>
        <div class="form-group">
            <label for="country">Country (ISO Code):</label>
            <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}" maxlength="2" required>
        </div>
        <div class="form-group">
            <label for="rooms">Rooms:</label>
            <input type="number" class="form-control" id="rooms" name="rooms" value="{{ old('rooms') }}" required>
        </div>
        <div class="form-group">
            <label for="bathrooms">Bathrooms:</label>
            <input type="number" step="0.01" class="form-control" id="bathrooms" name="bathrooms" value="{{ old('bathrooms') }}" required>
        </div>
        <div class="form-group">
            <label for="comments">Comments:</label>
            <input type="text" class="form-control" id="comments" name="comments" value="{{ old('comments') }}">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection

@section('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- jQuery Validation Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <!-- Additional Methods Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
    <script>
        $(document).ready(function() {
            // Check that the plugin is loaded
            if (!$.validator) {
                console.error('jQuery Validation Plugin is not loaded.');
                return;
            }

            // Custom validation method: requiredIf
            $.validator.addMethod("requiredIf", function(value, element, params) {
                var target = $(params[0]);
                var requiredValues = params[1];
                if ($.inArray(target.val(), requiredValues) !== -1) {
                    return $.trim(value).length > 0;
                }
                return true;
            }, "This field is required.");

             // Custom validation method for bathrooms field
             $.validator.addMethod("bathroomsValidation", function(value, element) {
                // Get the real state type value
                var type = $("#real_state_type").val();
                // Convert the value to a float number
                var val = parseFloat(value);
                // If type is 'land' or 'commercial_ground', allow zero or greater.
                if ($.inArray(type, ['land', 'commercial_ground']) !== -1) {
                    return val <= 0;
                }
                // For other types, the number must be greater than zero.
                return val > 0;
            }, "Bathrooms must be greater than zero unless the property is land or commercial ground.");

            $("#createPropertyForm").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 128
                    },
                    real_state_type: {
                        required: true
                    },
                    street: {
                        required: true,
                        maxlength: 128
                    },
                    external_number: {
                        required: true,
                        maxlength: 12,
                        pattern: /^[A-Za-z0-9\-]+$/
                    },
                    internal_number: {
                        requiredIf: ['#real_state_type', ['department', 'commercial_ground']],
                        maxlength: 128,
                        pattern: /^[A-Za-z0-9\- ]*$/
                    },
                    neighborhood: {
                        required: true,
                        maxlength: 128
                    },
                    city: {
                        required: true,
                        maxlength: 64
                    },
                    country: {
                        required: true,
                        minlength: 2,
                        maxlength: 2
                    },
                    rooms: {
                        required: true,
                        number: true,
                        min: 1
                    },
                    bathrooms: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    comments: {
                        maxlength: 128
                    }
                },
                messages: {
                    name: {
                        required: "Please enter a name",
                        maxlength: "Name cannot exceed 128 characters"
                    },
                    real_state_type: {
                        required: "Please select a type"
                    },
                    street: {
                        required: "Please enter a street",
                        maxlength: "Street cannot exceed 128 characters"
                    },
                    external_number: {
                        required: "Please enter an external number",
                        maxlength: "External number cannot exceed 12 characters",
                        pattern: "Only alphanumerics and dashes are allowed"
                    },
                    internal_number: {
                        pattern: "Only alphanumerics, dashes, and spaces are allowed"
                    },
                    neighborhood: {
                        required: "Please enter a neighborhood",
                        maxlength: "Neighborhood cannot exceed 128 characters"
                    },
                    city: {
                        required: "Please enter a city",
                        maxlength: "City cannot exceed 64 characters"
                    },
                    country: {
                        required: "Please enter a country code",
                        minlength: "Country code must be 2 characters",
                        maxlength: "Country code must be 2 characters"
                    },
                    rooms: {
                        required: "Please enter the number of rooms",
                        number: "Please enter a valid number",
                        min: "At least one room is required"
                    },
                    bathrooms: {
                        required: "Please enter the number of bathrooms",
                        number: "Please enter a valid number",
                        min: "Bathrooms cannot be negative"
                    },
                    comments: {
                        maxlength: "Comments cannot exceed 128 characters"
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
        $('body').on('change','#real_state_type',function(){
            var real_state_type = $(this).val();
            if(real_state_type == 'land'){
                $('#bathrooms').val(0)
                $('#bathrooms').prop('disabled',true)
            }else if(real_state_type == 'commercial_ground'){
                $('#bathrooms').val(0)
                $('#bathrooms').prop('disabled',true)
            }else{
                $('#bathrooms').prop('disabled',false)
            }
        })
    </script>
@endsection