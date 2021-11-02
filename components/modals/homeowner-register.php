<!-- 
    Merged some contents such as ids and other properties
    To be inserted:
        Links for terms and conditions, privacy policy, login, and worker registration anchors
-->

<div class="modal-content">
    <div class="modal-header">
        <div class="mx-auto" style="width: auto;">
            <img src='./images/logo/HH_Logo_Light.svg'>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem -1rem -1rem 0;">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <h5 class="font-weight-bold" style="color: #707070;">Homeowner Sign-Up</h5>
        <form id="registerForm" type="POST" onSubmit="registerHandler(event)" name="modalForm" class="m-4">
            <div class="d-flex">
                <div class="form-group w-100 mr-2">
                    <input type="text" class="form-control" id="RU_firstName" name="first_name" placeholder="First Name" autocomplete required maxlength="50">
                </div>
                <div class="form-group w-100 ml-2">
                    <input type="text" class="form-control" id="RU_lastName" name="last_name" placeholder="Last Name" autocomplete required maxlength="50">
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="RU_phone" name="phone_number" placeholder="Mobile number (09XXXXXXXXX)" autocomplete required maxlength="15">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="RU_password" name="password" placeholder="Enter password" autocomplete required maxlength="50">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="RU_confirmPassword" name="confirm_password" placeholder="Re-enter password" autocomplete required maxlength="50">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="agree" required>
                <label class="form-check-label" for="agree" style="font-size:0.8em;">I agree to HomeHero's <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a>.</label>
            </div>
            <button id="RU-submit-btn" type="submit" class="btn btn-warning text-white font-weight-bold w-100 mb-3">
                <span id="RU-submit-btn-txt">CREATE ACCOUNT</span>
                <div id="RU-submit-btn-load" class="d-none">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Loading...</span>
                </div>
            </button>
            
            <div class="text-center" style="font-size:0.8em;">
                <p>
                    Already have an account? <a href="#">Login</a>
                    </br>
                    Looking for work? <a href="#">Register</a> at the worker's portal.
                </p>
            </div>
        </form>
    </div>
</div>