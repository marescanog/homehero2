<?php 
    // Referenced value to change Next button's text
    $editButtonText = isset($_POST["edit"]) ? $_POST["edit"] == "true" : false;
?>
<div class="row d-flex flex-column title-2-container pt-1 pt-lg-3">
    <h2 class="title-style-2">Set your preferred work schedule</h2>

    <h6 class="title-subtitle-1">You'll be matched with projects based on your hours of availability.</h6>
</div>
<form id="schedule-form">
<div class="row card-container">
    <div class="card sm-shadow">
        <div class="card-body ">
            <div id="schedule-preference" >
                <div class="d-flex flex-column justify-content-center align-items-center pb-5 vh-100">
                    <div class="d-flex flex-column justify-content-center align-items-center pb-5" style=
                    "height:50%;">
                        <div class="spinner-grow text-warning text-center" role="status"  style="height:50px; width:50px">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="mt-3 ml-2 text-center" style="font-size: 0.85rem;">
                            Loading...
                        </div>
                    </div>
                </div>
                <p class="text-white disable-select">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do e</p>
            </div>
        </div>
    </div>
</div>
<div class="row card-container my-3">
    </p>
    <div class="col-6">
        <button id="back" type="button" class=" w-100 h-100 btn btn-outline-warning btn-text-outline">BACK</button>
    </div>
    <!-- <div class="col-6">
        <button id="next" type="button" class=" w-100 btn btn-warning text-white btn-text-2">
            <?php 
                //echo $editButtonText == true ? "SAVE & NEXT" : "NEXT";
            ?>
        </button>
    </div> -->

    <div class="col-6">
        <button id="PI-submit-btn" type="type" value="Submit" class="w-100 btn btn-warning text-white btn-text-2 justify-content-center align-items-center">
                <span id="PI-submit-btn-txt">SAVE & NEXT</span>
                <div id="PI-submit-btn-load" class="d-none">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Loading...</span>
               </div>
        </button>
    </div>

</div>
</form>