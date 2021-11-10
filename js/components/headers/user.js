// console.log("User.js is loaded!");

// Check if stylesheet for this component is loaded in document
appendStyleSheet("/css/headers/user.css");

$( document ).ready(()=>{
    var buttonDesktop = document.getElementById("header-btn-desktop");
    var buttonMobile = document.getElementById("header-btn-mobile");
    var signUpHeaderLink = document.getElementById("RU-signup");
    // var modal = document.getElementById("modal");

    // Set events for elements
    buttonDesktop.addEventListener("click", ()=>{
        Swal.fire({
            title: "Not Available",
            confirmButtonText: 'Close',
            html: "<img src='./images/svg/construction_icon.svg' style='height:100px; width:100px;'class='rounded mr-2 mb-3' alt='...'> <p>This feature is under construction. Please check back again later!</>"
        })
    });

    buttonMobile.addEventListener("click", ()=>{
        Swal.fire({
            title: "Not Available",
            confirmButtonText: 'Close',
            html: "<img src='./images/construction_icon.svg' style='height:100px; width:100px;'class='rounded mr-2 mb-3' alt='...'> <p>This feature is under construction. Please check back again later!</>"
        })
    });

    signUpHeaderLink.addEventListener("click", ()=>{
        loadModal("signup", modalTypes, submitSignUpModalhandler, getDocumentLevel());
    });

    const submitSignUpModalhandler = () => {
        var signUpSubmitButton = document.getElementById("RU-submit-btn");
        signUpSubmitButton.addEventListener("click", ()=>{
            registerHandler();
        });
    }

    const registerHandler =(e)=>{
        // e.preventDefault();
    
        // Grab DOM elements
        const myForm = document.getElementById('registerForm');
        const RUSignupSubmitButton = document.getElementById("RU-submit-btn");
        const RUSignupSubmitTxt = document.getElementById("RU-submit-btn-txt");
        const RUSignupSubmitLoad = document.getElementById("RU-submit-btn-load");
    
        // Disable and show loading
        RUSignupSubmitButton.setAttribute("disabled", "true");
        RUSignupSubmitTxt.innerHTML = "Loading"
        RUSignupSubmitLoad.setAttribute("class", "d-inline");
        myForm.style.opacity = "0.5";
    
        var elements = myForm.elements;
        for (var i = 0, len = elements.length; i < len; ++i) {
            elements[i].readOnly = true;
        }
    
        // Convert Form Data to Object
        let formData = new FormData(myForm);
        let data = {};
        formData.forEach((value, key) => data[key] = value);
    
        // Send Post Request to API
        $.ajax({
            type : 'POST',
            url : 'https://slim3api.herokuapp.com/user/register',
            data : data,
            success : function(response) {
                var res = JSON.parse(response);
                console.log(response);
                let message = res.response.message;
         
                // Enable and hide loading
                RUSignupSubmitButton.removeAttribute("disabled");
                RUSignupSubmitTxt.innerHTML = "Register"
                RUSignupSubmitLoad.removeAttribute("class");
                RUSignupSubmitLoad.setAttribute("class", "d-none");
                myForm.style.opacity = "1";
    
                var elements = myForm.elements;
                for (var i = 0, len = elements.length; i < len; ++i) {
                    elements[i].readOnly = false;
                }
    
                Swal.fire({
                    title: res["success"] ? 'Success!': 'Error!',
                    text: message,
                    icon: res["success"] ? 'success': 'error',
                    confirmButtonText: 'Close'
                }).then(result => {
                    if(res["success"]){
                        //  Reset Form, Close Modal
                        myForm.reset();
                        $('#modal').modal('hide');
                    }
                })
            },
            error: function (response) {
                var message = JSON.stringify(response.responseJSON.response.message);
                // Enable and hide loading
                RUSignupSubmitButton.removeAttribute("disabled");
                RUSignupSubmitTxt.innerHTML = "Register"
                RUSignupSubmitLoad.removeAttribute("class");
                RUSignupSubmitLoad.setAttribute("class", "d-none");
                myForm.style.opacity = "1";
    
                var elements = myForm.elements;
                for (var i = 0, len = elements.length; i < len; ++i) {
                    elements[i].readOnly = false;
                }
    
                console.log(response.responseJSON)
                Swal.fire({
                    title:'Error!',
                    text: message,
                    icon: 'error',
                    confirmButtonText: 'Close'
                })
            },
        });
    }

    const consoleLog = (e) => {
        console.log("Thisdfjaslfjkdsjlfksf")
        e.preventDefault();
    }
})
