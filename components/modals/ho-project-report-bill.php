<?php
session_start();
$output = null;
// curl to get the needed modal information


    $data = isset($_POST['data']) ? $_POST['data'] : null;
    $job_order_id = null; 
    $assigned_to = null;
    $address = null;
    if($data != null){
        $job_order_id = isset($_POST['data']['job_order_id']) ? $_POST['data']['job_order_id'] : null;
        $assigned_to = isset($_POST['data']['assigned_to']) ? $_POST['data']['assigned_to'] : null;
        $address = isset($_POST['data']['address']) ? $_POST['data']['address'] : null;
    }

    $curl_error = null;
    // Check if a report has already been filed
    if($job_order_id !== null){
        // NODEPLOYEDPRODLINK
        // DO A CURL REQUEST TO check if A Report has already been filed
        // $url = ""; // PROD (NO LIVE DEPLOYED ROUTE LINK)
         $url = "http://localhost/slim3homeheroapi/public/homeowner/has-billing-issue/$job_order_id"; // DEV
            

         $headers = array(
            "Authorization: Bearer ".$_SESSION["token"],
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
                $curl_err = curl_error($ch);
            }

            curl_close($ch);

            // $output =  json_decode(json_encode($output), true);
            $output =  json_decode($output);

           $bill_data = [];
            if($output !== null && $output->response != null && $output->response->bill_data != null){
               $bill_data = $output->response->bill_data;
            }
    }
?>
<div class="modal-content">
<!-- Curl Error handling and checking if JOB ID is found (Validation) -->
    <?php 
        if(   $job_order_id == null || $output == null) {
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
        } else if ($output !== null && $output->success == false) {
    ?>

        <div class="modal-header">
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <div>
                    <b>500 Server Error!</b>
                </div>
                <p>Please close the modal & Refresh the browser.</p>
                <!-- <<p><?php //echo $job_order_id;?></p> -->
                <p><?php echo isset($output->response) && isset($output->response->message) ? var_dump($output->response->message) : var_dump($output);?></p>
            </div>   
            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="font-size:1.5em">&times;</span>
            </button>
        </div>


    <?php 
        } else if ($curl_error != null) {
    ?>

        <div class="modal-header">
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <div>
                    <b>500 Error!</b>
                </div>
                <p>Please close the modal & Refresh the browser.</p>
            </div>   
            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="font-size:1.5em">&times;</span>
            </button>
        </div>
        
    <?php 
        } else {
    ?>
<!-- Main content -->
    <div class="modal-header">
        <h5 class="modal-title" id="signUpModalLabel">REPORT BILL ISSUE</h5>
        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" style="font-size:1.5em">&times;</span>
        </button>
    </div>
    <div name="modalForm">
    <form id="modal-report-bill" type="POST"  name="hoLoginForm">
        <div class="modal-body">

<!-- TEST AREA -->
<p>
        <?php 
             // echo var_dump($output->response->bill_data);
            // echo var_dump($output);
        ?>
    </p>

<!-- TEST AREA -->
<?php 
     if($output->response->support_ticket_info !== false){
   //     if(true){
?>
        <div class="card mb-4">
            <div class="card-body">
                <p class="text-danger small-warn">*You have already filed for a support ticket for this billing issue.</p>
                <h5 class="card-title mb-2">Support Ticket #<?php //echo $support_ticket_info->support_ticket_id == null ? "" : sprintf("%08d", $support_ticket_info->support_ticket_id);?></h5>
                <h6 class="card-subtitle mt-3 mb-2 text-muted h5"><?php //echo $rep_job_post_name  ?? ( $rep_project_type_name ?? 'Your project'); ?></h6>
                <h6 class="card-subtitle mt-2 mb-2 text-muted">for the address at</h6>
                <p class="card-text"><?php echo $address;?></p>
                <h6 class="card-subtitle mb-2 text-muted">assigned to homehero </h6>
                <p class="card-text"><?php echo $assigned_to;?></p>
            </div>
        </div>
<?php 
    } 
?>
        <div class="card">
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted">Bill Number</h6>
                <p class="card-text ml-3">#<?php  echo $bill_data->id == null ? "" : sprintf("%08d", $bill_data->id); ?></p>
                <h6 class="card-subtitle mb-2 text-muted">Bill Status</h6>
                <p class="card-text ml-3"><?php echo $bill_data->status == "Pending" ? "Pending Payment" : "Paid";?></p>
                <h6 class="card-subtitle mb-2 text-muted">Billed On</h6>
                <p class="card-text ml-3"><?php 
                    $billedOndate_formatted=date_create($bill_data->billed_on);
                    echo date_format($billedOndate_formatted,"D, M d Y, h:i A");
                ?></p>
                <?php 
                    if($bill_data->status != "Pending"){
                        $PaidOndate_formatted=date_create($bill_data->date_time_completion_paid);
                ?>
                    <h6 class="card-subtitle mb-2 text-muted">Paid On</h6>
                    <p class="card-text ml-3"><?php 
                        echo date_format($PaidOndate_formatted,"D, M d Y, h:i A");
                    ?>
                    </p>
                <?php 
                  }
                ?>
                <h6 class="card-subtitle mb-2 text-muted">Total Price</h6>
                <p class="card-text ml-3">P<?php echo $bill_data->total_price_billed;?></p>
            </div>
        </div>

<?php 
    if($output->response->support_ticket_info !== false){
?>
<button type="button" class="mt-2 btn btn-danger text-white btn-lg w-100" data-dismiss="modal">CLOSE</button>

<?php 
    } else {
?>

        <div class="form-group mt-3">
            <label for="comments">Your Concerns:</label>
            <textarea class="form-control" id="comments" name="author_description" rows="3"></textarea>
        </div>

        <input type="hidden" name="id" value="<?php echo $job_order_id;?>">
        <!-- Issue number 7 - Job Order Issue -->

        </div>
            <div class="modal-footer d-flex flex-row">
                <button id="RU-submit-btn"  type="submit" value="Submit"  class="btn btn-danger text-white font-weight-bold mb-3 mt-3 w-100 btn-lg">
                    <span id="RU-submit-btn-txt">SUBMIT TICKET</span>
                    <div id="RU-submit-btn-load" class="d-none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>
            </div>
        </div>
<?php 
    }
?>

    </form>
    <?php
        }
    ?>
</div>
<script src="../../js/components/modal-validation/modal-ho-report-bill.js"></script>