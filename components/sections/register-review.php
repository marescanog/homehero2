<?php
    session_start();
    
    // CHANGELINKDEVPROD
    // Make curl for the general schedule info
     $url = "http://localhost/slim3homeheroapi/public/registration/review-information"; // DEV
    // $url = "https://slim3api.herokuapp.com/registration/review-information"; // PROD
    
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
    
        $preferred_cities = null;
    
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
                $preferred_cities = $output->response;
            }
        }
    
        // =================================
        // =================================
            
        // Data for rendering
        $daysOfTheWeek = [
            "Sun", "Mon", "Tue", "Wed", "Thur", "Fri", "Sat"
        ];
        $week = isset($_POST["week"]) ? $_POST["week"] : null;
        $isOnEdit = isset($_GET["edit"]) ? $_GET["edit"] : false;

        $hasSchedPref = $output->response->has_sched_pref == "true";

        // =================================
        // =================================
        // Data from User, format & clean if necessary
?>
<?php   //echo var_dump($output);?>
<?php   //echo var_dump($output->response->name);?>
<?php   //echo var_dump($hasSchedPref);?>

<div class="row d-flex flex-column title-2-container pt-1 pt-lg-3">
    <h2 class="title-style-2">REVIEW YOUR INFO</h2>
    <h6 class="title-subtitle-1">Please take time to review your information before your submit your application.</h6>
</div>
<form>
<div class="row card-container">
    <div class="card sm-shadow">
        <div class="card-body">
            <h5 class="card-title card-subtitle-main mb-0">
                Personal Information
            </h5>
<!-- Edit personal Info (Disabled for now) -->
            <!-- <p class="clicky smol pt-0 mt-0">Edit Info</p> -->
            <div class="row mt-2">
                <div class="col-6">
                    <p class="LABEL-THICC-SMOL m-0">
                        NAME
                    </p>
                    <p class="m-0">
                        <?php echo htmlentities($output->response->name);?>
                    </p>
                </div>
                <div class="col-6">
                    <p class="LABEL-THICC-SMOL m-0">
                        MOBILE NUMBER
                    </p>
                    <p class="m-0">
                    <?php echo htmlentities($output->response->mobile);?>
                    </p>
                </div>
            </div>
            <hr class="custom">
            <h5 class="card-title card-subtitle-main mb-0">
                Credentials
            </h5>
<!-- Edit Credentials -->
            <p id="edit-credentials" class="clicky smol pt-0 mt-0">Edit Info</p>
            <div class="row mt-3">
                <div class="col-12">
                    <p class="LABEL-THICC-SMOL m-0">
                        SKILLS
                    </p>
                    <p class="m-0">
                        <?php echo htmlentities($output->response->skills);?>
                    </p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <p class="LABEL-THICC-SMOL m-0">
                        SALARY GOAL
                    </p>
                    <p class="m-0">
                        <?php echo htmlentities($output->response->salary);?>
                    </p>
                </div>
            </div>
            <!-- <div class="row mt-3">
                <div class="col-6">
                    <p class="LABEL-THICC-SMOL m-0">
                        CERTIFICATION/DIPLOMA
                    </p>
                    <p class="m-0">
                        <?php //echo htmlentities($output->response->cert);?>
                    </p>
                </div>
            </div> -->
            <div class="row mt-3">
                <div class="col-6">
                    <p class="LABEL-THICC-SMOL m-0">
                        NBI CLEARANCE NO.
                    </p>
                    <p class="m-0">
                        <?php echo htmlentities($output->response->nbiNo);?>
                    </p>
                </div>
                <div class="col-6">
                    <p class="LABEL-THICC-SMOL m-0">
                        EXPIRATION DATE
                    </p>
                    <p class="m-0">
                        <?php echo htmlentities($output->response->expiration);?>
                    </p>
                </div>
            </div>

            <hr class="custom">
            <h5 class="card-title card-subtitle-main mt-4 mb-0">
                Service Hours
            </h5>
<!-- Edit Service Hours -->
            <p id="edit-hours" class="clicky smol pt-0 mt-0">Edit Hours</p>
            <!-- $hasSchedPref -->
            <?php 
                // preparation of variables
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
                $formatted_sched_data = [];
                if($output != null){
                    $schedule_data = $output->response->schedule_data;
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

            ?>
            <div class="card">
                <div class="card-body">
                    <?php 
                        if($hasSchedPref){
                            for($x=0; $x<7; $x++ ){
                    ?>
                            <div class="row">
        <div class="col-4">
            <p><?php echo $daysOfTheWeek[$x];?></p>
        </div>
        <div class="col-8">
            <p class="text-right">
                <?php 
                    $dayObj = ($formatted_sched_data  == null) ? null :  $formatted_sched_data [$x];
                    if($output != null){
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
      </div>
                    <?php 
                        }
                      } else {
                    ?>
                        <p class="LABEL-THICC-SMOL m-0">
                            SCHEDULE
                        </p>
                        <p class="m-0">
                            No Preferred Schedule
                        </p>
                    <?php
                      }
                    ?>
                    <div class="row mt-3">
                        <div class="col-6">
                            <p class="LABEL-THICC-SMOL m-0">
                                BOOKING LEAD TIME
                            </p>
                            <p class="m-0">
                                <?php echo htmlentities($lead_notice_labels[$output->response->booking_lead]);?>
                            </p>
                        </div>
                        <div class="col-6">
                            <p class="LABEL-THICC-SMOL m-0">
                                NOTICE LEAD TIME
                            </p>
                            <p class="m-0">
                                <?php echo htmlentities($lead_notice_labels[$output->response->notice_lead]);?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="custom">
            <h5 class="card-title card-subtitle-main mt-4 mb-0">
                Service Area
            </h5>
<!-- Edit service area -->
            <p id="edit-area" class="clicky smol pt-0 mt-0">Edit Area</p>
            <div class="row mt-3">
                <div class="col-12">
                    <p class="LABEL-THICC-SMOL m-0">
                        CITIES
                    </p>
                    <p class="m-0">
                        <?php echo htmlentities($output->response->cities);?>
                    </p>
                </div>
            </div>

            <p class="mt-3 mb-0 p-0 note-bottom">* A representative will contact you within 24-48 hours to inform you of the status of your application.</p>
        </div>
    </div>
</div>
<div class="row card-container my-3">
    <div class="col-6">
        <button id="back" type="button" class="h-100 w-100 btn btn-outline-warning btn-text-outline">BACK</button>
    </div>
    <!-- <div class="col-6">
        <button id="next" type="button" class=" w-100 btn btn-warning text-white btn-text-2">NEXT</button>
    </div> -->
    <div  class="col-6">
        <button id="PI-submit-btn" type="button" data-toggle="modal" data-target="#modal" class="w-100 btn btn-warning text-white btn-text-2 justify-content-center align-items-center">
                <span id="PI-submit-btn-txt">SUBMIT APPLICATION</span>
                <div id="PI-submit-btn-load" class="d-none">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Loading...</span>
               </div>
        </button>
    </div>
</div>
</form>


