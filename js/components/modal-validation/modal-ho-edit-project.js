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

        const button = document.getElementById("RU-submit-btn");
        const buttonTxt = document.getElementById("RU-submit-btn-txt");
        const buttonLoadSpinner = document.getElementById("RU-submit-btn-load");
        const formData = getFormDataAsObj(form);
        disableForm_displayLoadingButton(button, buttonTxt, buttonLoadSpinner, form);
        console.log("EDIT JOB POST");
        // console.log(formData);


        // Ajax to get the bearer token
        $.ajaxSetup({cache: false})
        $.get(getDocumentLevel()+'/auth/get-register-session.php', function (data) {
            console.log(data)
            const parsedSession = JSON.parse(data);
            const token = parsedSession['token'];
            console.log(token);

            // Create new form 
            const samoka = new FormData();

            // Append information
            samoka.append('date', formData["date"]);
            samoka.append('home_id', formData["home_id"]);
            // samoka.append('id', formData["id"]); // no need to append since it is attached to url
            samoka.append('job_description', formData["job_description"]);
            samoka.append('job_post_name', formData["job_post_name"]);
            samoka.append('job_size_id', formData["job_size_id"]);
            samoka.append('rate_offer', formData["rate_offer"]);
            samoka.append('rate_type_id', formData["rate_type_id"]);

            // format time
            if(formData["time"].length != 8){
                formData["time"] = formData["time"]+':00';
            }
            if(formData["time"].length > 8){
                formData["time"] = formData["time"].substring(0,8);;
            }
            samoka.append('time', formData["time"]);

            console.log(formData);

            // NODEPLOYEDPRODLINK
            $.ajax({
                type: 'POST',
                //url : '', // prod (none deployed)
                url: 'http://localhost/slim3homeheroapi/public/homeowner/update-post/'+formData["id"], // dev
                contentType: false,
                processData: false,
                headers: {
                    "Authorization": `Bearer ${token}`
                },
                data : samoka,

                success : function(response) {
                    console.log("your response after editing your post is:")
                    console.log(response);

                    // Inform user & refresh page
                    Swal.fire({
                    title: 'Success!',
                    text: 'Post information has been changed.',
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

            });


        });


    }
});