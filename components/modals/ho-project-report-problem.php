<?php
    $data = isset($_POST['data']) ? $_POST['data'] : null;
    $job_order_id = null; 
    $assigned_to = null;
    $rep_job_post_name = null;
    $rep_project_type_name = null;
    $rep_home_address_label = null;
    $rep_assigned_to = null;
    if($data != null){
        $job_order_id = isset($_POST['data']['job_order_id']) ? $_POST['data']['job_order_id'] : null;
        $assigned_to = isset($_POST['data']['assigned_to']) ? $_POST['data']['assigned_to'] : null;
        $rep_job_post_name = isset($_POST['data']['job_post_name']) ? $_POST['data']['job_post_name'] : null;
        $rep_project_type_name = isset($_POST['data']['project_type_name']) ? $_POST['data']['project_type_name'] : null;
        $rep_home_address_label = isset($_POST['data']['home_address_label']) ? $_POST['data']['home_address_label'] : null;
        $rep_assigned_to = isset($_POST['data']['assigned_to'] )? $_POST['data']['assigned_to'] : null;
    }

    $curl_error = null;
    // Check if a report has already been filed
    if($job_order_id !== null){
        // DO A CURL REQUEST TO check if A Report has already been filed
        $url = "https://slim3api.herokuapp.com/search-proj";
            
        // 1. Initialize
        $ch = curl_init();

        // 2. set options
            // URL to submit to
            curl_setopt($ch, CURLOPT_URL, $url);

            // Return output instead of outputting it
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            // Type of request = GET
            curl_setopt($ch, CURLOPT_HTTPGET, 1);

            // Execute the request and fetch the response. Check for errors
            $output = curl_exec($ch);

            if($output === FALSE){
                $curl_err = curl_error($ch);
            }

            curl_close($ch);

            // $output =  json_decode(json_encode($output), true);
            $output =  json_decode($output);

            $project_types = [];
            if($output !== null && $output->response != null && $output->response->data != null){
                $project_types = $output->response->data;
            }
    }
?>
<div class="modal-content">
<!-- Curl Error handling and checking if JOB ID is found (Validation) -->
    <?php 
        if(   $job_order_id == null) {
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
        <h5 class="modal-title" id="signUpModalLabel">REPORT JOB ORDER PROBLEM</h5>
        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" style="font-size:1.5em">&times;</span>
        </button>
    </div>
    <div name="modalForm">
    <form id="modal-report-problem" type="POST"  name="hoLoginForm">
        <div class="modal-body">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $rep_job_post_name  ?? ( $rep_project_type_name ?? 'Your project'); ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">for the address at</h6>
                <p class="card-text"><?php echo $rep_home_address_label;?></p>
                <h6 class="card-subtitle mb-2 text-muted">assigned to homehero </h6>
                <p class="card-text"><?php echo $rep_assigned_to;?></p>
            </div>
        </div>
        

        <div class="form-group mt-3">
            <label for="comments">What is your concern?</label>
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
    </form>
    <?php
        }
    ?>
</div>
<script src="../../js/components/modal-validation/modal-ho-report-problem.js"></script>