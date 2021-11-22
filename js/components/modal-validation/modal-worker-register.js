$("#registerForm").validate({
    rules: {
        exampleRadios: { // <- NAME of every radio in the same group
            required: true
        },
        password : {
            required: true,
            minlength : 8
        },
        confirm_password : {
            required: true,
            minlength : 8,
            equalTo : '[name="password"]'
        }
    },
    submitHandler: function(form, event) { 
        event.preventDefault();
        alert("Do some stuff...");
        //submit via ajax
    }
});