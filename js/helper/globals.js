const convertFrom24To12Format = (time24) => {
    const [sHours, minutes] = time24.match(/([0-9]{1,2}):([0-9]{2})/).slice(1);
    const period = +sHours < 12 ? 'AM' : 'PM';
    const hours = +sHours % 12 || 12;
  
    return `${hours}:${minutes} ${period}`;
};

function rotateRight(arr){
    let last = arr.pop();
    arr.unshift(last);
    return arr;
};

const getFormDataAsObj = (myForm) =>{
    let formData = new FormData(myForm);
    let data = {};
    formData.forEach((value, key) => data[key] = value);
    return data;
};



/* Reference for disableForm_displayLoadingButton & enableForm_hideLoadingButton
SUBMIT BUTTON HTML FORMAT
    <button id="RW-submit-btn" type="submit" value="Submit" class="btn btn-warning text-white font-weight-bold w-100 mb-3 submit">
        <span id="RW-submit-btn-txt">CREATE ACCOUNT</span>
        <div id="RW-submit-btn-load" class="d-none">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <span class="sr-only">Loading...</span>
        </div>
    </button>

// Grab DOM elements & Form data
const button = document.getElementById("RW-submit-btn");
const buttonTxt = document.getElementById("RW-submit-btn-txt");
const buttonLoadSpinner = document.getElementById("RW-submit-btn-load");
const formData = getFormDataAsObj(form);
*/
const disableForm_displayLoadingButton = (button, buttonTxt, buttonLoadSpinner, form) => {
    button.setAttribute("disabled", "true");
    buttonTxt.innerHTML = "Loading"
    buttonLoadSpinner.setAttribute("class", "d-inline");
    form.style.opacity = "0.5";

    var elements = form.elements;
    for (var i = 0, len = elements.length; i < len; ++i) {
        elements[i].disabled = true;
    }
};

const enableForm_hideLoadingButton = (button, buttonTxt, buttonLoadSpinner, form) => {
    button.removeAttribute("disabled");
    buttonTxt.innerHTML = "CREATE ACCOUNT"
    buttonLoadSpinner.setAttribute("class", "d-none");
    form.style.opacity = "1";

    var elements = form.elements;
    for (var i = 0, len = elements.length; i < len; ++i) {
        elements[i].disabled = false;
    }
}


// This function adds an error message to the phone feild if an error message has not been added
// Otherwise it toggles the attributes and classes to show the error
// accepts an id and an Error Message
/* Sample HTML for reference
        <div id="RU_phone_formGroup" class="form-group">
            <input type="text" class="form-control" id="RU_phone" name="phone" placeholder="Mobile number (09XXXXXXXXX)" autocomplete required maxlength="15">
        </div>
*/
const enableErrorDisplayFor = (id_name, error_message)=>{
    // Check if there is already an aria added, otherwise don't add and just toggle class and attributes
    // Grab the DOM elements
    const errorDisplay = document.getElementById(id_name+"-error");
    const phoneFeild = document.getElementById(id_name);
    const phoneFormGroup = document.getElementById(id_name+"_formGroup");

    if(errorDisplay == null){
        // Add an aria to the feild & new class
        const att = document.createAttribute("aria-describedby");       
        att.value = id_name+"-error";                           
        phoneFeild.setAttributeNode(att);
        phoneFeild.classList.add("is-invalid");
        phoneFeild.setAttribute("aria-invalid", "true");

        // Create error message
        let newDiv = document.createElement("DIV");
        newDiv.setAttribute("id", id_name+"-error");
        newDiv.setAttribute("class", "invalid-feedback");
        newDiv.innerText = error_message;

        // Append error message
        phoneFormGroup.appendChild(newDiv); 
    } else {
        // errorDisplay Exists and just toggle classes;
        phoneFeild.classList.add("is-invalid");
        phoneFeild.setAttribute("aria-invalid", "true");
        phoneFeild.setAttribute("aria-describedby", id_name+"-error");

        // error display classes and attributes
        errorDisplay.setAttribute("id", id_name+"-error");
        errorDisplay.setAttribute("class", "invalid-feedback");
        errorDisplay.innerText = error_message;
        errorDisplay.style = "";
    }
}