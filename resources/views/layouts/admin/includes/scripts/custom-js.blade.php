<script>
    $(function() {
        'use strict';
        $(document).ready(function() {
            $('#formValidation').validate({
                errorPlacement: function(error, element) {
                    console.log(error , 'errpr')
                    error.addClass("invalid-feedback");
                    if (element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
                        error.insertAfter(element.parent().parent());
                    } else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                        error.appendTo(element.parent().parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function(element, errorClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                },
                ignore: [],
                submitHandler: function(form) {
                    console.log("Form is valid and ready for submission!");
                    form.submit();
                }
            });

            $.validator.addMethod("filesize", function(value, element, param) {
                if (element.files && element.files.length > 0) {
                    for (var i = 0; i < element.files.length; i++) {
                        if (element.files[i].size > param) {
                            return false;
                        }
                    }
                }
                return true;
            }, "File size must be less than {0} bytes.");
            console.log("Validation setup completed");
        });

    });
</script>
