<?php
    $data = isset($_POST['data']) ? $_POST['data'] : null;
    $projectID = null;
    if($data != null){
        $projectID = $_POST['data']['projectID'];
    }

    $curl_err = null;

    // DO A CURL REQUEST TO GRAB PROJECT TYPES
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
    <form id="modal-login-form" type="POST"  name="hoLoginForm">
        <div class="modal-body">
        <div class="form-group">
            <label for="job_post_name">Project Name</label>
            <input type="text" class="form-control" id="job_post_name" name="job_post_name">
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

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date">
        </div>
        <div class="form-group">
            <label for="time">Time</label>
            <input type="time" class="form-control" id="time" name="time">
        </div>
        <label for="job_size_id">Job Size</label>
        <select class="custom-select custom-select mb-3" id="job_size_id" name="job_size_id">
            <option value="1" selected>Small - Est 1 - 4 hrs</option>
            <option value="2">Medium - Est 4 - 8 hrs.</option>
            <option value="3">Large - Est 8+ hrs.</option>
        </select>
        <div class="d-flex">
            <div class="form-group mr-2">
                <label for="rate_offer">Rate offer</label>
                <input type="tel" class="form-control" id="rate_offer" name="rate_offer">
            </div>
            <div class="form-group">
                <label for="rate_type_id">Rate offer</label>
                <select class="custom-select custom-select mb-3" id="rate_type_id" name="rate_type_id">
                    <option value="1" selected>per hour</option>
                    <option value="2">per day</option>
                    <option value="3">per week</option>
                    <option value="3">per project</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="job_description">Description</label>
            <textarea class="form-control" id="job_description" rows="3" name="job_description"></textarea>
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