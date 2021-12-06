<?php
    $data = isset($_POST['data']) ? $_POST['data'] : null;
    $projectID = null;
    if($data != null){
        $projectID = $_POST['data']['projectID'];
        $projectID = $_POST['data']['projectID'];
    }
?>
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="signUpModalLabel">CANCEL JOB POST</h5>
        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" style="font-size:1.5em">&times;</span>
        </button>
    </div>
    <div name="modalForm">
    <form id="cancel-Project-form" type="POST"  name="cancelProjectForm">
    <div class="modal-body">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Post Name</h5>
                <h6 class="card-subtitle mb-2 text-muted">for the address at</h6>
                <p class="card-text">The address</p>
            </div>
        </div>
        <div class="form-group mt-3">
            <label for="cancellation_reason">Please provide your cancellation reason below:</label>
            <textarea class="form-control mb-0" id="cancellation_reason" rows="3" name="cancellation_reason"></textarea>
        </div>
        <div>
            <p>
                <?php 
                    echo var_dump($_POST);
                ?>
            </p>
        </div>
        <h5 class="text-center mb-2 mt-0">Are you sure your want to cancel this job post?</h5>
    </div>
        
        <div class="modal-footer d-flex flex-row justify-content-between">
            <button id="RU-submit-btn"  type="submit" value="Submit"  class="btn btn-danger text-white font-weight-bold mb-3 mt-3" style="width: 47%">
                    <span id="RU-submit-btn-txt">YES, CANCEL</span>
                    <div id="RU-submit-btn-load" class="d-none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="sr-only">Loading...</span>
                    </div>
            </button>
            <button type="button" class="btn btn-secondary" style="width: 47%" data-dismiss="modal">NO, KEEP POST</button>
        </div>
        </div>
    </form>
</div>