<?php

session_start();
// http://localhost/slim3homeheroapi/public/registration/save-general-schedule
// http://localhost/slim3homeheroapi/public/registration/general-schedule

// Make curl for the general schedule info
// $url = "http://localhost/slim3homeheroapi/public/registration/general-schedule"; // DEV
 $url = "https://slim3api.herokuapp.com/registration/general-schedule"; // PROD

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


    // =================================
    // =================================
    // Data from User, format & clean
?>
<?php  //echo var_dump($output->response->has_schedule_preference);?>
<?php  // echo var_dump($output->response);?>
<?php  // echo var_dump($_SESSION["registration_token"]);?>
<?php  // echo var_dump($schedule_preference);?>


<h6>Schedule Preference</h6>
<div class="row ml-3 mb-2">
    <div class="radio-item col-12 m-0">
        <input type="radio" id="ritema" name="ritem" value="ropt1" 
        <?php 
            if( $schedule_preference !== null && $schedule_preference == 0){
                 echo 'checked';
            }
        ?>>
        <label for="ritema">Any day or time</label>
    </div>
    <div class="radio-item col-12 m-0">
        <input type="radio" id="ritemb" name="ritem" value="ropt2"        
        <?php 
            if( $schedule_preference !== null && $schedule_preference == 1){
                 echo 'checked';
            }
        ?>>
        <label for="ritemb">My service hours</label>
    </div>
</div>


<div class="card">
  <div class="card-body">
      <?php 
        for($x=0; $x<7; $x++ ){
      ?>
      <div class="row">
        <div class="col-4">
            <p><?php echo $daysOfTheWeek[$x];?></p>
        </div>
        <div class="col-8">
            <p class="text-right">
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
      </div>
      <?php 
        }
      ?>
      <div class="row">
          <p id="clicky" class="text-center col-12 m-0 p-0 clicky">Edit Times</p>
      </div>
  </div>
</div>
<p class="mt-3 mb-0 p-0 note-bottom">* You'll still be able to modify your schedule through your online account settings.</p>