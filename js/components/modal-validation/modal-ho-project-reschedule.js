$("#modal-reschedule-project").validate({
    rules: {
        date:{
            required: true,
        },
        time:{
            required: true,
        }
    },
    messages: {
        date:{
            required: 'Please select a new date for your project.',
            min: "Please select a date that is beyond today's date"
        },
        time:{
            required: 'Please select a start time for your project.',
        }
    },
    submitHandler: function(form, event) { 
        event.preventDefault();
        const button = document.getElementById("RU-submit-btn");
        const buttonTxt = document.getElementById("RU-submit-btn-txt");
        const buttonLoadSpinner = document.getElementById("RU-submit-btn-load");
        const formData = getFormDataAsObj(form);
        disableForm_displayLoadingButton(button, buttonTxt, buttonLoadSpinner, form);

        console.log("RESCHEDULE PROJECT");
        // format time
        if(formData["time"].length != 8){
            formData["time"] = formData["time"]+':00';
        }
        if(formData["time"].length > 8){
            formData["time"] = formData["time"].substring(0,8);;
        }
        // console.log(formData);

        // Ajax to get the bearer token
        $.ajaxSetup({cache: false})
        $.get(getDocumentLevel()+'/auth/get-register-session.php', function (data) {
            // console.log(data)
            const parsedSession = JSON.parse(data);
            const token = parsedSession['token'];
            console.log(token);
            console.log(formData);

            // Create new form 
            const samoka = new FormData();

            // Append information
            // samoka.append('id', formData["id"]);
            samoka.append('date', formData["date"]);
            samoka.append('time', formData["time"]);

            // Ajax to update the job post schedule
            $.ajax({
                type: 'POST',
                // url : '', // prod (no deployed Production link)
                url: 'http://localhost/slim3homeheroapi/public/homeowner/update-schedule/'+formData["id"], // dev
                contentType: false,
                processData: false,
                headers: {
                    "Authorization": `Bearer ${token}`
                },
                data : samoka,
                success : function(response) {
                    console.log("your response after rescheduling is:")
                    console.log(response);

                    // Inform user & refresh page
                    Swal.fire({
                    title: 'Success!',
                    text: 'Job Post has been rescheduled!',
                    icon: 'success'
                    }).then( result =>{
                        window.location = getDocumentLevel()+'/pages/homeowner/projects.php';
                    });
                    // Enable buttons & close Modal
                    $('#modal').modal('hide');

                },

                // START - ON SERVER ERROR OR JWT ERROR
                error: function (response) {
                    console.log(response);
                    // console.log(response.responseJSON);
                    //   console.log(response.responseJSON['message']);
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

            }); // closing for ajax reschedule request

        }); // closing for ajax setup get token session

    } // closing for submit handler

}); // closing for JQUERY validation