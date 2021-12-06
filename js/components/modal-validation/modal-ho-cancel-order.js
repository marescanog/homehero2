$("#cancel-Project-form").validate({
    rules: {
        cancellation_reason:{
            required: true,
        }
    },
    messages: {
        cancellation_reason:{
            required: "Please tell us why you'd like to cancel your project."
        }
    },
    submitHandler: function(form, event) { 
        event.preventDefault();
        const button = document.getElementById("RU-submit-btn");
        const buttonTxt = document.getElementById("RU-submit-btn-txt");
        const buttonLoadSpinner = document.getElementById("RU-submit-btn-load");
        const formData = getFormDataAsObj(form);
        disableForm_displayLoadingButton(button, buttonTxt, buttonLoadSpinner, form);

        console.log("CANCEL ORDER");
        console.log(formData);
    }
});