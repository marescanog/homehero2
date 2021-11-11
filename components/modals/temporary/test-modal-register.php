<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="signUpModalLabel">Register (Temporary Modal - For API Test)</h5>
        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="font-size:1.5em">&times;</span>
        </button>
    </div>
    <form id="registerForm" type="POST" onSubmit="registerHandler(event)" name="modalForm">
        <div class="modal-body">
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" class="form-control" id="RU_firstName" name="first_name" placeholder="First Name" autocomplete require maxlength="50">
            </div>
            <div class="form-group mt-4">
                <input type="text" class="form-control" id="RU_lastName" name="last_name" placeholder="Last Name" autocomplete require maxlength="50">
            </div>
            <div class="form-group mt-4">
                <input type="text" class="form-control" id="RU_phone" name="phone_number" placeholder="09XXXXXXXXX" autocomplete require maxlength="15">
            </div>
            <div class="form-group mt-4">
                <input type="text" class="form-control" id="RU_password" name="password" placeholder="Enter password" autocomplete require maxlength="50">
            </div>
            <div class="form-group mt-4">
                <input type="text" class="form-control" id="RU_confirmPassword" name="confirm_password" placeholder="Re-enter" autocomplete require maxlength="50">
            </div>
        </div>
        <div class="modal-footer">
            <button id="RU-close-btn" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id="RU-submit-btn" type="button" class="btn btn-primary">
                <span id="RU-submit-btn-txt">Register</span>
                <div id="RU-submit-btn-load" class="d-none">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Loading...</span>
                </div>
            </button>
        </div>
    </form>

</div>
</div>