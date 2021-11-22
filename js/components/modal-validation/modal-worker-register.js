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
        above18: { 
            required: true,
            equalTo : "#above18-yes",
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
        above18:{
            required: "Please select Yes or No", 
            equalTo : "You must be over the age of 18 to register."
        },
        agree: "Please agree to our terms and conditions"
    },
    submitHandler: function(form, event) { 
        event.preventDefault();

        // Grab DOM elements & Form data
        const button = document.getElementById("RW-submit-btn");
        const buttonTxt = document.getElementById("RW-submit-btn-txt");
        const buttonLoadSpinner = document.getElementById("RW-submit-btn-load");
        const formData = getFormDataAsObj(form);

        // Freeze Form & Disable
        disableForm_displayLoadingButton(button, buttonTxt, buttonLoadSpinner, form);
           
        // Send Post Request to API
        // Ajax to check phone number;
        $.ajax({
            type: 'GET',
            url : 'https://slim3api.herokuapp.com/auth/check-phone', // PROD
            // url: 'http://localhost/slim3homeheroapi/public/auth/check-phone', // DEV
            data : formData,
            success : function(response) {
                console.log(response);
                // Proceed to SMS verification to submit with Ajax for worker creation.
                // Verify password and get a hashed password
                $.ajax({
                    type: 'GET',
                    url : 'https://slim3api.herokuapp.com/auth/verify-password', // PROD
                    // url: 'http://localhost/slim3homeheroapi/public/auth/verify-password', // DEV
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
                                // If it is a success, then SMS was generated successfully
                                // console.log(response['response']['data']['messagebird_id']);
                                // grab the messagebird id and add it to the dataToPassToSMSModal
                                dataToPassToSMSModal["messagebird_id"] = response['response']['data']['messagebird_id'];

                                // pass the complete form data into the load modal
                                loadModal("SMS-verification-worker", modalTypes, ()=>{}, getDocumentLevel(), dataToPassToSMSModal);
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

                        // pass that form data into the load modal (This can be used in the event we skip SMS, just change load modal to ajax directly saving dataToPassToSMSModal to db)
                        // loadModal("SMS-verification-worker", modalTypes, ()=>{}, getDocumentLevel(), dataToPassToSMSModal);                        
                    },
                    error: function (response) {
                        // CLEANUP ADD/TOGGLE ERRORS FOR APPROPRIATE FEILDS
                        // enableErrorDisplayFor(ID,MESSAGE) for the ff:;
                        // id="(id_name)_formGroup" to the div with formgroup class for the ff.
                            // Password
                            // Confirm Password
                        console.log(response);
                    }
                });
                
                enableForm_hideLoadingButton(button, buttonTxt, buttonLoadSpinner, form);

            },
            // CLEANUP -> ADD APPROPRIATE NAVIGATION TO LOGIN MODALS INSTEAD OF SWAL DISPLAY
            error: function (response) {
                // display error message when phone number is taken
                // console.log(response);
                const data = response["responseJSON"]["response"]["data"];
                const message = response["responseJSON"]["response"]["message"];

                // console.log(data);
                // console.log(message);

                // Enable forms
                enableForm_hideLoadingButton(button, buttonTxt, buttonLoadSpinner, form);

                // Display Error message
                enableErrorDisplayFor("RU_phone","Phone number is already associated with an existing account. Please enter a different number.");

                // For the fourth SWAL button
                $(document).on('click', "#try-diff-number", function() {
                    enableErrorDisplayFor("RU_phone","Phone number is already associated with an existing account. Please enter a different number.");
                    swal.close();
                });

                // Check if the phone number already has an existing user or support account
                if(data.isWorker == true){
                    // CLEANUP TO DO : CHECK IF WORKER HAS FINISHED REGISTRATION
                    // IF NOT FINISHED, REDIRECT TO REGISTRATION PAGES
                    // IF FINISHED SWAL FIRE BELOW
                    Swal.fire({
                        title: 'Phone number already registered to an account!',
                        text: message,
                        icon: 'error',
                        showCancelButton: true,
                        confirmButtonText: 'Try a different number',
                        cancelButtonText: 'Login with this number at worker portal'
                    }). then((result)=>{
                        if (result.isConfirmed) {
                            tryDifferentNumber();
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            // Login with this number
                            // Open Worker Portal
                            loadModal("worker-login",modalTypes,()=>{},getDocumentLevel());
                        }
                    });
                } else {
                    if(data.isHomeowner == true && (data.isSupport == true||data.isAdmin == true)){
                        Swal.fire({
                            title: 'Phone number number already registered to an account!',
                            // text: "This phone number is associated with a homeowner account and a support account. Would you like to try a different number?",
                            icon: 'error',
                            html: "<p>This phone number is associated with a homeowner account and a support account. Would you like to try a different number?</p><button id='try-diff-number' class='btn btn-primary'>Try a different number</button>",
                            showDenyButton: true,
                            showCancelButton: true,
                            confirmButtonText: 'Log in at the homeowner portal instead',
                            cancelButtonText: 'Log in at the support portal instead.',
                            denyButtonText: `Register as a worker with this number`,
                        }). then((result)=>{
                            if (result.isConfirmed) {
                                // redirect to homeowner portal
                                Swal.fire('Redirect to homeowner portal', '', 'info');
                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                // redirect to worker portal
                                Swal.fire('Redirect to worker portal', '', 'info');
                            } else if (result.isDenied) {
                                // Proceed to SMS verification to submit with Ajax for worker creation.
                                Swal.fire('Proceed to SMS verification', '', 'info');
                            } 
                        })
                    } else if (data.isSupport == true||data.isAdmin == true){
                        Swal.fire({
                            title: 'Phone number number already registered to an account!',
                            text: "Looks like you have a support account associated with this number. Would you like to log in as support instead?",
                            icon: 'error',
                            showCancelButton: true,
                            showDenyButton: true,
                            confirmButtonText: 'Try a different phone number instead',
                            cancelButtonText: 'Log in at the support portal instead.',
                            denyButtonText: `Register as a worker with this number`,
                        }).then((result)=>{
                            if (result.isConfirmed) {
                                // try different number
                                enableErrorDisplayFor("RU_phone","Phone number is already associated with an existing account. Please enter a different number.");
                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                // redirect to worker portal
                                Swal.fire('Redirect to support portal', '', 'info');
                            } else if (result.isDenied) {
                                // Proceed to SMS verification to submit with Ajax for worker creation.
                                Swal.fire('Proceed to SMS verification', '', 'info');
                            } 
                        });
                    } else {
                        Swal.fire({
                            title: 'Phone number number already registered to an account!',
                            text: "Looks like you have a homeowner account associated with this number. Would you like to log in to your homeowner account instead?",
                            icon: 'error',
                            showCancelButton: true,
                            showDenyButton: true,
                            confirmButtonText: 'Try a different phone number instead',
                            cancelButtonText: 'Log in at the homeowner portal instead',
                            denyButtonText: `Register as a worker with this number`,
                        }).then((result)=>{
                            if (result.isConfirmed) {
                                // try different number
                                enableErrorDisplayFor("RU_phone","Phone number is already associated with an existing account. Please enter a different number.");
                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                // redirect to worker portal
                                Swal.fire('Redirect to homeowner portal', '', 'info');
                            } else if (result.isDenied) {
                                // Proceed to SMS verification to submit with Ajax for worker creation.
                                Swal.fire('Proceed to SMS verification', '', 'info');
                            } 
                        });
                    }
                }

            }
        });


        
    }
});
// '[name="password"]'