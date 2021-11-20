<?php
    $daysOfTheWeek = [
        "Sun", "Mon", "Tue", "Wed", "Thur", "Fri", "Sat"
    ];
    $week = isset($_POST["week"]) ? $_POST["week"] : null;
    // var_dump($week);
?>
<h6>Set Availability</h6>
<div class="d-flex">
    <p class="clicky smol m-0">Reset Selected</p>
    <p class="clicky smol m-0 ml-3">Mark as Day-Off</p>
</div>

<div class="row">
    <?php 
        for($x=0; $x<7; $x++){
    ?>
    <div class="col-3 col-lg-2 pt-0 pt-lg-2">
        <div class="checkbox-lg custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="chk-<?php echo $daysOfTheWeek[$x];?>" name="chk-<?php echo $daysOfTheWeek[$x];?>">
            <label class="custom-control-label check-label" for="chk-<?php echo $daysOfTheWeek[$x];?>">
                <?php echo $daysOfTheWeek[$x];?>
            </label>
        </div>
    </div>
    <div id="d-box-<?php echo $daysOfTheWeek[$x];?>" class="col-6 col-lg-7 d-flex align-items-center justify-content-center">
        <p class="check-adjust-sched d-none">
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
                    <input type="time" 
                        id="start-time-input-<?php echo $daysOfTheWeek[$x];?>" 
                        name="start-time-<?php echo $daysOfTheWeek[$x];?>"
                    >
                </div>
                <div class="mx-2">
                    <p class="mt-3">to</p>
                </div>
                <div>
                    <input type="time" 
                        id="start-end-input-<?php echo $daysOfTheWeek[$x];?>" 
                        name="end-time-<?php echo $daysOfTheWeek[$x];?>"
                    >
                </div>
            </div>
            <p class="clicky smol mt-3 mt-lg-0 d-none">Apply to selected days</p>
        </div>
    </div>
    <div class="col-3 d-flex">
        <p id="clicky-<?php echo $daysOfTheWeek[$x];?>" class="clicky check-adjust-sched text-center text-lg-left pl-0 pl-sm-3">Edit</p>
    </div>
    <?php 
        }
    ?>
</div>