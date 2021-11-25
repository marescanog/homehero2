<?php
    // Data for form rendering
    $level = $_POST["level"] ?? "../..";
    $formSkill_list =  $_POST["expertise"] ?? [
        ["id"=>1, "expertise"=>"Plumbing"],
        ["id"=>2, "expertise"=>"Carpentry"],
        ["id"=>3, "expertise"=>"Electrical"],
        ["id"=>4, "expertise"=>"Gardening"],
        ["id"=>5, "expertise"=>"Home Improvement"],
        ["id"=>6, "expertise"=>"Cleaning"]
    ];
    $formSkill_list_rightItems_count = intval(count($formSkill_list)/2);
    $formSkill_list_leftItems_count = count($formSkill_list) - $formSkill_list_rightItems_count;

    $formSelect_ratetype = $_POST["rate_type"] ?? [
        "Hour", "Day", "Week", "Project"
    ];
    $formSelect_ratetype_option = [];
    for($x = 0; $x < count($formSelect_ratetype); $x++){
        $ratestring = strtolower($formSelect_ratetype[$x]); 
        $ratestring = "per ".$ratestring;
        array_push($formSelect_ratetype_option, $ratestring );
    }

    $formSelect_certification_type = $_POST["certification_type"] ?? [
        "TESDA Certificate", "Diploma", "T.O.R/O.T.R (Collegiate Record)", "Online Certificate", "Other"
    ];

    // =================================
    // Data from User, format & clean
    $default_rate = $_POST["default_rate"] ?? null; $default_rate = $default_rate ? htmlentities(number_format($default_rate, 2, '.', '')) : null; // float
    $default_rate_type = $_POST["default_rate_type"] ?? null; $default_rate_type = htmlentities($default_rate_type); // array of strings
    $expertise_list = $_POST["expertise_list"] ?? null; // Array of expertise Ids

    $totalCertificates = $_POST["total_Certicates"] ?? 1;

?>
<?php // echo var_dump($_POST);?>
<div class="row d-flex flex-column title-2-container pt-1 pt-lg-3">
    <h2 class="title-style-2">Tell us a bit about yourself</h2>
    <h6 class="title-subtitle-1">Please answer a few quick questions to complete your application.</h6>
</div>
<form id="personal-info" method="POST" enctype="multipart/form-data">
<div class="row card-container">
    <div class="card sm-shadow">
        <div class="card-body">
            <h5 class="card-title card-subtitle-main">
                What skills do you offer as a worker?
            </h5>
            <h6 class="card-subtitle mb-0 text-muted card-subtitle-muted">
                Check all skills that apply to you
            </h6>

            <fieldset class="row check-container" style="transform: translatey(-10px);">
                <div class="col-12 p-0" >
                    <input  style="height:1px; overflow: hidden;" type="checkbox" name="skill_list" disabled>
                </div>
                <div class="col-12 col-lg-6 d-flex flex-column align-items-center" >
                    <?php
                        for($x = 0; $x < $formSkill_list_leftItems_count; $x++){
                    ?>
                        <div class="checkbox-lg custom-control custom-checkbox ml-0 ml-lg-5">
                            <input 
                                type="checkbox" class="custom-control-input" 
                                id="skill_<?php echo $formSkill_list[$x]["expertise"];?>" 
                                name="skill_list"
                                value="<?php echo $formSkill_list[$x]["id"];?>"
                                <?php 
                                    if($expertise_list != null){
                                        echo in_array($x+1, $expertise_list) ? "checked" : "";
                                    }
                                ?>
                            >
                            <label 
                                class="custom-control-label check-label" 
                                for="skill_<?php echo $formSkill_list[$x]["expertise"];?>"
                            >
                                <?php echo ucfirst($formSkill_list[$x]["expertise"]);?>
                            </label>
                        </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="col-12 col-lg-6 d-flex flex-column align-items-center" >
                    <?php
                        for(; $x < count($formSkill_list); $x++){
                    ?>
                        <div class="checkbox-lg custom-control custom-checkbox ml-0 ml-lg-5">
                            <input 
                                type="checkbox" class="custom-control-input" 
                                id="skill_<?php echo $formSkill_list[$x]["expertise"];?>" 
                                name="skill_list"
                                value="<?php echo $formSkill_list[$x]["id"];?>"
                                <?php 
                                    if($expertise_list != null){
                                        echo in_array($x+1, $expertise_list) ? "checked" : "";
                                    }
                                ?>
                            >
                            <label 
                                class="custom-control-label check-label" 
                                for="skill_<?php echo $formSkill_list[$x]["expertise"];?>"
                            >
                                <?php echo ucfirst($formSkill_list[$x]["expertise"]);?>
                            </label>
                        </div>
                    <?php
                        }
                    ?>
                </div>
            </fieldset>

            <h5 class="card-title card-subtitle-main mt-4">
                What is your desired salary goal?
            </h5>
            <h6 class="card-subtitle mb-2 text-muted card-subtitle-muted">
                Estimate how much you'd like to earn for your work.
            </h6>
            <div class="row">
                <div class="form-group col-5">
                    <input type="tel" class="form-control text-center" 
                        id="default_rate" name="default_rate"
                        placeholder="ex: 300.00"
                        <?php echo $default_rate ? "value=$default_rate" : ""; ?> 
                    >
                </div>
                <select class="custom-select text-left col-5" id="default_rate_type" name="default_rate_type" required>
                    <?php
                        for($x=0; $x<count($formSelect_ratetype_option); $x++){
                    ?>
                        <option value="<?php echo htmlentities($x+1);?>"
                            <?php 
                                if( $default_rate_type != null){
                                    echo $default_rate_type == $x+1 ? "selected": "";
                                } else {
                                    echo  $x == 0 ? "selected": "";
                                }
                            ?>
                        >
                            <?php echo htmlentities($formSelect_ratetype_option[$x]);?>
                        </option>
                    <?php
                        }
                    ?>
                </select>
            </div>

            <h5 class="card-title card-subtitle-main mt-2">
                Do you have any certifications?
            </h5>
            <h6 class="card-subtitle mb-2 text-muted card-subtitle-muted">Include any certificates (e.g. TESDA or diploma ) to increase your chances of job offers. Otherwise skip this step</h6>
            <div id="certifications">
                <?php 
                    for($y = 0; $y < $totalCertificates; $y++){
                ?>
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
                            <?php
                                for($x=0; $x<count($formSelect_certification_type); $x++){
                            ?>
                                <option 
                                    value="<?php echo $x+1;?>
                                ">
                                    <?php echo $formSelect_certification_type[$x];?>
                                </option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                <?php 
                    }
                ?>
            </div>

            <h5 class="card-title card-subtitle-main mt-4">
                What is your NBI information?
            </h5>
            <div class="row">
                <div class="form-group col-6">
                    <label for="clearance_no" class="LABEL-THICC-SMOL" >
                        N.B.I.CLEARANCE NO.
                    </label>
                    <input type="tel" class="form-control" id="clearance_no" name="clearance_no" placeholder="ex: 2103265345" >
                </div>
                <div class="form-group col-6">
                    <label for="expiration_date" class="LABEL-THICC-SMOL">
                        EXPIRATION DATE
                    </label>
                    <input type="date" class="form-control" id="expiration_date" name="expiration_date" placeholder="ex: 10/21/22" >
                </div>
            </div>
            <label for="customFile" class="LABEL-THICC-SMOL">
                PLEASE UPLOAD A RECENT COPY OF YOUR N.B.I.
            </label>
            <div class="custom-file">
                <label class="custom-file-label lightgray-text" for="nbi_photos">Choose file</label>
                <input id="nbi-file-input" type="file" class="custom-file-input" name="file" >
            </div>
        </div>
    </div>
</div>
<div class="row card-container my-3">
    <div class="col-6">
        <button id="back" type="button" class=" w-100 btn btn-outline-warning btn-text-outline">BACK</button>
    </div>
    <div class="col-6">
        <button id="next" type="submit" class=" w-100 btn btn-warning text-white btn-text-2">NEXT</button>
    </div>
</div>
</form>