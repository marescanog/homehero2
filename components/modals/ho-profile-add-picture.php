<?php
    $profile_src = isset($_POST['data']['profile_src']) ? $_POST['data']['profile_src'] : false;
?>
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="signUpModalLabel">ADD PICTURE</h5>
        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" style="font-size:1.5em">&times;</span>
        </button>
    </div>
    <div name="modalForm">
    <form id="modal-profile-add-picture" type="POST"  name="hoLoginForm">
        <div class="modal-body">
        <?php 
            if($profile_src == false || $profile_src == "false"){
        ?>
            <div id="change-me" class="card">
                <div class="card-body">
                    <p class="card-text text-center p-0 m-0">You currently do not have a profile picture. Upload a picture to change your avatar.</p>
                </div>
            </div>
        <?php 
            } else {
        ?>
            <div id="change-me" class="card">
                <img class="card-img-top" src="<?php echo $profile_src;?>" alt="Your Profile Picture">
                <div class="card-body">
                    <p class="card-text text-center p-0 m-0">Your current profile picture</p>
                </div>
            </div>
        <?php 
            }
        ?>

        <div id="detect-image-change" class="custom-file mt-3">
            <input id="photo-file-input" type="file" class="custom-file-input" name="image" accept="image/*">
            <label id="label-photo-file-input" class="custom-file-label" for="photo-file-input">Upload a Photo</label>
        </div>


        </div>
        <div class="modal-footer d-flex flex-row">

            <button id="RU-submit-btn"  type="submit" value="Submit"  class="btn btn-warning text-white font-weight-bold mb-3 mt-3 w-100">
                    <span id="RU-submit-btn-txt">CHANGE PICTURE</span>
                    <div id="RU-submit-btn-load" class="d-none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="sr-only">Loading...</span>
                    </div>
            </button>
        </div>
        </div>
    </form>
</div>
<script src="../../js/components/modal-validation/modal-profile-change-picture.js"></script>