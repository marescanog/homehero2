<?php 
    // Referenced value to change Next button's text
    $editButtonText = isset($_POST["edit"]) ? $_POST["edit"] == "true" : false;
?>
<div class="row d-flex flex-column title-2-container pt-1 pt-lg-3">
    <h2 class="title-style-2">Set your preferred work schedule</h2>

    <h6 class="title-subtitle-1">You'll be matched with projects based on your hours of availability.</h6>
</div>
<form>
<div class="row card-container">
    <div class="card sm-shadow">
        <div class="card-body">
            <div id="schedule-preference">
            </div>
        </div>
    </div>
</div>
<div class="row card-container my-3">
    </p>
    <div class="col-6">
        <button id="back" type="button" class=" w-100 h-100 btn btn-outline-warning btn-text-outline">BACK</button>
    </div>
    <div class="col-6">
        <button id="next" type="button" class=" w-100 btn btn-warning text-white btn-text-2">
            <?php 
                echo $editButtonText == true ? "SAVE & NEXT" : "NEXT";
            ?>
        </button>
    </div>
</div>
</form>