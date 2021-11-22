/*
    Script to limit input to numbers and enable auto focus change for input once a number is inputted 
    Source: https://stackoverflow.com/questions/10539113/focusing-on-next-input-jquery

    For mobile responsiveness, instead of using type="text", use type="tel", it will bring up the numeric keypad on mobile instead of alphanumeric
    https://stackoverflow.com/questions/6178556/phone-numeric-keyboard-for-text-input
*/
$(function() {
    var charLimit = 1;
    $(".code").keydown(function(e) {
        var keys = [8, 9, /*16, 17, 18,*/ 19, 20, 27, 33, 34, 35, 36, 37, 38, 39, 40, 45, 46, 48, 144, 145];
        if (e.which == 8 && this.value.length == 0) {
            $(this).prev('.code').focus();
        } else if ($.inArray(e.which, keys) >= 0) {
            return true;
        } else if (this.value.length >= charLimit) {
            $(this).next('.code').focus();
            return false;
        } else if (e.shiftKey || e.which <= 48 || e.which >= 58) {
            return false;
        }
    }).keyup (function () {
        if (this.value.length >= charLimit) {
            $(this).next('.code').focus();
            return false;
        }
    });
});

$("#SMSVerification").validate({
    submitHandler: function(form, event) { 
        event.preventDefault();
        const smsformData = getFormDataAsObj(form);
        const errorDisplay = document.getElementById("sms-error-display");
        console.log(smsformData);
        // console.log(errorDisplay);

        if(!errorDisplay.classList.contains('d-none')){
            errorDisplay.classList.add('d-none');
        }

        const submitForm = document.getElementById("formData");
        const submitformData = getFormDataAsObj(submitForm);
        console.log(submitformData);
        // errorDisplay.classList.remove("d-none");

        // if(!$("#sms-error-display").hasClass("d-none")){
        //     $("#sms-error-display").removeClass('d-none');
        // }
        // Verify SMS Code
        // If SMS is correct, proceed with registration
        // Otherwise don
    }
});