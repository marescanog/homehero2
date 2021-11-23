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
        // Grab DOM elements for PIN checking
        const smsformData = getFormDataAsObj(form);
        const errorDisplay = document.getElementById("sms-error-display");
        // console.log("SMS form data is (PIN)");
        // console.log(smsformData);

        // Combine the pin codes into one code, format into a single data object with messagebird ID
        const dataToSendToSMSVerification = {};
        const SMSPIN = smsformData['code-1']+smsformData['code-2']+smsformData['code-3']+smsformData['code-4']+smsformData['code-5']+smsformData['code-6'];
        dataToSendToSMSVerification["messagebird_id"] = smsformData["messagebird_id"];
        dataToSendToSMSVerification["pin"] = SMSPIN;

        // console.log(dataToSendToSMSVerification);
        // Verify SMS Code
        // If SMS is correct, proceed with registration
        // Otherwise dont


        // Grab DOM elements to freeze form and the submit button, initiate loading
        const button = document.getElementById("WSMS-submit-btn");
        const buttonTxt = document.getElementById("WSMS-submit-btn-txt");
        const buttonLoadSpinner = document.getElementById("WSMS-submit-btn-load");
        const SMSForm = document.getElementById("SMSVerification"); // This is our form to disable

        // Send Post Request to API
        // Ajax to verify SMS PIN;
        $.ajax({
            type: 'POST',
            url : 'https://slim3api.herokuapp.com/auth/verify-SMS-dummy', // PROD - DUMMY
            // url: 'http://localhost/slim3homeheroapi/public/auth/verify-SMS-dummy', // DEV - DUMMY
            // url: 'http://localhost/slim3homeheroapi/public/auth/check-phone', // PROD - API
            // url: 'http://localhost/slim3homeheroapi/public/auth/check-phone', // DEV - API
            data : dataToSendToSMSVerification,
            success : function(response) {
                // console.log(response);

                // Freeze the form
                disableForm_displayLoadingButton(button, buttonTxt, buttonLoadSpinner, SMSForm);

                // Grab DOM elements for user account creation
                const submitForm = document.getElementById("formData"); // This is our form to submit
                const submitformData = getFormDataAsObj(submitForm);
                console.log("Submit form data is (fnmae,lname, etc)")
                console.log(submitformData);

                // ajax call to submit data and make a new worker, submitformData is the data
                $.ajax({
                    type: 'POST',
                    url : 'https://slim3api.herokuapp.com/auth/worker/create-account', // PROD 
                    //url: 'http://localhost/slim3homeheroapi/public/auth/worker/create-account', // DEV
                    data : submitformData,
                    success : function(response) {
                        //console.log("your response after account creation is:")
                        //console.log(response);
                        // Redirect to Registration Auth then Worker Registration pages
                        let data = {};
                        data['registration_token'] = response.response.data.token;
                        data['hasRegistered'] = false;
                        //console.log("your data token is");
                        //console.log(data);
                        // an ajax to assign registration session token
                        $.ajax({
                            type : 'POST',
                            url : getDocumentLevel()+'/auth/register-auth.php',
                            data : data,
                            success : function(response) {
                                var res = JSON.parse(response);
                                // Your response after register-auth is
                                console.log(res)
                                if(res["status"] == 200){
                                    // Unfreeze the form & Rest
                                    disableForm_displayLoadingButton(button, buttonTxt, buttonLoadSpinner, SMSForm);
                                    $('#SMSVerification')[0].reset();
                                    Swal.fire({
                                        title: 'Phone number verification success!',
                                        text: 'Redirecting you to the registration pages...',
                                        icon: "success",
                                        timer: 3500,
                                        showCancelButton: false,
                                        showConfirmButton: false,
                                        timerProgressBar: true,
                                        }).then(result => {
                                        window.location = getDocumentLevel()+'/pages/worker/register.php';
                                    })
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Something went wrong! Please try again',
                                        icon: 'error',
                                        confirmButtonText: 'ok'
                                    })
                                }
                            }
                        });
                    },
                    error: function(response){
                        console.log(response);
                    }
                });
            },
            error: function (response) {
                console.log(response);
                enableForm_hideLoadingButton(button, buttonTxt, buttonLoadSpinner, SMSForm);
                // Either Invalid Incorrect PIN or something wrong with API
                // CLEAN UP - make errorDisplay display a new message "PIN Entered is invalid" instead of SWAL Alert
                Swal.fire({
                    title: 'Incorrect PIN code!',
                    text: "Please try enter the PIN code sent to your mobile device.",
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
            },
        });

        // On success remove SMS error message if applicable
        if(!errorDisplay.classList.contains('d-none')){
            errorDisplay.classList.add('d-none');
        }

    }
});