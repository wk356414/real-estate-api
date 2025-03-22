
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
<script>
    $(document).ready(function() {
        // custom Validation method for Bathrooms
        $.validator.addMethod("bathroomsValidation", function(value, element) {
            var type = $("#real_state_type").val();
            var val = parseFloat(value);
            if ($.inArray(type, ['land', 'commercial_ground']) !== -1) {
                return val >= 0;
            }
            return val > 0;
        }, "Bathrooms must be greater than zero unless the property is land or commercial ground.");

        // cusom requiredIf method
        $.validator.addMethod("requiredIf", function(value, element, params) {
            var target = $(params[0]);
            var requiredValues = params[1];
            if ($.inArray(target.val(), requiredValues) !== -1) {
                return $.trim(value).length > 0;
            }
            return true;
        }, "This field is required.");

        $("#propertyForm").validate({
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