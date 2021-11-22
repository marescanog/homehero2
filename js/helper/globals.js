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