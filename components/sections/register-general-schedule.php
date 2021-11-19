<?php
    $daysOfTheWeek = [
        "Sun", "Mon", "Tue", "Wed", "Thur", "Fri", "Sat"
    ];
    $week = isset($_POST["week"]) ? $_POST["week"] : null;
?>
<h6>Schedule Preference</h6>
<div class="row ml-3 mb-2">
    <div class="radio-item col-12 m-0">
        <input type="radio" id="ritema" name="ritem" value="ropt1" checked>
        <label for="ritema">Any day or time</label>
    </div>
    <div class="radio-item col-12 m-0">
        <input type="radio" id="ritemb" name="ritem" value="ropt2">
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
          <p class="text-center col-12 m-0 p-0">Edit Times</p>
      </div>
  </div>
</div>
<p class="mt-3 mb-0 p-0">* You'll still be able to change your schedule through your online account settings.</p>