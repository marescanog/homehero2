<?php
    $daysOfTheWeek = [
        "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"
    ];
    $week = isset($_POST["week"]) ? $_POST["week"] : null;
    // var_dump($week);
?>
<h6>Set Availability</h6>
<div class="d-flex">
    <p id="reset9to5Link" class="clicky smol m-0 ">Reset to 9-5 <br> for checked days</p>
    <p id="setDayOffLink" class="clicky smol m-0 ml-lg-4">Set as day-off <br> for checked days</p>
</div>

<div class="row">
    <?php 
        for($x=0; $x<7; $x++){
    ?>
    <div class="col-3 col-lg-2 pt-0 pt-lg-2">
        <div class="custom-control custom-checkbox pt-3">
            <input type="checkbox" class="custom-control-input" id="chk-<?php echo htmlentities($daysOfTheWeek[$x]);?>" name="chk-<?php echo $daysOfTheWeek[$x];?>">
            <label class="custom-control-label check-label" for="chk-<?php echo htmlentities($daysOfTheWeek[$x]);?>">
                <?php echo htmlentities($daysOfTheWeek[$x]);?>
            </label>
        </div>
    </div>
    <div id="d-box-<?php echo $daysOfTheWeek[$x];?>" class="col-7 col-lg-7 d-flex align-items-center justify-content-center">
        <p id="label-<?php echo $daysOfTheWeek[$x];?>" class="check-adjust-sched">
            <?php
                $dayObj = ($week == null) ? null :  $week[$x];;
                if($week != null){
                    if($dayObj["isDayOff"]){
                        echo "Day off";
                    }else{
                        echo $dayObj["start"]." - ".$dayObj["end"];
                    }
                } else {
                    echo "9:00 AM - 5:00 PM";
                }
            ?>
        </p>
        <div class="pt-2">
            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center">
                <div>
                    <input type="hidden" 
                        id="start-time-input-<?php echo $daysOfTheWeek[$x];?>" 
                        name="start-time-<?php echo $daysOfTheWeek[$x];?>"
                        value="<?php echo $dayObj["sRaw"];?>"
                        style="max-width: 107.8px;"
                    >
                </div>
                <div id="to-<?php echo $daysOfTheWeek[$x];?>" class="mx-2 d-none">
                    <p class="mt-3">to</p>
                </div>
                <div>
                    <input type="hidden" 
                        id="end-time-input-<?php echo $daysOfTheWeek[$x];?>" 
                        name="end-time-<?php echo $daysOfTheWeek[$x];?>"
                        value="<?php echo $dayObj["eRaw"];?>"
                        style="width: 107.8px;"
                    >
                </div>
            </div>
            <input id="dayoff-input-<?php echo $daysOfTheWeek[$x];?>" type="hidden" value ="<?php echo $dayObj["isDayOff"];?>">
            <div>
                <p id="appy-click-<?php echo $daysOfTheWeek[$x];?>" class="apply-multiple-adjustwidth clicky smol mt-3 mt-sm-0 d-none">Apply to all checked days</p>
            </div>
        </div>
    </div>
    <div class="col-2 col-lg-3 d-flex p-0 p-lg-2">
        <p id="clicky-<?php echo $daysOfTheWeek[$x];?>" class="clicky check-adjust-sched text-center text-lg-left pl-0 pl-sm-3" data-day="<?php echo $x;?>">Edit</p>
    </div>
    <?php 
        }
    ?>
</div>

<hr class="card-title card-subtitle-main"/>
<h6>Lead Time</h6>
<p class="card-subtitle mb-2 text-muted card-subtitle-muted mt-2">How far in advanced can customers book you for a job?</p>
<div class="row">
    <div class="col-6 pr-1">
        <select class="custom-select">
            <option selected value="1">Anytime</option>
            <option value="2">10</option>
            <option value="3">30</option>
        </select>
    </div>
    <div class="col-6 pl-1">
        <select class="custom-select">
            <option selected disabled>or select time frame</option>
            <option value="2">weeks</option>
            <option value="3">months</option>
        </select>
    </div>
</div>

<p class="card-subtitle mb-2 text-muted card-subtitle-muted mt-3">How much notice do you need before doing a job?</p>
<div class="row">
    <div class="col-6 pr-1">
        <select class="custom-select">
            <option value="1" selected>Start Right Away</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
    </div>
    <div class="col-6 pl-1">
        <select class="custom-select">
            <option selected disabled>or select time frame</option>
            <option value="1">day/s</option>
            <option value="2">week/s</option>
            <option value="3">month/s</option>
        </select>
    </div>
</div>
<p class="mt-3 mb-0 p-0 note-bottom smol">* You'll still be able to change your schedule through your online account settings.</p>