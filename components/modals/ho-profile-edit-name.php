<?php
    $first_name = isset($_POST["data"]["first_name"]) ? $_POST["data"]["first_name"] : "";
    $last_name = isset($_POST["data"]["last_name"]) ? $_POST["data"]["last_name"] : "";
?>
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="signUpModalLabel">EDIT NAME</h5>
        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" style="font-size:1.5em">&times;</span>
        </button>
    </div>
    <div name="modalForm">
    <form id="modal-profile-edit-name" type="POST">
        <div class="modal-body">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo htmlentities($first_name);?>">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo htmlentities($last_name);?>">
            </div>
        </div>
        <div class="modal-footer d-flex flex-row">

            <button id="RU-submit-btn"  type="submit" value="Submit"  class="btn btn-warning text-white font-weight-bold mb-3 mt-3 w-100">
                    <span id="RU-submit-btn-txt">SUBMIT</span>
                    <div id="RU-submit-btn-load" class="d-none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="sr-only">Loading...</span>
                    </div>
            </button>
        </div>
        </div>
    </form>
</div>
<script src="../../js/components/modal-validation/modal-profile-edit-name.js"></script>