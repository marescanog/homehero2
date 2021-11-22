<!-- 
    PHP to detect if there is already values filled in. Echo back into modal value.
    JQuery for Client side Validation? Insert into header meta?
 -->
<?php 
    $level = isset($_POST['level']) ? $_POST['level'] : '.';
?>
<div class="modal-content">
    <div class="modal-header">
        <div class="mx-auto" style="width: auto;">
            <img src="<?php echo $level?>/images/logo/HH_Logo_Light.svg">
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem -1rem -1rem 0;">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <h5 class="font-weight-bold" style="color: #707070; text-align: center; font-size:24px">Worker Registration</h5>
        <!-- <form id="registerForm" type="POST" onSubmit="switchToPINForm(event)" name="modalForm" class="cmxform m-4">
            <fieldset>



           
            
            

            

            </fieldset>
        </form> -->
        <!-- <form class="cmxform" id="commentForm" method="get" onsubmit="switchToPINForm(event)">
            <fieldset>
                <legend>Please provide your name, email address (won't be published) and a comment</legend>
                <p>
                <label for="cname">Name (required, at least 2 characters)</label>
                <input id="cname" name="name" minlength="2" type="text" required>
                </p>
                <p>
                <label for="cemail">E-Mail (required)</label>
                <input id="cemail" type="email" name="email" required>
                </p>
                <p>
                <label for="curl">URL (optional)</label>
                <input id="curl" type="url" name="url">
                </p>
                <p>
                <label for="ccomment">Your comment (required)</label>
                <textarea id="ccomment" name="comment" required></textarea>
                </p>
                <p>
                <input class="submit" type="submit" value="Submit">
                </p>
            </fieldset>
        </form> -->
        <form  id="registerForm" method="POST">
            <fieldset>
                <!-- First Name and Last Name Input Feilds -->
                <div class="d-flex">
                    <div class="form-group w-100 mr-1">
                        <input id="RU_firstname" class="form-control" name="first_name" minlength="2" placeholder="First Name" type="text" maxlength="51" autocomplete required>
                    </div>
                    <div class="form-group w-100 ml-1">
                        <input id="RU_lastname" class="form-control" name="last_name" minlength="2" placeholder="Last Name" type="text" maxlength="51" autocomplete required>
                    </div>
                </div>
                <!-- Mobile Number input feild -->
                <div class="form-group">
                    <input type="text" class="form-control" id="RU_phone" name="phone_number" placeholder="Mobile number (09XXXXXXXXX)" autocomplete required maxlength="15">
                </div>
                <!-- Password and Confirm password input feild -->
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" autocomplete >
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Re-enter password" autocomplete >
                </div>
                <!-- Radio Button (Above 18) Input-->
                <div class="form-group">
                    <p class="text-center p-0 m-0">Are you above the age of 18? <input class="form-check-input" type="radio" name="exampleRadios" id="exasdfs" value="option1" disabled style="opacity:0"></p>
                    
                    <div class="d-flex flex-row justify-content-center mb-3">
                        <div class="d-flex">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" >
                                <label class="form-check-label" for="exampleRadios1">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2" >
                                <label class="form-check-label" for="exampleRadios2">
                                    No
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                 <!-- Check box (Above 18) Input-->

                <!-- Submit Button -->
                <button id="RU-submit-btn" type="submit" value="Submit" class="btn btn-warning text-white font-weight-bold w-100 mb-3 submit">
                    <span id="RU-submit-btn-txt">CREATE ACCOUNT</span>
                    <div id="RU-submit-btn-load" class="d-none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>

            <div class="text-center" style="font-size:0.8em;">
                <p>
                    Already have an account? <a href="#">Login</a>
                    </br>
                    Looking for work? <a href="#">Register</a> at the worker's portal.
                </p>
            </div>

            </fieldset>
        </form>
    </div>
</div>
<script src="<?php echo $level?>/js/components/modal-validation/modal-worker-register.js"></script>