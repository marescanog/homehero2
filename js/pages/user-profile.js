$(document).ready(()=>{
    // Validate Change Password form
    $("#profile-change-password").validate({
        rules: {
            current_pass:{
                required: true,
            },
            new_pass:{
                required: true,
            },
            confirm_pass:{
                required: true,
                equalTo : "#new_pass"
            }
        },
        messages: {
            current_pass:{
                required: "Please enter your current password",
            },
            new_pass:{
                required: "Please enter a new password",
            },
            confirm_pass:{
                required: "Please confirm your new password",
                equalTo : "This field must match entered password"
            }
        },
        submitHandler: function(form, event) { 
            event.preventDefault();
            const button = document.getElementById("CPs-submit-btn");
            const buttonTxt = document.getElementById("CPs-submit-btn-txt");
            const buttonLoadSpinner = document.getElementById("CPs-submit-btn-load");
            const formData = getFormDataAsObj(form);
            disableForm_displayLoadingButton(button, buttonTxt, buttonLoadSpinner, form);

            // Add token retrieval then link with change password route
            // Ajax to get the bearer token
            $.ajaxSetup({cache: false})
            $.get(getDocumentLevel()+'/auth/get-register-session.php', function (data) {
                //console.log(data)
                const parsedSession = JSON.parse(data);
                const token = parsedSession['token'];
                console.log(token);

                // Create new form 
                const samoka = new FormData();

                // Append information
                samoka.append('current_pass', formData["current_pass"]);
                samoka.append('new_pass', formData["new_pass"]);
                samoka.append('confirm_pass', formData["confirm_pass"]);

                // Ajax to save new pasword
                $.ajax({
                    type: 'POST',
                    // url : '', // prod (No current deployed prod route)
                    url: 'http://localhost/slim3homeheroapi/public/homeowner/change-password', // dev
                    contentType: false,
                    processData: false,
                    headers: {
                        "Authorization": `Bearer ${token}`
                    },
                    data : samoka,
                    success : function(response) {
                        console.log("your response after change password is:")
                        console.log(response);
                        Swal.fire({
                            title: 'Password Change Success',
                            text: 'Password has been changed',
                            icon: 'success'
                        });
                        document.getElementById("profile-change-password").reset();
                        enableForm_hideLoadingButton(button, buttonTxt, buttonLoadSpinner, form, "CHANGE");
                    },
                    error: function (response) {
                        console.log(response);
                        let res = response.responseJSON.response;

                        console.log(res);
                        if(res?.status == 400){
                            Swal.fire({
                                title: 'Error: Bad Request',
                                text: res?.message,
                                icon: 'error'
                            });
                        } else {
                            Swal.fire({
                                title: 'An error occurred',
                                text: 'Please try again',
                                icon: 'error'
                            });
                        }
                        enableForm_hideLoadingButton(button, buttonTxt, buttonLoadSpinner, form, "CHANGE");

                    }
                });

            }); //Ajax close for bearer token

        } // submit handler close in Jquery
        
    }); //JQUERY Validator Close
    


    $("#profile-change-phone").validate({
        rules: {
            phone:{
                required: true,
                phonePH: true
            },
            phone_pass:{
                required: true,
            }
        },
        messages: {
            phone:{
                required: "Please enter your new number",
            },
            phone_pass:{
                required: "Please enter your password",
            }
        },
        submitHandler: function(form, event) { 
            event.preventDefault();
            const button = document.getElementById("CPn-submit-btn");
            const buttonTxt = document.getElementById("CPn-submit-btn-txt");
            const buttonLoadSpinner = document.getElementById("CPn-submit-btn-load");
            const formData = getFormDataAsObj(form);
            disableForm_displayLoadingButton(button, buttonTxt, buttonLoadSpinner, form);
        }
    }); //JQUERY Validator Close






    // Grab edit name hook
    const editName = document.getElementById("hook-edit-name");
    // Add event listener for edit name hook (Load modal)
    editName.addEventListener("click", ()=>{
        let firstName = document.getElementById("grab-first-name").value;
        let lastName = document.getElementById("grab-last-name").value;
        let obj = {};
        // obj['level'] = level;
        obj['first_name'] = firstName;
        obj['last_name'] = lastName;
        loadModal("profile-edit-name", modalTypes, ()=>{}, getDocumentLevel(), obj)
    })


    // Grab Add profile picture hook
    // CODE FOR IMAGE PREVIEW DISPLAY ALSO
    const addPic = document.getElementById("hook-add-pic");
    // Add event listener for profile pciture hook (Load Modal)
    addPic.addEventListener("click", ()=>{
        let profilePicSrc = document.getElementById("profile_src").value;
        let obj = {};
        // obj['level'] = level;
        obj['profile_src'] = profilePicSrc;
        loadModal("profile-add-picture", modalTypes, ()=>{
            // photo file caption change on select, as well as thumbnail
            const photo_file_input = document.getElementById("photo-file-input");
            if(photo_file_input != null){
                photo_file_input.addEventListener("change", function(){
                    // Code to change the label if the file input group
                    let fileName = "";
                    if(photo_file_input.files[0]){
                        fileName = photo_file_input.files[0].name;
                    }
                    const label = document.getElementById("label-photo-file-input");
                    label.innerText = fileName == "" ? "Choose a File" : fileName;  
                    // Code to change the thumbnail
                    const file = this.files[0];
                    if(file){
                        const obj = {};
                        // obj['file'] = file;
                        $("#change-me").load(getDocumentLevel()+"/components/cards/change-me.php", obj, ()=>{
                            // console.log("Inside the change me");
                            // console.log(file);
                            // Grab the elements inside the change-me.php doc
                            const previewContainer = document.getElementById("imagePreview");
                            const previewImage = previewContainer.querySelector(".image-preview__image");
                            const previewDefaultText = previewContainer.querySelector(".image-preview__default-text"); 
                            const yourchosen = document.getElementById("your-chosen");
                            yourchosen.innerText = "Your chosen picture to upload";

                            const reader = new FileReader();

                            previewDefaultText.style.display = null; // Reset CSS Values to default
                            previewImage.style.display = null; // Reset CSS Values to default

                            reader.addEventListener("load", function(){
                                previewImage.setAttribute("src", this.result);
                            });

                            reader.readAsDataURL(file);
                        });
                    } else {
                        const previewContainer = document.getElementById("imagePreview");
                        const previewImage = previewContainer.querySelector(".image-preview__image");
                        const previewDefaultText = previewContainer.querySelector(".image-preview__default-text"); 
                        const yourchosen = document.getElementById("your-chosen");
                        // When no file is selected and user clicks out of file selection explorer
                        previewDefaultText.style.display = "block"; // Reset CSS Values to default
                        previewImage.style.display = "none"; // Reset CSS Values to default
                        yourchosen.innerText = "No chosen file";
                    }
                }); 
            }
        }, getDocumentLevel(), obj)
    })

});

const profile_editAddress = (homeID) =>{
    console.log("You clicked edit address for home "+ homeID);
    // Load Modal for Edit Address
    let obj = {};
    obj['home_id'] = homeID;
    // obj['data'] = data;
    loadModal("editAddr", modalTypes, ()=>{}, getDocumentLevel(), obj);
}

const profile_deleteAddress = (homeID) =>{
    console.log("You clicked delete address for home "+ homeID);

    Swal.fire({
        title: 'Are you sure you want to delete this address?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Yes, Delete',
        denyButtonText: `No, Keep`,
        showLoaderOnConfirm: true,
        backdrop: true,
        preConfirm: () => {
            $.ajaxSetup({cache: false})
            return $.get(getDocumentLevel()+'/auth/get-register-session.php', function (data) {
                // console.log(data)
                const parsedSession = JSON.parse(data);
                const token = parsedSession['token'];
                console.log(token);
                // return token;

                // Ajax to delete the address
                return $.ajax({
                    type: 'POST',
                    // url : '', // No live deployed prod route
                     url: 'http://localhost/slim3homeheroapi/public/homeowner/delete-address/'+homeID, // dev
                    contentType: false,
                    processData: false,
                    headers: {
                        "Authorization": `Bearer ${token}`
                    },
                    // data : submitformData,
                    success : function(response) {
                        console.log("your response after account login is:")
                        console.log(response);

                        return true;
                    },
                    error: function (response) {
                        console.log(response);
                        Swal.fire({
                            title: 'An error occurred',
                            text: 'Please try again',
                            icon: 'error'
                        });
                    }
                });






            }); // closing bracking ajax setup get bearer token
        },// closing swal preconfirm

        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {
        if (result.isConfirmed) {
            // result.value
            Swal.fire({
                title: 'Address Deleted!',
                icon: 'info'
            }).then(()=>{
                window.location = getDocumentLevel()+'/pages/homeowner/profile.php?tab=address';
            });

        }
      }) // Closing bracket swal fire then

} // closing bracket delete addr function





    // Swal.fire({
    //     title: 'Are you sure you want to delete this address?',
    //     showDenyButton: true,
    //     showCancelButton: false,
    //     confirmButtonText: 'Yes, Delete',
    //     denyButtonText: `No, Keep`,
    //   }).then((result) => {
    //     if (result.isConfirmed) {
    //       Swal.fire('Deleted!', '', 'info');
    //         // NODEPLOYEDPRODLINK   
    //         // Ajax to get the bearer token
    //         $.ajaxSetup({cache: false})
    //         $.get(getDocumentLevel()+'/auth/get-register-session.php', function (data) {
    //             console.log(data)
    //             const parsedSession = JSON.parse(data);
    //             const token = parsedSession['token'];
    //             console.log(token);

    //         }); // closing bracking ajax setup get bearer token

    //     } else if (result.isDenied) {
    //         //   Swal.fire('Kept', '', 'info');
    //     } // closinf bracket inside swal result else if

    //   }) // closing bracket Swal Fire