<!-- 
    To be inserted:
        Form onsubmit event
        Dynamic phone number implementation

-->

<div id="sms-modal" class="modal-content">
    <div class="modal-header">
    <div class="mx-auto" style="width: auto;">
    <svg xmlns="http://www.w3.org/2000/svg" width="192.319" height="45.31" viewBox="0 0 192.319 45.31">
  <g id="HomeHero_Logo_Dark" data-name="HomeHero Logo Dark" transform="translate(-15.296 -12.382)">
    <path id="Union_4" data-name="Union 4" d="M-58.674-4044.9c-.133-1.1-.28-2.484-.425-3.95-4.569.94-9.572,4.211-9.572,4.211l7.61-16.793a4.207,4.207,0,0,1,4.2-2.886,1.836,1.836,0,0,1-1.837-1.837,1.837,1.837,0,0,1,1.837-1.837,1.837,1.837,0,0,1,1.837,1.837,1.837,1.837,0,0,1-1.837,1.837,4.207,4.207,0,0,1,4.2,2.886l7.347,16.531a32.165,32.165,0,0,0-9.334-3.965c-.113,1.4-.231,2.774-.348,3.966-.525,5.248-1.05,7.609-1.838,7.609S-58.149-4040.437-58.674-4044.9Z" transform="translate(96.479 4089.008)" fill="none" stroke="#fff" stroke-width="2" opacity="0.8"/>
    <path id="Path_264" data-name="Path 264" d="M61,76.68l7.609-16.793a4.5,4.5,0,0,1,8.4,0l7.347,16.531s-6.56-4.2-11.545-4.2S61,76.68,61,76.68Z" transform="translate(-33.192 -32.307)" fill="#fc0" stroke="#fc0" stroke-width="1"/>
    <g id="Group_427" data-name="Group 427" transform="translate(29.671 21.019)">
      <circle id="Ellipse_273" data-name="Ellipse 273" cx="1.837" cy="1.837" r="1.837" transform="translate(8.108 0)" fill="#fff" stroke="#707070" stroke-miterlimit="10" stroke-width="1"/>
      <path id="Path_265" data-name="Path 265" d="M82.243,60.886A4.354,4.354,0,0,0,77.966,58a4.207,4.207,0,0,0-4.2,2.886L68.1,74.216s0,.026.026,0L74.9,63.537h.026c.052.472.787,9.289,1.312,13.618.525,4.461,1.05,7.609,1.837,7.609s1.312-2.362,1.837-7.609c.5-5.09,1.023-13.408,1.05-13.881h.026l7.032,11.467h.026Z" transform="translate(-68.1 -54.064)" fill="#fff" stroke="#707070" stroke-miterlimit="10" stroke-width="1"/>
    </g>
    <g id="Group_428" data-name="Group 428" transform="translate(16 13.031)">
      <path id="Path_266" data-name="Path 266" d="M16,32.7l1.5,1.811,22.12-18.263L62,34.769l1.5-1.811L39.616,13.2Z" transform="translate(-16 -13.2)" fill="#fc0" stroke="#fc0" stroke-width="1"/>
      <path id="Path_267" data-name="Path 267" d="M76.449,118.559a2.431,2.431,0,0,1-2.532,2.309h-26.3a2.432,2.432,0,0,1-2.532-2.309V102.5H42.5v16.059a4.922,4.922,0,0,0,5.121,4.671h26.3a4.922,4.922,0,0,0,5.121-4.671V102.5H76.449Z" transform="translate(-37.305 -79.068)" fill="#fc0" stroke="#fc0" stroke-width="1"/>
      <path id="Path_268" data-name="Path 268" d="M255.919,62.454h-7.889V55.6H244V72.979h4.029V65.862h7.889v7.117h4.029V55.6h-4.029Z" transform="translate(-190.174 -41.545)" fill="#707070"/>
      <path id="Path_269" data-name="Path 269" d="M355.009,76.785a8.495,8.495,0,0,0-7.55,0,6.438,6.438,0,0,0-2.617,2.448,6.787,6.787,0,0,0-.941,3.559,6.883,6.883,0,0,0,.941,3.559,6.566,6.566,0,0,0,2.617,2.448,8.018,8.018,0,0,0,3.785.885,7.887,7.887,0,0,0,3.766-.885,6.389,6.389,0,0,0,2.6-2.448,6.787,6.787,0,0,0,.941-3.559,6.884,6.884,0,0,0-.941-3.559A6.515,6.515,0,0,0,355.009,76.785Zm-1.318,8.7a3.2,3.2,0,0,1-2.448,1,3.335,3.335,0,0,1-2.467-1,4.255,4.255,0,0,1,0-5.385,3.524,3.524,0,0,1,4.914,0,3.74,3.74,0,0,1,.96,2.693A3.944,3.944,0,0,1,353.691,85.484Z" transform="translate(-271.264 -58.023)" fill="#707070"/>
      <path id="Path_270" data-name="Path 270" d="M452.515,75.9a6.649,6.649,0,0,0-2.749.565,5.486,5.486,0,0,0-2.071,1.619,4.384,4.384,0,0,0-1.845-1.619,5.686,5.686,0,0,0-2.561-.565,6.054,6.054,0,0,0-2.372.452,4.906,4.906,0,0,0-1.826,1.3V76.107H435.4v13.35h3.879v-6.7a3.783,3.783,0,0,1,.791-2.617,2.741,2.741,0,0,1,2.128-.885c1.695,0,2.523,1.054,2.523,3.144v7.042H448.6v-6.7a3.783,3.783,0,0,1,.791-2.617,2.768,2.768,0,0,1,2.165-.885,2.339,2.339,0,0,1,1.883.791A3.675,3.675,0,0,1,454.1,82.4v7.042h3.879V81.793a6,6,0,0,0-1.469-4.425A5.48,5.48,0,0,0,452.515,75.9Z" transform="translate(-345.535 -58.023)" fill="#707070"/>
      <path id="Path_271" data-name="Path 271" d="M579.976,76.747a7.416,7.416,0,0,0-3.559-.847,7.521,7.521,0,0,0-3.634.885,6.456,6.456,0,0,0-2.561,2.467,6.8,6.8,0,0,0-.923,3.54,6.884,6.884,0,0,0,.941,3.559,6.482,6.482,0,0,0,2.674,2.448,8.772,8.772,0,0,0,3.992.885,6.922,6.922,0,0,0,5.517-2.165l-2.052-2.241a4.41,4.41,0,0,1-1.506.979,5.128,5.128,0,0,1-1.845.3,4.294,4.294,0,0,1-2.523-.715,3.152,3.152,0,0,1-1.3-1.958h10.111c.057-.64.075-1,.075-1.036a7.151,7.151,0,0,0-.9-3.653A6.259,6.259,0,0,0,579.976,76.747Zm-6.835,4.877a3.1,3.1,0,0,1,1.092-2.034,3.394,3.394,0,0,1,2.2-.753,3.245,3.245,0,0,1,2.184.753,3.2,3.2,0,0,1,1.092,2.015h-6.571Z" transform="translate(-454.224 -58.023)" fill="#707070"/>
      <path id="Path_272" data-name="Path 272" d="M671.119,62.454h-7.889V55.6H659.2V72.979h4.029V65.862h7.889v7.117h4.029V55.6h-4.029Z" transform="translate(-527.197 -41.545)" fill="#707070"/>
      <path id="Path_273" data-name="Path 273" d="M769.676,76.747a7.416,7.416,0,0,0-3.559-.847,7.522,7.522,0,0,0-3.634.885,6.456,6.456,0,0,0-2.561,2.467,6.8,6.8,0,0,0-.923,3.54,6.883,6.883,0,0,0,.941,3.559,6.482,6.482,0,0,0,2.674,2.448,8.772,8.772,0,0,0,3.992.885,6.921,6.921,0,0,0,5.517-2.165l-2.052-2.241a4.411,4.411,0,0,1-1.506.979,5.128,5.128,0,0,1-1.845.3,4.293,4.293,0,0,1-2.523-.715,3.152,3.152,0,0,1-1.3-1.958h10.111c.057-.64.075-1,.075-1.036a7.151,7.151,0,0,0-.9-3.653A6.031,6.031,0,0,0,769.676,76.747Zm-6.816,4.877a3.1,3.1,0,0,1,1.092-2.034,3.394,3.394,0,0,1,2.2-.753,3.245,3.245,0,0,1,2.184.753,3.2,3.2,0,0,1,1.092,2.015H762.86Z" transform="translate(-608.206 -58.023)" fill="#707070"/>
      <path id="Path_274" data-name="Path 274" d="M851.19,77.958v-1.77H847.5v13.35h3.879V83.23a3.776,3.776,0,0,1,.941-2.787,3.537,3.537,0,0,1,2.6-.923c.151,0,.433.019.866.056V76a7.04,7.04,0,0,0-2.711.49A4.181,4.181,0,0,0,851.19,77.958Z" transform="translate(-680.042 -58.104)" fill="#707070"/>
      <path id="Path_275" data-name="Path 275" d="M911.707,79.233a6.64,6.64,0,0,0-2.6-2.448,8.495,8.495,0,0,0-7.55,0,6.438,6.438,0,0,0-2.617,2.448A6.787,6.787,0,0,0,898,82.791a6.883,6.883,0,0,0,.941,3.559,6.566,6.566,0,0,0,2.617,2.448,8.018,8.018,0,0,0,3.785.885,7.888,7.888,0,0,0,3.766-.885,6.389,6.389,0,0,0,2.6-2.448,7.2,7.2,0,0,0,0-7.117Zm-3.935,6.251a3.2,3.2,0,0,1-2.448,1,3.335,3.335,0,0,1-2.467-1,4.255,4.255,0,0,1,0-5.385,3.524,3.524,0,0,1,4.914,0,4.255,4.255,0,0,1,0,5.385Z" transform="translate(-721.034 -58.023)" fill="#707070"/>
    </g>
  </g>
</svg>
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
                font-size: git 18px;
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
