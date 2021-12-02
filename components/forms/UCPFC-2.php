<?php
    $level = isset($_POST["level"]) ? $_POST["level"] : "../..";
    $bci_current_page = isset($_POST["current_page"]) ? $_POST["current_page"] : 1;
    $bci_page_1 = isset($_POST["page_1"]) ? $_POST["page_1"] : null;
    $bci_page_2 = isset($_POST["page_2"]) ? $_POST["page_2"] : null;
    $bci_page_3 = isset($_POST["page_3"]) ? $_POST["page_3"] : null;

    // var_dump($_POST);
?>

<h5 class="text-left">Project Name:</h5>
<div class="form-group">
    <input type="text" class="gray form-control" id="project_name_field" name="project_name_field" placeholder="Your Project">
</div>

<h5 class="text-left">Description:</h5>
<div class="form-group">
<textarea class="gray-small form-control" id="project_description_field" name="project_description_field" rows="5" 
placeholder="Feel free to give a short description or elaborate on specific details. For example, 'I need help assembling a cabinet. Please bring an electric drill.'"></textarea>
</div>

<h6 class="mt-3 text-lg-center">How big is your project?</h6>
<div class="d-flex flex-column flex-lg-row justify-content-lg-between">
    <!-- <div class="form-check mb-2 mb-lg-0">
        <input class="form-check-input" type="radio" name="jobSize" id="jobSize_small" value="small" checked>
        <label class="form-check-label" for="jobSize_small">
            Small - Est. 1 - 4 hrs.
        </label>
    </div>
    <div class="form-check mb-2 mb-lg-0">
        <input class="form-check-input" type="radio" name="jobSize" id="jobSize_Medium" value="medium">
        <label class="form-check-label" for="jobSize_Medium">
            Medium - Est 4 - 8 hrs.
        </label>
    </div>
    <div class="form-check mb-2 mb-lg-0">
        <input class="form-check-input" type="radio" name="jobSize" id="jobSize_large" value="large">
        <label class="form-check-label" for="jobSize_large">
            Large - Est 8+ hrs.
        </label>
    </div> -->
    <div class="form-check mb-2 mb-lg-0">
        <div class="radio-item col-12 m-0">
            <input type="radio" id="ritema" name="job_size" value="1" checked>
            <label for="ritema">Small - Est. 1 - 4 hrs.</label>
        </div>
    </div>
    <div class="form-check mb-2 mb-lg-0">
        <div class="radio-item col-12 m-0">
            <input type="radio" id="ritemb" name="job_size" value="2" >
            <label for="ritemb">Medium - Est 4 - 8 hrs.</label>
        </div>
    </div>
    <div class="form-check mb-2 mb-lg-0">
        <div class="radio-item col-12 m-0">
            <input type="radio" id="ritemc" name="job_size" value="3" >
            <label for="ritemc">Large - Est 8+ hrs.</label>
        </div>
    </div>
</div>

<h6 class="mt-3 text-lg-center mb-2">Set an estimated offer</h6>
<div class="d-flex flex-column flex-lg-row justify-content-center ">
    <div class="form-group d-flex flex-row justify-content-center align-items-center est-offer-width">
        <label for="rateValue" class="mr-3">P</label>
        <input type="number" class="form-control" id="rateValue" placeholder="ex. 300.00" name="rateValue">
    </div>
    <select id="rate-type-select" class="custom-select est-offer-width ml-0 ml-lg-3">
        <option selected value="1">per hour</option>
        <option value="2">per day</option>
        <option value="3">per week</option>
        <option value="4">per project</option>
    </select>
</div>


<div class="d-flex flex-row justify-content-center mt-4 mt-lg-2">
    <!-- <button type="button" id="btn-back-page-2" class="btn btn-lg btn-outline-warning w-100 bottom-button-max-width thicc">
    <i class="fas fa-long-arrow-alt-left h4 mt-1"></i> BACK 
    </button> -->

    <button type="button" id="btn-page-2" class="btn btn-lg btn-warning text-white w-100 ml-3 bottom-button-max-width thicc">
        NEXT <i class="fas fa-long-arrow-alt-right h4 mt-1"></i>
    </button>
</div>




<div class="form-group">
    <!-- <label class="text-left" for="text2">Text</label>
    <input type="text" class="form-control" id="text2" name="text2" placeholder="text" 
    value=<?php 
        // if($bci_page_2 != null){
        //     echo isset($bci_page_2["text2"]) ? $bci_page_2["text2"] : "";
        // }
    ?>> -->

    <!-- Hidden Feilds -->
    <input type="hidden" class="form-control" id="text1" name="text1" placeholder="text" 
    value=<?php 
        if($bci_page_1 != null){
            echo isset($bci_page_1["text1"]) ? $bci_page_1["text1"] : "";
        }
    ?>>

    <input type="hidden" class="form-control" id="text3" name="text3" placeholder="text"
    value=<?php 
        if($bci_page_3 != null){
            echo isset($bci_page_3["text3"]) ? $bci_page_3["text3"] : "";
        }
    ?>>
</div>