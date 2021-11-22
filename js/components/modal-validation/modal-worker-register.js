$("#registerForm").validate({
    rules: {
        first_name: {
            maxlength: 50
        },
        last_name:{
            maxlength: 50
        },
        phone_number:{
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
        phone_number: {
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
        const formData = getFormDataAsObj(form);

        // erase error message from ajax phone number
        // ajax to check phone number;
        // Freeze modal
        // display error message when phone number is taken

        // console.log(formData);
        // check if phone number exists via ajax
        // if exists pass the data to the load modal form
        loadModal("SMS-verification-worker", modalTypes, ()=>{}, getDocumentLevel(),formData);
        // if not exists ask user to log in using the phone number
    }
});
// '[name="password"]'