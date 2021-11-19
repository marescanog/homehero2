<div class="row d-flex flex-column title-2-container pt-1 pt-lg-3">
    <h2 class="title-style-2">Tell us a bit about yourself</h2>
    <h6 class="title-subtitle-1">Please answer a few quick questions to complete your application.</h6>
</div>
<form>
<div class="row card-container">
    <div class="card sm-shadow">
        <div class="card-body">
            <h5 class="card-title card-subtitle-main">
                What skills do you offer as a worker?
            </h5>
            <h6 class="card-subtitle mb-2 text-muted card-subtitle-muted">
                Check all skills that apply to you
            </h6>
            <div class="row check-container">
                <div class="col-12 col-lg-6 d-flex flex-column justify-content-center align-items-center">
                    <div class="checkbox-lg custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="skill_carpentry" name="skill_carpentry">
                        <label class="custom-control-label check-label" for="skill_carpentry">Carpentry</label>
                    </div>
                    <div class="checkbox-lg custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="skill_electrical" name="skill_electrical">
                        <label class="custom-control-label check-label" for="skill_electrical">Electrical</label>
                    </div>
                    <div class="checkbox-lg custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="skill_gardening" name="skill_gardening">
                        <label class="custom-control-label check-label" for="skill_gardening">Gardening</label>
                    </div>
                </div>
                <div class="col-12 col-lg-6 d-flex flex-column justify-content-center align-items-center">
                    <div class="checkbox-lg custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="skill_plumbing" name="skill_plumbing">
                        <label class="custom-control-label check-label" for="skill_plumbing">Plumbing</label>
                    </div>
                    <div class="checkbox-lg custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="skill_home_improvement" name="skill_home_improvement">
                        <label class="custom-control-label check-label" for="skill_home_improvement">Home Improvement</label>
                    </div>
                    <div class="checkbox-lg custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="skill_cleaning" name="skill_cleaning">
                        <label class="custom-control-label check-label" for="skill_cleaning">Cleaning</label>
                    </div>
                </div>
            </div>

            <h5 class="card-title card-subtitle-main mt-4">
                What is your desired salary goal?
            </h5>
            <h6 class="card-subtitle mb-2 text-muted card-subtitle-muted">
                Estimate how much you'd like to earn for your work.
            </h6>
            <div class="row">
                <div class="form-group col-5">
                    <input type="text" class="form-control text-center" id="default_rate" name="default_rate" placeholder="ex: 300.00">
                </div>
                <select class="custom-select text-left col-5" id="default_rate_type" name="default_rate_type">
                    <option value="1" selected>per hour</option>
                    <option value="2">per day</option>
                    <option value="3">per week</option>
                    <option value="4">project-based</option>
                </select>
            </div>

            <h5 class="card-title card-subtitle-main mt-2">
                Do you have any certifications?
            </h5>
            <h6 class="card-subtitle mb-2 text-muted card-subtitle-muted">Include any certificates (e.g. TESDA or diploma ) to increase your chances of job offers. Otherwise skip this step</h6>
            <div id="certifications">
                <div>
                    <label for="certificate-1" class="LABEL-THICC-SMOL">
                        PLEASE UPLOAD YOUR CERTIFICATES OR DIPLOMAS
                    </label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="certificate-1" name="certificate-1">
                        <label class="custom-file-label lightgray-text" for="certificate-1">Choose file</label>
                    </div>
                    <select class="custom-select text-left col-10 mt-2" id="certificate_type_1" name="certificate_type_1">
                        <option selected disabled>Choose a certificate type</option>
                        <option value="1">TESDA Certificate</option>
                        <option value="2">Diploma</option>
                        <option value="3">T.O.R/O.T.R (Collegiate Record)</option>
                        <option value="4">Online Certificate</option>
                        <option value="4">Other</option>
                    </select>
                </div>
            </div>

            <h5 class="card-title card-subtitle-main mt-4">
                What is your NBI information?
            </h5>
            <div class="row">
                <div class="form-group col-6">
                    <label for="clearance_no" class="LABEL-THICC-SMOL">
                        N.B.I.CLEARANCE NO.
                    </label>
                    <input type="text" class="form-control" id="clearance_no" name="clearance_no" placeholder="ex: 2103265345">
                </div>
                <div class="form-group col-6">
                    <label for="expiration_date" class="LABEL-THICC-SMOL">
                        EXPIRATION DATE
                    </label>
                    <input type="text" class="form-control" id="expiration_date" name="expiration_date" placeholder="ex: 10/21/22">
                </div>
            </div>
            <label for="customFile" class="LABEL-THICC-SMOL">
                PLEASE UPLOAD A RECENT COPY OF YOUR N.B.I.
            </label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="nbi_photos" name="nbi_photos">
                <label class="custom-file-label lightgray-text" for="nbi_photos">Choose file</label>
            </div>
        </div>
    </div>
</div>
<div class="row card-container my-3">
    <div class="col-6">
        <button id="back" type="button" class=" w-100 btn btn-outline-warning btn-text-outline">BACK</button>
    </div>
    <div class="col-6">
        <button id="next" type="button" class=" w-100 btn btn-warning text-white btn-text-2">NEXT</button>
    </div>
</div>
</form>