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
        exampleRadios: { 
            required: true,
            equalTo : "#exampleRadios1",
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
        exampleRadios:{
            required: "Please select Yes or No", 
            equalTo : "You must be over the age of 18 to register."
        },
        agree: "Please agree to our terms and conditions"
    },
    submitHandler: function(form, event) { 
        event.preventDefault();
        alert("Do some stuff...");
        //submit via ajax
    }
});
// '[name="password"]'