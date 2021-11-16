<?php
    $level = isset($_POST["level"]) ? $_POST["level"] : "../..";
    $bci_current_page = isset($_POST["current_page"]) ? $_POST["current_page"] : 1;
    $bci_page_1 = isset($_POST["page_1"]) ? $_POST["page_1"] : null;
    $bci_page_2 = isset($_POST["page_2"]) ? $_POST["page_2"] : null;
    $bci_page_3 = isset($_POST["page_3"]) ? $_POST["page_3"] : null;

    // Page 1 variables
    $is_exact_schedule = null;
    if($bci_page_1 != null){
        $is_exact_schedule = 
        isset($bci_page_1["is_exact_schedule"]) ? isset($bci_page_1["is_exact_schedule"]) : "false";
    }

    // var_dump($_POST);
?>
<?php 
    if($is_exact_schedule != null && $is_exact_schedule == true){
?>
    <div class="">
<?php
        include($level."/components/forms/UCPFC-1-alt.php");
    } else {
?>
    <div class="d-flex flex-column justify-content-between h-100">
        <div>
            <!-- BUTTON SELECT -->
            <h5 class="text-center">Date</h5>
            <div class="flex-column flex-lg-row align-items-center justify-content-lg-around d-flex">
                <button id="schedule-within-3-days-btn" type="button" class="date-btn btn  d-block d-lg-inline btn-outline-secondary">
                    Within 3 Days
                </button>

                <button id="schedule-within-week-btn" type="button" class="date-btn btn  d-block d-lg-inline btn-outline-secondary">
                    Within A Week
                </button>

                <button id="schedule-within-month-btn" type="button" class="date-btn btn  d-block d-lg-inline btn-outline-secondary">
                    Within A Month
                </button>

                <button id="schedule-specific-date-btn" type="button" class="date-btn btn  d-block d-lg-inline btn-outline-secondary">
                    Specific date
                </button>
            </div>
            <hr class="custom">
            <!-- CHECK BOXES -->
            <h5 class="text-center">Time Preference</h5>
            <div class="d-flex flex-column justify-content-center align-items-center">
                <div class="checkbox-lg custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="pref_morning" name="pref_morning">
                    <label class="custom-control-label" for="pref_morning">Morning (7:00am-11:30am)</label>
                </div>
                <div class="checkbox-lg custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="pref_afternoon" name="pref_afternoon">
                    <label class="custom-control-label" for="pref_afternoon">Afternoon (12:30nn-5:00pm)</label>
                </div>
                <div class="checkbox-lg custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="pref_evening" name="pref_evening">
                    <label class="custom-control-label" for="pref_evening">Evening (5:00pm-9:30pm)</label>
                </div>
            </div>
            <!-- SELECT BOXES -->
            <div class="mt-4 align-items-center justify-content-between d-flex">
                <div class="flex-1 w-30 custom-hr"></div>
                <p class="flex-1">or choose a specific time</p>
                <div class="flex-1 w-30 custom-hr"></div>
            </div>
            <div class="justify-content-center d-flex">
                <input id="timePicker" class="form-control select-width" type="time" placeholder="Select Time">
            </div>
        </div>

        <div class="justify-content-center d-flex mt-4">
            <button type="button" id="btn-page-1" class="btn btn-lg btn-warning text-white select-width">
                    Next
            </button>
        </div>
<?php 
    }
?>
    </div>



<div class="form-group">

    <!-- <label class="text-left" for="text1">Text</label>
    <input type="text" class="form-control" id="text1" name="text1" placeholder="text" 
    value=<?php 
        // if($bci_page_1 != null){
        //     echo isset($bci_page_1["text1"]) ? $bci_page_1["text1"] : "";
        // }
    ?>> -->

    <!-- Hidden Feilds -->
    <input type="hidden" class="form-control" id="text2" name="text2" placeholder="text" 
    value=<?php 
        if($bci_page_2 != null){
            echo isset($bci_page_2["text2"]) ? $bci_page_2["text2"] : "";
        }
    ?>>

    <input type="hidden" class="form-control" id="text3" name="text3" placeholder="text"
    value=<?php 
        if($bci_page_3 != null){
            echo isset($bci_page_3["text3"]) ? $bci_page_3["text3"] : "";
        }
    ?>>

    <!-- Is Exact Date Input -->
    <input type="hidden" class="form-control" id="is_exact_schedule" name="is_exact_schedule" 
    value="<?php echo $is_exact_schedule ?? "false";?>">

    <!-- Date Value Input -->
    <input type="hidden" class="form-control" id="preferred_date" name="preferred_date"
    value=<?php 
        if($bci_page_3 != null){
            echo isset($bci_page_1["preferred_date"]) ? $bci_page_1["preferred_date"] : "";
        }
    ?>>
    <!-- Time Value Input -->
        <input type="hidden" class="form-control" id="preferred_time" name="preferred_time"
    value=<?php 
        if($bci_page_3 != null){
            echo isset($bci_page_1["preferred_time"]) ? $bci_page_1["preferred_time"] : "";
        }
    ?>>

</div>


<script>


    // const checkdate = document.getElementById("checkDate");
    // const datePicker = document.getElementById("exampleHiddendate");
    // const schedule = new Date();
    // // Add days
    // schedule.setDate(schedule.getDate()+30);
    // // Get Date
    // let date = schedule.getFullYear()+'-'+(schedule.getMonth()+1)+'-'+(schedule.getDate());

    // checkdate.addEventListener("click", ()=>{
    //     console.log(date);
    //     datePicker.value = date;
    // });
</script>