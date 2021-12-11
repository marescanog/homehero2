// console.log("Modal Profile Edit name is loaded")

$("#modal-profile-edit-name").validate({
    rules: {
        first_name:{
            required: true,
        },
        last_name:{
            required: true,
        }
    },
    messages: {
        first_name:{
            required: "First Name must not be empty."
        },
        last_name:{
            required: "Last Name must not be empty."
        }
    },
    submitHandler: function(form, event) { 
        event.preventDefault();
        const button = document.getElementById("RU-submit-btn");
        const buttonTxt = document.getElementById("RU-submit-btn-txt");
        const buttonLoadSpinner = document.getElementById("RU-submit-btn-load");
        const formData = getFormDataAsObj(form);
        disableForm_displayLoadingButton(button, buttonTxt, buttonLoadSpinner, form);

        console.log("EDIT NAME");
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
            samoka.append('first_name', formData["first_name"]);
            samoka.append('last_name', formData["last_name"]);

            // Ajax to edit the name
            $.ajax({
                type: 'POST',
                // url : '', // prod (No prod route deployed)
                url: 'http://localhost/slim3homeheroapi/public/homeowner/profile-update-name', // dev
                contentType: false,
                processData: false,
                headers: {
                    "Authorization": `Bearer ${token}`
                },
                data : samoka,
                success : function(response) {
                    console.log("your response after cancelling post is:")
                    console.log(response);

                    // Inform user & refresh page
                    Swal.fire({
                    title: 'Success!',
                    text: 'Your name has been updated.',
                    icon: 'success'
                    }).then( result =>{
                        window.location = getDocumentLevel()+'/pages/homeowner/profile.php';
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

            }); // inner AJAX close (submit cancel request)

        }); // outer AJAX close (get session variable)

    } // submithandler close JQUERY validate

}); // validate close JQUERY validate