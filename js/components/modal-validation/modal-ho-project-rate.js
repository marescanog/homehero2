$("#modal-rate-form").validate({
    // rules: {
    //     cancellation_reason:{
    //         required: true,
    //     }
    // },
    // messages: {
    //     cancellation_reason:{
    //         required: "Please tell us why you'd like to cancel your project."
    //     }
    // },
    submitHandler: function(form, event) { 
        event.preventDefault();
        const button = document.getElementById("RU-submit-btn");
        const buttonTxt = document.getElementById("RU-submit-btn-txt");
        const buttonLoadSpinner = document.getElementById("RU-submit-btn-load");
        const formData = getFormDataAsObj(form);
        

        // GET All hidden inputs for star error display & validation
        let complete = true;
        const er1 = document.getElementById("Ov-error");
        const er2 = document.getElementById("Pr-error");
        const er3 = document.getElementById("Re-error");
        const er4 = document.getElementById("Pu-error");
        const overall_input = document.getElementById("overall_quality_feild");
        const prof_input = document.getElementById("professionalism_feild");
        const rel_input = document.getElementById("reliability_feild");
        const pun_input = document.getElementById("punctuality_feild");

        if(overall_input.value == ""){
            if( er1.classList.contains("d-none")){
                er1.classList.remove("d-none")
            }
            complete = false;
        } 

        if(prof_input.value == ""){
            if( er2.classList.contains("d-none")){
                er2.classList.remove("d-none")
            }
            complete = false;
        } 

        if(rel_input.value == ""){
            if( er3.classList.contains("d-none")){
                er3.classList.remove("d-none")
            }
            complete = false;
        } 

        if(pun_input.value == ""){
            if( er4.classList.contains("d-none")){
                er4.classList.remove("d-none")
            }
            complete = false;
        } 

        if(complete) {
            disableForm_displayLoadingButton(button, buttonTxt, buttonLoadSpinner, form);
            console.log("RATE ORDER");
            console.log(formData);
        }

        
    }
});