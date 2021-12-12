<?php

session_start();
// http://localhost/slim3homeheroapi/public/registration/save-general-schedule
// http://localhost/slim3homeheroapi/public/registration/general-schedule

// CHANGELINKDEVPROD
// Make curl for the general schedule info
 $url = "http://localhost/slim3homeheroapi/public/registration/general-schedule"; // DEV
// $url = "https://slim3api.herokuapp.com/registration/general-schedule"; // PROD

$headers = array(
    "Authorization: Bearer ".$_SESSION["registration_token"],
    'Content-Type: application/json',
);

// 1. Initialize
$ch = curl_init();

// 2. set options
    // URL to submit to
    curl_setopt($ch, CURLOPT_URL, $url);

    // Return output instead of outputting it
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // Type of request = GET
    curl_setopt($ch, CURLOPT_HTTPGET, 1);

    // Set headers for auth
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Execute the request and fetch the response. Check for errors
    $output = curl_exec($ch);

    if($output === FALSE){
        echo "cURL Error:" . curl_error($ch);
    }

    curl_close($ch);

    // $output =  json_decode(json_encode($output), true);
    $output =  json_decode($output);

    $schedule_preference = null;
    $schedule_data = null;
    $formatted_sched_data = [];
    $lead_notice_data = [];



    // Populate data from curl output
    if($output !== FALSE && $output !== null && $output !== "" && !empty($output)){
        if($output->success == false){
        ?>
            <div class="title-2-container alert alert-danger alert-dismissible fade show" role="alert">
                <strong>  <?php echo $output->response->status == 500 ? "500 SERVER ERROR": "401 NOT FOUND";?></strong> 
                <?php echo $output->response->message;?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php
        } else {
            // Populate Data from DB
            $schedule_preference = $output->response->has_schedule_preference;
            $schedule_data = $output->response->schedule_data;
            $lead_notice_data = $output->response->lead_notice_time_data;
            $objArr = [];
            foreach ($schedule_data as $value) {
                array_push(  $objArr, $value);
            }
            if($schedule_data != null && $schedule_data != ""){
                for($x = 1; $x < count($objArr); $x+=3){
                    $obj = [];
                    $obj["isDayOff"] =  $objArr[$x];
                    $obj["start"] =  date("g:i a", strtotime($objArr[$x+1]));
                    $obj["end"] = date("g:i a", strtotime($objArr[$x+2]));
                    $obj["sRaw"] = $objArr[$x+1];
                    $obj["eRaw"] = $objArr[$x+2];
                    array_push(    $formatted_sched_data, $obj);
                }
                // to start sunday, move sunday to front by popping ang unshifting
                array_unshift($formatted_sched_data, array_pop($formatted_sched_data));
            }

        }
    }

    // =================================
    // =================================

    // Data for rendering
    $daysOfTheWeek = [
        "Sun","Mon", "Tue", "Wed", "Thu", "Fri", "Sat",
    ];
    $week = isset($_POST["week"]) ? $_POST["week"] : null; // starts sunday
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
                // $dayObj = ($week == null) ? null :  $week[$x];;
                $dayObj = ($formatted_sched_data  == null) ? null :  $formatted_sched_data [$x];
                if($week != null &&  $dayObj!=null){
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
            <input id="dayoff-input-<?php echo $daysOfTheWeek[$x];?>" name="dayoff-input-<?php echo $daysOfTheWeek[$x];?>" type="hidden" value ="<?php echo $dayObj["isDayOff"];?>">
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




<?php 
    $lead_notice_labels = [
            "Anytime"=>"Anytime",
            "1"=>"One Day",
            "3"=>"3 Days",
            "7"=>"1 week",
            "14"=>"2 weeks",
            "21"=>"3 weeks",
            "30"=>"1 month",
            "60"=>"2 months"
        ];
?>


<hr class="card-title card-subtitle-main"/>
<h6>Lead Time</h6>
<p class="card-subtitle mb-2 text-muted card-subtitle-muted mt-2">How far in advanced can customers book you for a job?</p>
<div class="row">
    <div class="col-10 pr-1">
        <select class="custom-select w-100" name="lead_time">
            <?php 
                foreach ($lead_notice_labels as $key => $value) {
            ?>
                <option value="<?php 
                    echo $key;
                ?>"
                <?php 
                    if($key == $lead_notice_data->lead_time){
                        echo " selected";
                    }
                ?>
                >
                    <?php 
                        echo $value;
                    ?>
                </option>
            <?php 
                }
                unset($value); // break the reference with the last element
            ?>
        </select>
    </div>
    <!-- <div class="col-6 pr-1">
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
    </div> -->
</div>

<p class="card-subtitle mb-2 text-muted card-subtitle-muted mt-3">How much notice do you need before doing a job?</p>
<div class="row">
    <div class="col-10 pr-1">
        <select class="custom-select w-100" name="notice_time">
            <?php 
                foreach ($lead_notice_labels as $key => $value) {
            ?>
                <option value="<?php 
                    echo $key;
                ?>"
                <?php 
                    if($key == $lead_notice_data->notice_time){
                        echo " selected";
                    }
                ?>
                >
                    <?php 
                        echo $value;
                    ?>
                </option>
            <?php 
                }
                unset($value); // break the reference with the last element
            ?>
        </select>
    </div>
    <!-- <div class="col-6 pr-1">
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
    </div> -->
</div>
<p class="mt-3 mb-0 p-0 note-bottom smol">* You'll still be able to change your schedule through your online account settings.</p>