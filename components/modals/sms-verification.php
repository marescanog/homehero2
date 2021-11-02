<!-- 
    To be inserted:
        Form onsubmit event
        Dynamic phone number implementation

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
        <form id="SMSVerification" type="POST" onSubmit="SMSVerificationHandler(event)" name="modalForm" class="m-4">
        <h5 style="font-family: Segoe UI;
                font-style: normal;
                font-weight: bold;
                font-size: 18px;
                line-height: 24px;
                color: #707070;
        ">Verify SMS</h5>
        <p>Enter the verification PIN sent to <?php echo "0912 345 6789" ?></p>
            <div class="d-flex" style="height:200px;">
                <input name="code-1" class="mr-1 text-center code" type="text" 
                    style="width:30px; height:43px; font-size:2rem; outline:0; border-width:0px 0px 2px; overflow:hidden" placeholder="0" required maxlength="1">
                <input name="code-2" class="mr-1 text-center code" type="text"
                    style="width:30px; height:43px; font-size:2rem; outline:0; border-width:0px 0px 2px; overflow:hidden" placeholder="0" required maxlength="1">
                <input name="code-3" class="mr-1 text-center code" type="text"
                    style="width:30px; height:43px; font-size:2rem; outline:0; border-width:0px 0px 2px; overflow:hidden" placeholder="0" required maxlength="1">
                <input name="code-4" class="mr-1 text-center code" type="text"
                    style="width:30px; height:43px; font-size:2rem; outline:0; border-width:0px 0px 2px; overflow:hidden" placeholder="0" required maxlength="1">
            </div>
            <button type="submit" class="btn btn-warning text-white font-weight-bold w-100">
                <span id="RU-submit-btn-txt">VERIFY ACCOUNT</span>
                <div id="RU-submit-btn-load" class="d-none">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Loading...</span>
                </div>
            </button>
        </form>
    </div>

</div>

<!-- 
    Script to limit input to numbers and enable auto focus change for input once a number is inputted 
    Source: https://stackoverflow.com/questions/10539113/focusing-on-next-input-jquery
-->
<script>
$(function() {
    var charLimit = 1;
    $(".code").keydown(function(e) {

        var keys = [8, 9, /*16, 17, 18,*/ 19, 20, 27, 33, 34, 35, 36, 37, 38, 39, 40, 45, 46, 144, 145];

        if (e.which == 8 && this.value.length == 0) {
            $(this).prev('.code').focus();
        } else if ($.inArray(e.which, keys) >= 0) {
            return true;
        } else if (this.value.length >= charLimit) {
            $(this).next('.code').focus();
            return false;
        } else if (e.shiftKey || e.which <= 48 || e.which >= 58) {
            return false;
        }
    }).keyup (function () {
        if (this.value.length >= charLimit) {
            $(this).next('.code').focus();
            return false;
        }
    });
});
</script>

