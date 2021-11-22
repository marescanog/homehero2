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
                        console.log(response);
                        // if we were to skip the step of SMS verification, we would remove/comment out loadModal Code
                        // Then add in ajax code that adds the worker direct to the DB (the api route that adds a worker)
                    },
                    error: function (response) {
                        // Add/Toggle errors for appropriate feilds
                        // Password
                        // Confirm Password
                        console.log(response);
                    }
                });
                // loadModal("SMS-verification-worker", modalTypes, ()=>{}, getDocumentLevel(),formData);
                enableForm_hideLoadingButton(button, buttonTxt, buttonLoadSpinner, form);

            },
            error: function (response) {
                // display error message when phone number is taken
                console.log(response);
                const data = response["responseJSON"]["response"]["data"];
                const message = response["responseJSON"]["response"]["message"];

                console.log(data);
                console.log(message);

                // Enable forms
                enableForm_hideLoadingButton(button, buttonTxt, buttonLoadSpinner, form);

                // // This function adds an error message to the phone feild if an erro message has not been added
                // // Otherwise it toggles the attributes and classes to show the error
                // const tryDifferentNumber = ()=>{
                //     // Check if there is already an aria added, otherwise don't add and just toggle class and attributes
                //     // Grab the DOM elements
                //     const errorDisplay = document.getElementById("RU_phone-error");
                //     const phoneFeild = document.getElementById("RU_phone");
                //     const phoneFormGroup = document.getElementById("RU_phone_formGroup");

                //     if(errorDisplay == null){
                //         // Add an aria to the feild & new class
                //         const att = document.createAttribute("aria-describedby");       
                //         att.value = "RU_phone-error";                           
                //         phoneFeild.setAttributeNode(att);
                //         phoneFeild.classList.add("is-invalid");
                //         phoneFeild.setAttribute("aria-invalid", "true");

                //         // Create error message
                //         let newDiv = document.createElement("DIV");
                //         newDiv.setAttribute("id", "RU_phone-error");
                //         newDiv.setAttribute("class", "invalid-feedback");
                //         newDiv.innerText = "Phone number is already associated with an existing account. Please enter a different number."

                //         // Append error message
                //         phoneFormGroup.appendChild(newDiv); 
                //     } else {
                //         // errorDisplay Exists and just toggle classes;
                //         phoneFeild.classList.add("is-invalid");
                //         phoneFeild.setAttribute("aria-invalid", "true");
                //         phoneFeild.setAttribute("aria-describedby", "RU_phone-error");

                //         // error display classes and attributes
                //         errorDisplay.setAttribute("id", "RU_phone-error");
                //         errorDisplay.setAttribute("class", "invalid-feedback");
                //         errorDisplay.innerText = "Phone number is already associated with an existing account. Please enter a different number."
                //         errorDisplay.style = "";
                //     }
                    
                // }
                enableErrorDisplayFor("RU_phone","Phone number is already associated with an existing account. Please enter a different number.");

                // For the fourth SWAL button
                $(document).on('click', "#try-diff-number", function() {
                    enableErrorDisplayFor("RU_phone","Phone number is already associated with an existing account. Please enter a different number.");
                    swal.close();
                });

                // Check if the phone number already has an existing user or support account
                if(data.isWorker == true){
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