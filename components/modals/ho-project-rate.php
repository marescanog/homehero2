<?php
    $level = isset($_POST['level']) ? $_POST['level'] : '../..';
    $data = isset($_POST['data']) ? $_POST['data'] : null;
    $projectID = null;
    if($data != null){
        $projectID = $_POST['data']['projectID'];
    }
?>
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="signUpModalLabel">Rate the project </h5>
        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" style="font-size:1.5em">&times;</span>
        </button>
    </div>
    <div name="modalForm">
    <form id="modal-rate-form" type="POST">
        <div class="modal-body">

        <div class="d-flex justify-content-center my-2">
            <div class="d-flex">
                    <i class="fa fa-star fa-2x px-1 Ov"  data-index="1"></i>
                    <i class="fa fa-star fa-2x px-1 Ov"  data-index="2"></i>
                    <i class="fa fa-star fa-2x px-1 Ov"  data-index="3"></i>
                    <i class="fa fa-star fa-2x px-1 Ov"  data-index="4"></i>
                    <i class="fa fa-star fa-2x px-1 Ov"  data-index="5"></i>
            </div>
        </div>
        <h6 class="text-center pt-2">Overall Quality</h6>
        <div>
            <p id="Ov-error" class="text-danger text-center p-0 m-0 d-none" style="font-size:0.8rem;">Please give a rating for Overall Quality</p>
        </div>
        <input type="hidden" name="overall_quality" value="" id="overall_quality_feild">

        <div style="margin-top:25px!important;">
            <?php
                $att = [
                    "Professionalism", "Reliability", "Punctuality"
                ];
                for($rNdx = 0; $rNdx < 3; $rNdx++ ){
                    
            ?>
            <div class="d-flex justify-content-center align-items-center flex-column pb-4">
                <div class="d-flex justify-content-between pb-0 mb-0" style="width:250px;">
                    <div>
                        <p class="m-0 p-0">
                            <?php echo $att[$rNdx]; $class_gr = substr($att[$rNdx], 0, 2);?>
                        </p>
                    </div>
                    <div class="d-flex" style="max-height:26px !important;">
                            <i class="fa fa-star pb-0 mb-0 px-1 <?php echo $class_gr;?>"  data-index="1" ></i>
                            <i class="fa fa-star pb-0 mb-0 px-1 <?php echo $class_gr;?>"  data-index="2"></i>
                            <i class="fa fa-star pb-0 mb-0 px-1 <?php echo $class_gr;?>"  data-index="3"></i>
                            <i class="fa fa-star pb-0 mb-0 px-1 <?php echo $class_gr;?>"  data-index="4"></i>
                            <i class="fa fa-star pb-0 mb-0 px-1 <?php echo $class_gr;?>"  data-index="5"></i>
                    </div>
                </div>
                <p id="<?php echo $class_gr;?>-error" class="text-danger text-center p-0 m-0 pt-1 d-none" style="font-size:0.8rem;">Please give a rating for <?php echo $att[$rNdx];?></p>
            </div>
            
            <?php
                }
            ?>
            <input type="hidden" name="professionalism" value="" id="professionalism_feild">
            <input type="hidden" name="reliability" value="" id="reliability_feild">
            <input type="hidden" name="punctuality" value="" id="punctuality_feild">

        <div class="d-flex justify-content-center mt-3">
            <div class="form-group" style="width:300px;">
                <label for="comment">Describe how great the Homehero is</label>
                <textarea class="form-control" id="comment" rows="3" name="comment"></textarea>
            </div>
        </div>
 
        <input type="hidden" name="job_order_id" value="<?php echo htmlentities($projectID);?>">

        </div>
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
</div>
<script src="../../js/components/modal-validation/modal-ho-project-rate.js"></script>