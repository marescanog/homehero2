jQuery.validator.setDefaults({
    onfocusout: function (e) {
        this.element(e);
    },
    onkeyup: false,

    highlight: function (element) {
        jQuery(element).closest('.form-control').addClass('is-invalid');
    },
    unhighlight: function (element) {
        jQuery(element).closest('.form-control').removeClass('is-invalid');
        jQuery(element).closest('.form-control').addClass('is-valid');
    },

    errorElement: 'div',
    errorClass: 'invalid-feedback',
    errorPlacement: function (error, element) {
        // Error placement for the SMS Verification Modals
        // Remove d-none on success by grabbing ID element
        if(element.hasClass('code')){
            if(element.parent().siblings("#sms-error-display").hasClass('d-none')){
                element.parent().siblings("#sms-error-display").removeClass('d-none')
            }
        }
        // Error placement for the Terms and conditions checkbox
        else if (element.parent().hasClass('form-check')){
            element.parent().append(error);
        } 
        // Error placement for everything else
        else if(element.parent('.input-group-prepend').length) {
            $(element).siblings(".invalid-feedback").append(error);
            //error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    },
});

jQuery.validator.addMethod("phonePH", function(phone_number, element) {
    phone_number = phone_number.replace(/\s+/g, "");
    return this.optional(element) || phone_number.length > 9 && 
    // Regex for phone number pattern with optional space or hyphen
    phone_number.match(/^(09|\+639)\d{2}[- ]?\d{3}[- ]?\d{4}$/);
    // Regex for just phone number format
    // phone_number.match(/^(09|\+639)\d{9}$/);
    // Regex for just hyphens and numbers
    // phone_number.match(/^[+]?[\d]+([\-][\d]+)*\d$/);
}, "Please specify a valid PH phone number");