<?php 
// sms-verification-to-change-ho-pass.php
    // on the SMS verification worker form, write PHP to grab the POST data and echo it back into a hidden form
    // Once SMS verificaiton submission is successful, ajax to write to database on the js for the modal sms verification

    // Grab information passed from Worker registration form
    $level = isset($_POST['level']) ? $_POST['level'] : '../..';
    $phone = null;
    if(isset($_POST['data'])){
        $data = $_POST['data'];
        $phone = isset($data['phone']) ? $data['phone'] : null;
        $messagebirdID = isset($data['messagebird_id']) ? $data['messagebird_id'] : null;
    }
?>
<div id="sms-modal" class="modal-content">
    <div class="modal-header">
    <div class="mx-auto" style="width: auto;">
        <img src="<?php echo $level?>/images/logo/HH_Logo_Light.svg">
    </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem -1rem -1rem 0;">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form id="SMSVerification" type="POST" name="modalForm" class="m-4">
        <h5 style="font-family: Segoe UI;
                font-style: normal;
                font-weight: bold;
                font-size: git 18px;
                line-height: 24px;
                color: #707070;
        ">Verify SMS</h5>
        <p>Enter the verification PIN sent to <?php echo htmlentities($phone); ?></p>
        <div class="d-flex flex-column" style="height:200px;">
            <div class="d-flex form-sms" >
                <input name="code-1" class="mr-1 text-center code" type="tel" 
                    style="width:30px; height:43px; font-size:2rem; outline:0; border-width:0px 0px 2px; overflow:hidden" placeholder="0" required maxlength="1">
                <input name="code-2" class="mr-1 text-center code" type="tel" 
                    style="width:30px; height:43px; font-size:2rem; outline:0; border-width:0px 0px 2px; overflow:hidden" placeholder="0" required maxlength="1">
                <input name="code-3" class="mr-1 text-center code" type="tel" 
                    style="width:30px; height:43px; font-size:2rem; outline:0; border-width:0px 0px 2px; overflow:hidden" placeholder="0" required maxlength="1">
                <input name="code-4" class="mr-1 ml-4 text-center code" type="tel" 
                    style="width:30px; height:43px; font-size:2rem; outline:0; border-width:0px 0px 2px; overflow:hidden" placeholder="0" required maxlength="1">
                    <input name="code-5" class="mr-1 text-center code" type="tel" 
                    style="width:30px; height:43px; font-size:2rem; outline:0; border-width:0px 0px 2px; overflow:hidden" placeholder="0" required maxlength="1">
                <input name="code-6" class="mr-1 text-center code" type="tel" 
                    style="width:30px; height:43px; font-size:2rem; outline:0; border-width:0px 0px 2px; overflow:hidden" placeholder="0" required maxlength="1">
                <input type="hidden" name="messagebird_id" value="<?php echo htmlentities($messagebirdID); ?>">
            </div>
            <div id="sms-error-display" class="c d-none">
                <p class="text-danger">Your verification PIN is required</p>
            </div>
        </div>
            <button id="WSMS-submit-btn" type="submit" class="btn btn-warning text-white font-weight-bold w-100">
                <span id="WSMS-submit-btn-txt">VERIFY ACCOUNT</span>
                <div id="WSMS-submit-btn-load" class="d-none">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Loading...</span>
                </div>
            </button>
        </form>
        <form id="formData" type="POST">
            <input type="hidden" name="phone" value="<?php echo htmlentities($phone);?>" readonly>
        </form>
    </div>

</div>
<script src="<?php echo $level?>/js/components/modal-validation/modal-homeowner-profile-sms-change-number.js"></script>

