<?php
    $address = isset($address) ? $address : null;
    $d_formatted = isset($d_formatted) ? $d_formatted : null;
    $job_order_size = isset( $job_order_size) ?  $job_order_size : null;
    $pref_sched = isset($pref_sched) ? $pref_sched : null;
    $job_desc = isset($job_desc) ? $job_desc : null;
    $job_title = isset($job_title) ? $job_title: null;

    // For DB meta values
    $job_status =  isset($job_status) ? $job_status: null;
    $job_id =  isset($job_id) ? $job_id: null;
    $isRated = isset( $isRated) ?  $isRated: null;
    $job_order_id = isset($job_order_id) ? $job_order_id: null;
    $cancellation_reason = isset(  $cancellation_reason) ?   $cancellation_reason: null;
    $job_order_status_id = isset($job_order_status_id) ? $job_order_status_id: null;
    $assigned_to = isset($assigned_to) ?   $assigned_to: null;
    $bill_status_id = isset($bill_status_id) ?   $bill_status_id: null;
?>
<div class="card mt-3 mb-4 shadow ">
    <div class="card-header" style="background-color:#FCEBBF;">
        <h5 class="card-title titulo-proj"><?php echo $job_title  ?? 'Project Name'; ?></h5>
        <h6 class="mb-0 mt-0">Status: 
            <span class="
                <?php
                    if($job_status == 2){
                        echo "text-success";
                    } else if ( $job_status == 3 || $job_status == 4){
                        echo "text-danger";
                    }
                ?>
            ">
                <?php 
                if ($job_status == 1){
                    echo 'Not Assigned';
                } else if  ($job_status == 2){
                    if($job_order_status_id = 3){
                        echo 'Completed by '.$assigned_to;
                    } else {
                        echo 'Assigned To '.$assigned_to;
                    }
                } else if  ($job_status == 3){
                    echo 'Expired';
                } else if  ($job_status == 4){
                    echo 'Cancelled';
                }
                ?>
            </span>
        </h6>
    </div>
    <div class="card-body">
        <div class="d-flex flex-row align-items-center">
            <div class="gray-icon">
                <?php
                    include dirname(__FILE__)."/".$level.'/images/svg/local_offer_black_24dp.svg';  
                ?>
            </div>
            <h6 class="card-subtitle mb-2 text-muted mt-1"><b>Your offer: 50 /hr</b></h6>
        </div>
        
        <div class="d-flex flex-row">
            <div class="gray-icon">
                <?php
                    include dirname(__FILE__)."/".$level.'/images/svg/today_black_24dp.svg'; 
                ?>
            </div>
            <p id="dateLabel" class=""><b>Schedule:</b> <?php echo $d_formatted ?? 'Day, Month X at 0:00 PM'; ?></p>
        </div>

        <div class="d-flex flex-row">
            <div class="gray-icon">
                <?php
                    include dirname(__FILE__)."/".$level.'/images/svg/location_on_black_24dp.svg'; 
                ?>
            </div>
            <p id="addressLabel"> <b>Home address:</b> <?php echo $address ?? 'Address information'; ?></p>
        </div>

        <div class="d-flex flex-row">
            <div class="gray-icon">
                <?php
                    include dirname(__FILE__)."/".$level.'/images/svg/straighten_black_24dp.svg'; 
                ?>
            </div>
            <p id="jobSizeLabel"><b>Job size:</b> <?php echo $job_order_size ?? 'Job size information'; ?></p>
        </div>
        <div class="d-flex flex-row">
            <div class="gray-icon">
                <?php
                    include dirname(__FILE__)."/".$level.'/images/svg/description_black_24dp.svg'; 
                ?>
            </div>
            <p id="descLabel"><b>Description:</b> <?php echo $job_desc ?? 'Job description'; ?></p>
        </div>

        <?php if($job_status == 4){?>
            <div class="d-flex flex-row">
                <div class="gray-icon">
                    <?php
                        include dirname(__FILE__)."/".$level.'/images/svg/close_black_24dp.svg'; 
                    ?>
                </div>
                <p id="descLabel"><b>Cancellation Reason:</b> <?php echo $cancellation_reason ?? ''; ?></p>
            </div>
        <?php }?>

        <!-- <?php if($job_order_status_id == 3){?>
            <div class="d-flex flex-row">
                <div class="gray-icon">
                    <?php
                        include dirname(__FILE__)."/".$level.'/images/svg/payments_black_24dp.svg'; 
                    ?>
                </div>
                <p id="descLabel"><b>Total payment:</b> <?php //echo $cancellation_reason ?? ''; ?></p>
            </div>
        <?php }?> -->

        <!-- <?php if($job_order_status_id == 3){?>
            <div class="d-flex flex-row">
                <div class="gray-icon">
                    <?php
                        include dirname(__FILE__)."/".$level.'/images/svg/star4.svg'; 
                    ?>
                </div>
                <p id="descLabel"><b>Ratings:</b> 
                    <?php 
                     
                        if($isRated != null && $isRated == 1){
                            // compute rating
                            echo 'Your rated ';
                        } else {
                            echo 'You did not rate this job order.'; 
                        }
                    ?></p>
            </div>
        <?php }?> -->
    </div>
    <div class="card-footer text-muted">
        <div class="d-flex justify-content-between">
            <?php
                if($job_status == 1){
            ?>
                <div class="d-flex">
                    <a href="<?php echo $level;?>/pages/homeowner/project-info.php?id=<?php echo $job_id ;?>">
                        <button class="btn btn-warning text-white">
                            <b>VIEW</b>
                        </button>
                    </a>
                    <button class="btn btn btn-outline-warning ml-2">
                        EDIT
                    </button>
                </div>
                <button class="btn btn-danger">
                        CANCEL
                </button>
            <?php
                }
            ?>

            <!-- If the job is completed, a bill should be generated -->
            <!-- job status complete && bill generated -->
            <!-- if the bill is generated & bill is not paid, there should be a complete payment -->
            <!-- if the bill has been completed, there should be a rate option -->
            <?php
                if($job_status != 1){
            ?>
                <div class="d-flex">
                    <?php 
                        if($job_order_status_id != null && $job_order_status_id == 2){
                            if($bill_status_id != null && $bill_status_id == 1){
                    ?>
                        <button class="btn btn-success text-white">
                            <b>COMPLETE PAYMENT</b>
                        </button>
                    <?php 
                            }else{
                                if($isRated != null && $isRated != 1){
                    ?>  
                                <button class="btn btn-success text-white">
                                    <b>RATE</b>
                                </button>
                    <?php     
                                }
                            }
                        } 
                    ?>
                </div>
                <button class="btn btn-danger">
                        REPORT
                </button>
            <?php
                }
            ?>
        </div>
    </div>
</div>