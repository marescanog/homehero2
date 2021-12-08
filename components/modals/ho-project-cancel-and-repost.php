<?php
    $data = isset($_POST['data']) ? $_POST['data'] : null;
    $jobOrderID = null;
    $oldSched = null;
    $reformattedDate = null;
    $reformattedTime = null;
    $ca_rp_job_title = null;
    $ca_rp_job_type = null;
    $ca_rp_job_address = null;
    if($data != null){
        $jobOrderID = isset($_POST['data']['jobOrderID']) ? $_POST['data']['jobOrderID'] : null;
        $oldSched = isset($_POST['data']['old_date_time']) ? $_POST['data']['old_date_time'] : null;
        $ca_rp_job_title = isset($_POST['data']['job_post_name']) ? $_POST['data']['job_post_name'] : null;
        $ca_rp_job_type = isset($_POST['data']['project_type_name']) ? $_POST['data']['project_type_name'] : null;
        $ca_rp_job_address = isset($_POST['data']['home_address_label']) ? $_POST['data']['home_address_label'] : null;
    }
?>
<div class="modal-content">
    <?php 
        if($jobOrderID == null || $oldSched == null){
    ?>
        <div class="modal-header">
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <div>
                    <b>404 Project Not Found!</b>
                </div>
                <p>Please close the modal & Refresh the browser.</p>
            </div>   
            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="font-size:1.5em">&times;</span>
            </button>
        </div>
    <?php 
        }else {
    ?>
    <div class="modal-header">
        <h5 class="modal-title" id="signUpModalLabel">CANCEL & REPOST</h5>
        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" style="font-size:1.5em">&times;</span>
        </button>
    </div>
    <div name="modalForm">
    <form id="modal-reschedule-project" type="POST" >
        <div class="modal-body">
        <?php 
            if( $oldSched != null){
                $oldSched = explode(" ",$oldSched);
                $time = explode(":", $oldSched[1]);
                $date = explode("-", $oldSched[0]);
                $reformattedDate =  $date[2].'/'.$date[1].'/'.$date[0];

                $period =  $time[0] > 12 ? "PM" : "AM";
                $hours = $time[0] > 12 ?  $time[0]-12 :  $time[0]+0;
                $reformattedTime = $hours.':'.$time[1].' '.$period ;
            }
        ?>
        <input type="hidden" name="id" value="<?php echo $jobOrderID;?>">
        <div class="card  mb-3">
            <div class="card-body">
                <h5 class="card-title"><?php 
                    echo $ca_rp_job_title != null && $ca_rp_job_title != "" ? $ca_rp_job_title : ($ca_rp_job_type != null && $ca_rp_job_type != "" ? $ca_rp_job_type : "Your Reposted Project");
                ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">for the address at</h6>
                <p class="card-text"><?php echo $ca_rp_job_address;?></p>
                <h6 class="card-title">Previous Schedule</h6>
                <div class="d-flex flex-row justify-content-between">
                    <div style="width:49%">
                        <h6 class="card-subtitle mb-2 text-muted">Date</h6>
                        <p class="card-text"><?php echo $reformattedDate;?></p>
                    </div>
                    <div style="width:49%">
                        <h6 class="card-subtitle mb-2 text-muted">Time</h6>
                        <p class="card-text"><?php echo $reformattedTime;?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card  mb-3">
            <div class="card-body">
                <h6 class="card-title">New Schedule</h6>
                <div class="d-flex flex-row justify-content-between">
                    <div class="form-group" style="width:49%">
                        <label for="date" class="h6 card-subtitle mb-2 text-muted">Date</label>
                        <input type="date" class="form-control" id="date" name="date" value="<?php //echo $date_time_arr[0];?>">
                    </div>
                    <div class="form-group" style="width:49%">
                        <label for="time" class="h6 card-subtitle mb-2 text-muted">Time</label>
                        <input type="time" class="form-control" id="time" name="time" value="<?php //echo $date_time_arr[1];?>">
                    </div>
                </div>
            </div>
        </div>

        <p class="text-center mb-0" style="font-size:0.8rem;">** Cancel & Reposting will cancel this current project & make a new post with the same project details. The new post will be visible to workers in the area. Click on the Cancel & Repost button below to continue.</p>
        </div>
            <div class="modal-footer d-flex flex-row justify-content-between">
                <button id="RU-submit-btn"  type="submit" value="Submit"  class="btn btn-danger text-white font-weight-bold mb-3 mt-3" style="width: 47%">
                        <span id="RU-submit-btn-txt">CANCEL & REPOST </span>
                        <div id="RU-submit-btn-load" class="d-none">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <span class="sr-only">Loading...</span>
                        </div>
                </button>
                <button type="button" class="btn btn-secondary" style="width: 47%" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </form>
    <?php 
        }
    ?>
</div>
<script src="../../js/components/modal-validation/modal-ho-project-cancel-and-repost.js"></script>
