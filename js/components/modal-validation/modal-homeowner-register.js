$("#registerForm").validate({
    rules: {
        first_name: {
            maxlength: 50
        },
        last_name:{
            maxlength: 50
        },
        phone:{
            phonePH: true
        },
        password : {
            required: true,
            maxlength: 30
        },
        confirm_password : {
            required: true,
            equalTo : "#password"
        },
        agree: "required"
    },
    messages: {
        first_name:{
            required:  "Please enter your first name",
            maxlength: "First name cannot be beyond 50 characters"
        },
        last_name:{
            required:  "Please enter your last name",
            maxlength: "Last name cannot be beyond 50 characters"
        },
        phone: {
            required: "Please enter your mobile number"
        },
        password:{
            required:  "Please create a password",
            minlength: "Password must be at least 8 characters long",
            maxlength: "Password cannot be beyond 30 characters"
        },
        confirm_password :{
            required:  "Please re-enter the password",
            equalTo : "This field must match entered password"
        },
        agree: "Please agree to our terms and conditions"
    },
    submitHandler: function(form, event) { 
        event.preventDefault();

        // Grab DOM elements & Form data
        const button = document.getElementById("RU-submit-btn");
        const buttonTxt = document.getElementById("RU-submit-btn-txt");
        const buttonLoadSpinner = document.getElementById("RU-submit-btn-load");
        const formData = getFormDataAsObj(form);

        // Grab phone number
        const phoneCheckInDatabase = {}
        phoneCheckInDatabase["phone"] = formData["phone"];

        // console.log("your form data is")
        // console.log(formData);

        // Freeze Form & Disable
        disableForm_displayLoadingButton(button, buttonTxt, buttonLoadSpinner, form);
           
        // Use new route to check user's phone number in DB
        // First ajax checks if phone number is in DB
        $.ajax({
            type: 'GET',
            url : 'https://slim3api.herokuapp.com/auth/check-phone', // PROD
            // url: 'http://localhost/slim3homeheroapi/public/auth/check-phone', // DEV
            data : phoneCheckInDatabase,
            success : function(response) {
                // console.log(response);
                // Second step verifies the password and returns a hashed pass
                // Verify password and get a hashed password
                $.ajax({
                    type: 'POST',
                    url : 'https://slim3api.herokuapp.com/auth/verify-password', // PROD
                    //url: 'http://localhost/slim3homeheroapi/public/auth/verify-password', // DEV
                    data : formData,
                    success : function(response) {
                        // Note: if we were to skip the step of SMS verification, we would remove/comment out loadModal Code
                        // Then add in ajax code that adds the worker direct to the DB (the api route that adds a worker);
                        // Create a new object only containing: firstname, lastname, mobile number and hashedpass/securepass
                        const dataToPassToSMSModal = {};
                        dataToPassToSMSModal["first_name"] = formData["first_name"];
                        dataToPassToSMSModal["last_name"] = formData["last_name"];
                        dataToPassToSMSModal["phone"] = formData["phone"];
                        dataToPassToSMSModal["securepass"] = response['response']['data'];

                        // console.log("your data to pass to the SMS Modal");
                        // console.log(dataToPassToSMSModal);
                        const dataToPassToSMSGeneration = {};
                        dataToPassToSMSGeneration["phone"] = formData["phone"];

                        // Before passing, we call api to generate an SMS code. If the number is inavlid, we display the error
                        // message here, otherwise if valid proceed to show SMS modal
                        $.ajax({
                            type: "POST",
                            url : 'https://slim3api.herokuapp.com//auth/generate-SMS-dummy', // PROD-DUMMY
                            // url: 'http://localhost/slim3homeheroapi/public/auth/generate-SMS-dummy', // DEV-DUMMY,
                            //url : 'https://slim3api.herokuapp.com/auth/verify-password', // PROD-API
                            // url: 'http://localhost/slim3homeheroapi/public/auth/verify-password', // DEV-API,
                            data: dataToPassToSMSGeneration,
                            success: function(response){

                                // Enable forms
                                enableForm_hideLoadingButton(button, buttonTxt, buttonLoadSpinner, form);

                                // If it is a success, then SMS was generated successfully
                                // console.log(response['response']['data']['messagebird_id']);
                                // grab the messagebird id and add it to the dataToPassToSMSModal
                                dataToPassToSMSModal["messagebird_id"] = response['response']['data']['messagebird_id'];

                                // pass the complete form data into the load modal
                                loadModal("SMS-verification-homeowner", modalTypes, ()=>{}, getDocumentLevel(), dataToPassToSMSModal);
                            },
                            error: function (response) {
                                console.log(response);
                                // Either Invalid phone number or something wrong with API
                                Swal.fire({
                                    title: 'Invalid phone number!',
                                    text: "Please try entering a valid phone number",
                                    icon: 'error',
                                    confirmButtonText: 'Try a different number'
                                })
                            }
                        });
                    },
                    error: function (response) {
                        // console.log(response)
                        Swal.fire({
                            title: "Error",
                            text: "Something went wrong. Please try again",
                            icon: "error",
                            
                        });
                    }
                });
            },
            error: function (response) {
                // console.log(response);
                // Either Invalid phone number or something wrong with API
                let res = response.responseJSON;
                // console.log(res);
                // console.log(res.success);
                // console.log(res.response.message);
                // console.log(res.response.data);

                // Check if server error
                if(response.responseJSON.success == false && res.response.message != ""){
                    Swal.fire({
                        title: 'Phone number already taken!',
                        text: res.response.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    // Display Error message
                    enableErrorDisplayFor("RU_phone","Phone number is already associated with an existing account. Please enter a different number.");
                } else {
                    Swal.fire({
                        title: 'Error! Something went wrong with the request',
                        text: "Please try again",
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                  
                }

                // Enable forms
                enableForm_hideLoadingButton(button, buttonTxt, buttonLoadSpinner, form);

            }
        });
        
    }
});
