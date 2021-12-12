$("#modal-profile-add-picture").validate({
    rules: {
        image: {
            required: true,
            extension: "jpeg,jpg,png,JPEG,JPG,PNG",
            filesize: 5000000   //max size 5000 kb 5MB
        }
    },
    messages: {
        image: {
            required: "Please upload a profile picture.",
            extension: "Please upload a file with a jpg, png or pdf extension",
            filesize: "File size must be less than 5 MB"
        }
    },
    submitHandler: function(form, event) { 
        event.preventDefault();
        const button = document.getElementById("RU-submit-btn");
        const buttonTxt = document.getElementById("RU-submit-btn-txt");
        const buttonLoadSpinner = document.getElementById("RU-submit-btn-load");
        const formData = getFormDataAsObj(form);

        console.log("UPLOAD PROFILE PICTURE");

        // Set necessary data for upload image api call
        const upload_data = {};
        // Note, this setting has been removed from DB
        // It only exists in this code now
        upload_data['file_types'] = ["pdf","jpg","jpeg","png"]; // allowed types of file as per DB (in future make ajax call to grab this)
        upload_data['bucket_name'] = "homehero"; // location in google cloud/ bucket in cloud

        const photo_file_input = document.getElementById("photo-file-input");

        // Create new form for the images
        const imageForm = new FormData();

        // Append all images to the new form
        imageForm.append('file', photo_file_input.files[0]);
        imageForm.append('file_types', JSON.stringify(upload_data['file_types']));
        imageForm.append('bucket_name', upload_data['bucket_name']);

        // Freeze the form 
        disableForm_displayLoadingButton(button, buttonTxt, buttonLoadSpinner, form);

        // console.log(formData);

        console.log("Calling google api...");

        // CHANGELINKDEVPROD
        // Ajax 3rd party file upload
        $.ajax({
            type : 'POST',
            url : 'http://localhost/IM2/hh-thirdparty/google-cloud-api/upload-single', // DEV
            // url : 'https://hh-thirdparty.herokuapp.com/google-cloud-api/upload-single', // PROD
            data : imageForm,
            contentType: false,
            processData: false,
            // headers: {"Content-Type": "application/x-www-form-urlencoded"},
            success : function(response) {
                console.log(response);
                const file_path = response.response.file_location;
                const file_name = response.response.newFileName;
                // console.log(file_name);
                // console.log(file_path);
                // form['file_name'] = file_name;
                // form['file_path'] = file_path;
                // console.log(form);

                // Create new form 
                const samoka = new FormData();

                // Append information
                samoka.append('file_location', file_path);
                samoka.append('newFileName', file_name );

                // Ajax to get the bearer token
                $.ajaxSetup({cache: false})
                $.get(getDocumentLevel()+'/auth/get-register-session.php', function (data) {
                    // console.log(data)
                    const parsedSession = JSON.parse(data);
                    const token = parsedSession['token'];
                    console.log(token);

                    // Save the newly uploaded file information into the DB
                    // Ajax to get list of addresses
                    $.ajax({
                        type: 'POST',
                        // url : '', // prod (No Prod route)
                        url: 'http://localhost/slim3homeheroapi/public/homeowner/save-profile-pic-location', // dev
                        contentType: false,
                        processData: false,
                        headers: {
                            "Authorization": `Bearer ${token}`
                        },
                        data : samoka,
                        success : function(response) {
                            console.log("your response after saving your profile pic is:")
                            console.log(response);
                            console.log(response["response"]);

                            let dataProf = {};
                            dataProf['new_profile'] = response["response"];

                            // Reset the session variable for the profile pic
                            $.ajax({
                                type : 'POST',
                                url : getDocumentLevel()+'/auth/setProfilePic.php',
                                data : dataProf,
                                success : function(response) {
                                    var res = JSON.parse(response);
                                    // Your response after register-auth is
                                    console.log(res)
                                    if(res["status"] == 200){
                                        // close Modal & reset page
                                        $('#modal').modal('hide');
                                        // Unfreeze the form & Rest
                                        window.location = getDocumentLevel()+'/pages/homeowner/profile.php';
                                    } else {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'Something went wrong! Please try again',
                                            icon: 'error',
                                            confirmButtonText: 'ok',
                                        })
                                        // Enable buttons & close Modal
                                        $('#modal').modal('hide');
                                    }
                                }
                            });



                        },
                        error: function (response) {
                            Swal.fire({
                                title: 'An error occurred',
                                text: 'Please try again',
                                icon: 'error'
                            });
                        } // closing for err in ajax

                    }); // Closing bracket for save file path of profile pic into db

                }); // Closing braket for ajax to get bearer token

            },
            error: function(response){
                hideLoadingOverlay();
                console.log(response);
                Swal.fire({
                    icon: 'error',
                    title: 'Error on form upload',
                    text: 'Please try again!',
                })
            }
        }); // closing bracket for 3rd party upload in ajax

        

    } // submithandler close JQUERY validate

}); // validate close JQUERY validate