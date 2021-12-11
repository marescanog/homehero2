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

        // If validation is successful, process request
        if(complete) {
            disableForm_displayLoadingButton(button, buttonTxt, buttonLoadSpinner, form);
            console.log("RATE ORDER");
            console.log(formData);

            // Ajax to get the bearer token
            $.ajaxSetup({cache: false})
            $.get(getDocumentLevel()+'/auth/get-register-session.php', function (data) {
                // console.log(data)
                const parsedSession = JSON.parse(data);
                const token = parsedSession['token'];
                console.log(token);

                // Create new form 
                const samoka = new FormData();

                // Append information
                // samoka.append('job_order_id', formData["job_order_id"]);
                samoka.append('quality', formData["overall_quality"]);
                samoka.append('professionalism', formData["professionalism"]);
                samoka.append('punctuality', formData["punctuality"]);
                samoka.append('reliability', formData["reliability"]);
                samoka.append('comment', formData["comment"]);

                // Ajax to save rating
                $.ajax({
                    type: 'POST',
                    // url : '', // prod (no live deployed api route)
                    url: 'http://localhost/slim3homeheroapi/public/homeowner/save-rating/'+formData["job_order_id"], // dev
                    contentType: false,
                    processData: false,
                    headers: {
                        "Authorization": `Bearer ${token}`
                    },
                    data : samoka,
                    success : function(response) {
                        // console.log("your response after account login is:")
                        // console.log(response);
                        // Inform user & refresh page
                        Swal.fire({
                            title: 'Thank you!',
                            text: 'Your rating has been submitted.',
                            icon: 'success'
                            }).then( result =>{
                                window.location = getDocumentLevel()+'/pages/homeowner/projects.php?tab=closed';
                            });
                            // Enable buttons & close Modal
                            $('#modal').modal('hide');
                    },

                    // START - ON SERVER ERROR OR JWT ERROR
                    error: function (response) {
                        console.log(response);
                        console.log(response.responseJSON);
                        console.log(response.responseJSON['message']);
                        if(response.responseJSON['success'] == false){
                            let message = response.responseJSON['response']['message'];
                            let JWTisssue = false;
                            if(message != undefined && message != null && message != "" && message.substring(0, 3) == "JWT"){
                                message = "Token expired or not recognized. Please try logging into your account again.";
                                JWTisssue = true;
                            }
                            Swal.fire({
                            title: 'An error occurred',
                            text: message,
                            icon: 'error'
                            }).then((result) => {
                                // logout if token expired
                                if(JWTisssue == true){
                                    $.ajax({
                                    type : 'GET',
                                    url : '../../auth/signout_action.php',
                                    success : function(response) {
                                        var res = JSON.parse(response);
                                        if(res["status"] == 200){
                                            window.location = '../../';
                                        }
                                    }
                                    });
                                } else {
                                    // Enable buttons & close Modal
                                    $('#modal').modal('hide');
                                }
                            })
                        } else {
                            // Inform user
                            Swal.fire({
                            title: 'An error occurred',
                            text: 'Please try again',
                            icon: 'error'
                            });
                            // Enable buttons & close Modal
                            $('#modal').modal('hide');
                        }
                    }
                    // END - ON SERVER ERROR OR JWT ERROR

                }); // closing bracket for ajax request to save rating

            }); // closing bracket for ajax setup bearer token

        } // closing bracket for custom validation stars

    } // closing bracket for submit handler

}) // closing bracket for respect validation 