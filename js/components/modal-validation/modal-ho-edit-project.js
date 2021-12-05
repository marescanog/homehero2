$("#modal-edit-project").validate({
    rules: {
        date:{
            required: true,
        }
    },
    messages: {
        date:{
            min: "Please select a date that is beyond today's date"
        }
    },
    submitHandler: function(form, event) { 
        event.preventDefault();
        console.log("SQUEEE");
        const button = document.getElementById("RU-submit-btn");
        const buttonTxt = document.getElementById("RU-submit-btn-txt");
        const buttonLoadSpinner = document.getElementById("RU-submit-btn-load");
        const formData = getFormDataAsObj(form);
        disableForm_displayLoadingButton(button, buttonTxt, buttonLoadSpinner, form);

    }
});