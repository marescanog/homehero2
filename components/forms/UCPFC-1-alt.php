<?php
    $level = isset($_POST["level"]) ? $_POST["level"] : "../..";
    $bci_current_page = isset($_POST["current_page"]) ? $_POST["current_page"] : 1;
    $bci_page_1 = isset($_POST["page_1"]) ? $_POST["page_1"] : null;
    $bci_page_2 = isset($_POST["page_2"]) ? $_POST["page_2"] : null;
    $bci_page_3 = isset($_POST["page_3"]) ? $_POST["page_3"] : null;

    // var_dump($_POST);
?>

<div id="this-cal" class="w-100">
    <a id="link_back_general"><< General Date</a>
    <h5 class="text-center mb-3">Specific Date</h5>
    <div class="d-flex flex-column flex-lg-row w-100">
        <div class="w-100 ">
            <!-- bg primary -->
            <div class="justify-content-center d-flex flex-column-reverse">
                <div class="form-group">
                    <label for="time-picker">Select Time:</label>
                    <input class="form-control" id="time-picker" type="text">
                
                </div>
                
                <input id="inline-calendar" type="text" readonly="readonly"> 
            </div>
        </div>
        <div class="w-100 ml-0 ml-lg-3 date-display-container">
            <!-- bg primary -->
            <div class="ml-0 ml-lg-5 mt-1 mt-lg-5">
                <h6>Schedule for:</h6>
                <h4 id="date-time-label">Select A Date & Time</h5>
                <!-- <h4 id="date-time-label">Sep 10, 2:00 PM</h5> -->
                <button id="btn-page-1" type="button" class="btn btn-lg btn-warning text-white my-2 thicc">
                    Select & Continue
                </button>
                <p class="display-note">Note: You can still chat with the Homehero to adjust and finalize details & schedule.</p>
            </div>
        </div>
    </div>
</div>