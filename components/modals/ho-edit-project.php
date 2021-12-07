<?php
    $data = isset($_POST['data']) ? $_POST['data'] : null;
    $projectID = null;
    $job_description = null;
    $job_post_name = null;
    $job_size_id = null;
    $preferred_date_time = null;
    $rate_offer = null;
    $rate_type_id = null;
    $home_id = null;
    $home_address = null;
    $project_type = null;
    if($data != null){
        $projectID = isset($_POST['data']['projectID']) ? $_POST['data']['projectID'] : null;
        $job_description = isset($_POST['data']['job_description']) ? $_POST['data']['job_description'] : null;
        $job_post_name = isset($_POST['data']['job_post_name']) ? $_POST['data']['job_post_name'] : null;
        $job_size_id = isset($_POST['data']['job_size_id']) ? $_POST['data']['job_size_id'] : null;
        $preferred_date_time = isset($_POST['data']['preferred_date_time']) ? $_POST['data']['preferred_date_time'] : null;
        $rate_offer = isset($_POST['data']['rate_offer']) ?  $_POST['data']['rate_offer'] : null;
        $rate_type_id = isset($_POST['data']['rate_type_id'] ) ? $_POST['data']['rate_type_id'] : null;
        $home_id = isset($_POST['data']['home_id']) ? $_POST['data']['home_id'] : null;
        $home_address = isset($_POST['data']['home_address_label']) ? $_POST['data']['home_address_label'] : null;
        $project_type = isset($_POST['data']['project_type']) ? $_POST['data']['project_type'] : null;
    }

    $curl_err = null;

    // CHANGELINKDEVPROD
    // DO A CURL REQUEST TO GRAB PROJECT TYPES
    // $url = "https://slim3api.herokuapp.com/search-proj"; // PROD
    $url = "http://localhost/slim3homeheroapi/public/search-proj"; // DEV

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

?>
<div class="modal-content">
    <?php
        if( $projectID == null){
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
        } else if ( $curl_err != null) {
    ?>    
    <div class="modal-header">
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <div>
                <b>Error loading Edit Modal!</b>
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
    <div class="modal-header">
        <h5 class="modal-title" id="signUpModalLabel">EDIT PROJECT</h5>
        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" style="font-size:1.5em">&times;</span>
        </button>
    </div>
    <div name="modalForm">
<!-- ========== -->
<!-- FORM START -->
<!-- ========== -->
    <form id="modal-edit-project" type="POST"  name="hoLoginForm">
        <div class="modal-body">
            <input type="hidden" value="<?php echo $projectID;?>" name="id">
            <div class="form-group">
                <label for="job_post_name">Project Name</label>
                <input type="text" class="form-control" id="job_post_name" name="job_post_name" 
                value="<?php echo htmlentities($job_post_name) ?? "Your Project";?>">
            </div>

        <!-- Expertise Select Box - Disabled -->
        <!-- 
        <div class="form-group">
            <label for="category">Expertise:</label>
            <select id="category" 
                class="custom-select" 
                onchange="makeSubmenu(this.value)"                                     
                data-prev="0"
                name="expertise"
                >
                    <option value="1" selected>Plumbing</option>
                    <option value="2" >Carpentry</option>
                    <option value="3" >Electrical</option>
                    <option value="4" >Gardening</option>
                    <option value="5" >Home Improvement</option>
                    <option value="6" >Cleaning</option>
            </select>
        </div> -->

        <!-- Project Type Select Box - Disabled -->
        <!-- <div class="form-group" onload="resetSelection()">
            <label for="categorySelect">Project-Type:</label>
            <select id="categorySelect" class="custom-select" disabled name="required_expertise_id">
                <option value="" selected disabled>Select Your Project Type</option>
                    <?php // for($sub = 0; $sub < count($project_types); $sub++) {?>
                        <option 
                            value="<?php // echo $project_types[$sub]->id;?>"
                            class="A BG-<?php // echo $project_types[$sub]->expertise;?> d-none"
                        >
                            <?php // echo $project_types[$sub]->type;?>
                        </option>
                    <?php 
                        // }
                    ?>
            </select>
        </div> -->


        <div class="card">
            <div class="card-body" id="address-change-content">
                <input type="hidden" value="<?php echo $home_id;?>" name="home_id">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="card-subtitle mb-2 text-muted">Address: </h6>
                    <button class="btn btn-secondary btn-sm" type="button" onclick="changeAddress(<?php echo $projectID.',\'',addslashes(htmlentities($home_address)),'\',\'',addslashes($home_id),'\'';?>)">
                            CHANGE
                    </button>
                </div>
                <p class="card-text">
                    <?php echo $home_address;?>
                </p>
                <!-- <div class="card-footer text-muted" style="background-color:#FFFFFF">

                </div> -->
            </div>
        </div>


        <?php 
            $date_time_arr = explode(" ", $preferred_date_time);
        ?>
        <div class="d-flex flex-row justify-content-between mt-3">
            <div class="form-group" style="width:49%">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="<?php echo $date_time_arr[0];?>">
            </div>
            <div class="form-group" style="width:49%">
                <label for="time">Time</label>
                <input type="time" class="form-control" id="time" name="time" value="<?php echo $date_time_arr[1];?>">
            </div>
        </div>

        <label for="job_size_id">Job Size</label>
        <select class="custom-select custom-select mb-3" id="job_size_id" name="job_size_id">
            <option value="1" <?php if($job_size_id != null && $job_size_id == 1){echo "selected";}?>>Small - Est 1 - 4 hrs</option>
            <option value="2" <?php if($job_size_id != null && $job_size_id == 2){echo "selected";}?>>Medium - Est 4 - 8 hrs.</option>
            <option value="3" <?php if($job_size_id != null && $job_size_id == 3){echo "selected";}?>>Large - Est 8+ hrs.</option>
        </select>
        <div class="d-flex justify-content-between">
            <div class="form-group" style="width:49%;">
                <label for="rate_offer">Rate offer</label>
                <input type="tel" class="form-control" id="rate_offer" name="rate_offer" value="<?php echo $rate_offer;?>">
            </div>
            <div class="form-group" style="width:49%;">
                <label for="rate_type_id">Rate Type</label>
                <select class="custom-select custom-select mb-3" id="rate_type_id" name="rate_type_id" style="width:100%;">
                    <option value="1" <?php if($rate_type_id != null && $rate_type_id == 1){echo "selected";}?>>per hour</option>
                    <option value="2" <?php if($rate_type_id != null && $rate_type_id == 2){echo "selected";}?>>per day</option>
                    <option value="3" <?php if($rate_type_id != null && $rate_type_id == 3){echo "selected";}?>>per week</option>
                    <option value="3" <?php if($rate_type_id != null && $rate_type_id == 4){echo "selected";}?>>per project</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="job_description">Description</label>
            <textarea class="form-control" id="job_description" rows="3" name="job_description" ><?php echo $job_description;?></textarea>
        </div>
        <!-- SUBMIT BUTTOM -->
        </div>
        <div class="modal-footer d-flex flex-row">
            <button id="RU-submit-btn"  type="submit" value="Submit"  class="btn btn-warning text-white font-weight-bold mb-3 mt-3 w-100 btn-lg">
                    <span id="RU-submit-btn-txt">SUBMIT</span>
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
<script src="../../js/components/modal-validation/modal-ho-edit-project.js"></script>