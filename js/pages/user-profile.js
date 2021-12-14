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
    

// =============================================
// CHANGE PHONE NUMBER
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

            // Ajax request to get the header then ajax request to verify pass and phone, after that loadModal for SMS verification, if SMS is verified then proceed with change of number

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

                // // Append information
                samoka.append('phone', formData["phone"]);
                samoka.append('phone_pass', formData["phone_pass"]);

                // Ajax to verify phone number and password
                $.ajax({
                    type: 'POST',
                    // url : '', // prod No current deployed prod route
                    url: 'http://localhost/slim3homeheroapi/public/homeowner/change-phone-verify', // dev
                    contentType: false,
                    processData: false,
                    headers: {
                        "Authorization": `Bearer ${token}`
                    },
                    data : samoka,
                    success : function(response) {
                        console.log("your response after account login is:")
                        console.log(response);

                        const dataToPassToSMSModal = {};
                        dataToPassToSMSModal["phone"] = formData["phone"];

                        // console.log("your data to pass to the SMS Modal");
                        // console.log(dataToPassToSMSModal);
                        const dataToPassToSMSGeneration = {};
                        dataToPassToSMSGeneration["phone"] = formData["phone"];

// Ajax to get the messagebord ID
// CHANGELINKDEVPROD
// Before passing, we call api to generate an SMS code. If the number is inavlid, we display the error
// message here, otherwise if valid proceed to show SMS modal
$.ajax({
    type: "POST",
    // url : 'https://slim3api.herokuapp.com//auth/generate-SMS-dummy', // PROD-DUMMY
        url: 'http://localhost/slim3homeheroapi/public/auth/generate-SMS-dummy', // DEV-DUMMY,
    //url : 'https://slim3api.herokuapp.com/auth/verify-password', // PROD-API
    // url: 'http://localhost/slim3homeheroapi/public/auth/verify-password', // DEV-API,
    data: dataToPassToSMSGeneration,
    success: function(response){

        // Enable forms
        enableForm_hideLoadingButton(button, buttonTxt, buttonLoadSpinner, form);

        // If it is a success, then SMS was generated successfully
        // console.log(response['response']['data']['messagebird_id']);
        // grab the messagebird id and add it to the dataToPassToSMSModal
        dataToPassToSMSModal["messagebird_id"] = response['response']['data']['messagebird_id'];

        // pass the complete form data into the load modal
        
        loadModal("change-phone-sms", modalTypes, ()=>{}, getDocumentLevel(), dataToPassToSMSModal);
        $('#modal').modal('show');
        // HERE IS WHERE THE AJAX CODE STOPS AND STARTS BACK UP
        // IN THE modal-homeowner-profile-sms-change-number.js modal
        // that is the JS file that handles the acceptance of the PIN code
        //  If the pin is correct, we proceed to change the phone number of user
    },
    error: function (response) {
        console.log(response);
        // Either Invalid phone number or something wrong with API
        Swal.fire({
            title: 'Invalid phone number!',
            text: "Please try entering a valid phone number",
            icon: 'error',
            confirmButtonText: 'Try a different number'
        })
    }
});
                        // Old code, 
                        // // Open the Modal Pop Up for SMS
                        // let obj = {};
                        // obj['phone'] = formData["phone"];
                        // obj['messagebird_id'] = "1";
                        // loadModal("change-phone-sms", modalTypes, ()=>{}, getDocumentLevel(), obj);
                        // $('#modal').modal('show');

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
                                title: res=="There is a user associated with this phone number"?"Phone Number Taken":'An error occurred',
                                text: res=="There is a user associated with this phone number"?res:'Please try again',
                                icon: 'error'
                            });
                        }
                        enableForm_hideLoadingButton(button, buttonTxt, buttonLoadSpinner, form, "SAVE");
                    }
                }); // close for phone number and password verify

            }); // close for bearer token ajax

        } // submit handler close

    }); //JQUERY Validator Close





// =============================================
// CHANGE NAME

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


// =============================================
// CHANGE PROFILE PICTURE

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




// =============================================
// EDIT ADDRESS

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