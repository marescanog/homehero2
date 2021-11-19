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
    <div class="col-4">
        <div class="checkbox-lg custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="chk-<?php echo $daysOfTheWeek[$x];?>" name="chk-<?php echo $daysOfTheWeek[$x];?>">
            <label class="custom-control-label check-label" for="chk-<?php echo $daysOfTheWeek[$x];?>">
                <?php echo $daysOfTheWeek[$x];?>
            </label>
        </div>
    </div>
    <div class="col-5 d-flex align-items-center ">
        <p class="check-adjust-sched">
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
    </div>
    <div class="col-3 d-flex align-items-center">
        <p class="clicky check-adjust-sched">Edit</p>
    </div>
    <?php 
        }
    ?>
</div>