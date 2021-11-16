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
    <input type="text" class="form-control" id="project_name" name="project_name" placeholder="Plumbing Repair">
</div>

<h5 class="text-left">Description:</h5>
<div class="form-group">
<textarea class="form-control" id="project_description" name="project_description" rows="3"></textarea>
</div>

<h6>How big is your project?</h6>
<div class="d-flex flex-row">
    <div class="form-check">
        <input class="form-check-input" type="radio" name="jobSize" id="jobSize_small" value="small" checked>
        <label class="form-check-label" for="jobSize_small">
            Small - Est. 1 - 4 hrs.
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="jobSize" id="jobSize_Medium" value="medium">
        <label class="form-check-label" for="jobSize_Medium">
            Medium - Est 4 - 8 hrs.
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="jobSize" id="jobSize_large" value="large">
        <label class="form-check-label" for="jobSize_large">
            Large - Est 8+ hrs.
        </label>
    </div>
</div>

<h6>Set an estimated offer</h6>
<div>
    <div class="form-group">
        <label for="rateValue">P</label>
        <input type="number" class="form-control" id="rateValue" placeholder="Password" name="rateValue">
    </div>
    <select class="custom-select">
        <option selected value="1">per hour</option>
        <option value="2">per day</option>
        <option value="3">per week</option>
        <option value="3">per project</option>
    </select>
</div>

<div>
    <button type="button" id="btn-back-page-2" class="btn btn-outline-warning">
        Back
    </button>

    <button type="button" id="btn-page-2" class="btn btn-warning text-white">
        Next
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