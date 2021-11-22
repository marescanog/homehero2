<?php 
    $level = isset($_POST['level']) ? $_POST['level'] : '../..';
    $firstName = null;
    $lastName = null;
    $phone = null;
    $password = null;
    $data = null;
    $mode = "dev";
    if(isset($_POST['data'])){
        $data = $_POST['data'];
        $firstName = isset($data['first_name']) ? $data['first_name'] : null;
        $lastName = isset($data['last_name']) ? $data['last_name'] : null;
        $phone = isset($data['phone_number']) ? $data['phone_number'] : null;
        $password = isset($data['password']) ? $data['password'] : null;
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
        <!-- <p>
            <?php 
                //echo var_dump($_POST);
            ?>
        </p>
        <p>Data is</p>
        <p>
            <?php 
               // echo var_dump($data);
            ?>
        </p> -->
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
                <input name="code-4" class="mr-1 text-center code" type="tel" 
                    style="width:30px; height:43px; font-size:2rem; outline:0; border-width:0px 0px 2px; overflow:hidden" placeholder="0" required maxlength="1">
            </div>
            <div id="sms-error-display" class="c d-none">
                <p class="text-danger">Your verification PIN is required</p>
            </div>
        </div>

            <button type="submit" class="btn btn-warning text-white font-weight-bold w-100">
                <span id="RU-submit-btn-txt">VERIFY ACCOUNT</span>
                <div id="RU-submit-btn-load" class="d-none">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Loading...</span>
                </div>
            </button>
        </form>
        <form id="formData" type="POST">
            <input type="hidden" name="first_name" value="<?php echo htmlentities($firstName);?>" readonly>
            <input type="hidden" name="last_name" value="<?php echo htmlentities($lastName);?>" readonly>
            <input type="hidden" name="phone" value="<?php echo htmlentities($phone);?>" readonly>
            <input type="hidden" name="password" value="<?php echo htmlentities($password);?>" readonly>
            <input type="hidden" name="mode" value="<?php echo htmlentities($mode);?>" readonly>
        </form>
    </div>

</div>
<script src="<?php echo $level?>/js/components/modal-validation/modal-worker-sms.js"></script>

