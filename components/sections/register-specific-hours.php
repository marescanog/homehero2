<?php
    $daysOfTheWeek = [
        "Sun", "Mon", "Tue", "Wed", "Thur", "Fri", "Sat"
    ];
    $week = isset($_POST["week"]) ? $_POST["week"] : null;
    var_dump($week);
?>
<h6>Set Availability</h6>
<p class="clicky smol m-0">Reset Selected</p>

<div class="row">
    <div class="col-4">
        <div class="checkbox-lg custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="skill_carpentry" name="skill_carpentry">
            <label class="custom-control-label check-label" for="skill_carpentry">Carpentry</label>
        </div>
    </div>
    <div class="col-4">a</div>
    <div class="col-4">a</div>
</div>