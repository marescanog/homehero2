jQuery.validator.setDefaults({
    onfocusout: function (e) {
        this.element(e);
    },
    onkeyup: false,

    highlight: function (element) {
        if(jQuery(element).hasClass('flatpickr-input')){
            if(jQuery(element).attr('readonly') == 'readonly'){
                jQuery(element).next().addClass('is-invalid');
            }
        } else {
            jQuery(element).closest('.form-control').addClass('is-invalid');
        }
    },
    unhighlight: function (element) {
        if(jQuery(element).hasClass('flatpickr-input')){
            if(jQuery(element).attr('readonly') == 'readonly'){
                jQuery(element).next().removeClass('is-invalid');
                jQuery(element).next().addClass('is-valid');
            }
        } else {
            jQuery(element).closest('.form-control').removeClass('is-invalid');
            jQuery(element).closest('.form-control').addClass('is-valid');
        }
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
        else if (element.hasClass('flatpickr-input')){
            element.parent().append(error);
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

jQuery.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than {0');

const _MS_PER_DAY = 1000 * 60 * 60 * 24;

// a and b are javascript Date objects
function dateDiffInDays(a, b) {
    // Discard the time and time-zone information.
    const utc1 = Date.UTC(a.getFullYear(), a.getMonth(), a.getDate());
    const utc2 = Date.UTC(b.getFullYear(), b.getMonth(), b.getDate());

    return Math.floor((utc2 - utc1) / _MS_PER_DAY);
}

jQuery.validator.addMethod('validDate', function (value, element, param) {
    // Get tomorrow's date
    const today = new Date();

    const selectedDate = new Date(value);
    const difference = dateDiffInDays(today, selectedDate);

    return this.optional(element) ||  difference >= 1
}, 'Date must be a valid date beyond today');