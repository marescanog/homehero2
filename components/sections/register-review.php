<?php
    $daysOfTheWeek = [
        "Sun", "Mon", "Tue", "Wed", "Thur", "Fri", "Sat"
    ];
    $week = isset($_POST["week"]) ? $_POST["week"] : null;
    $isOnEdit = isset($_GET["edit"]) ? $_GET["edit"] : false;
?>
<div class="row d-flex flex-column title-2-container pt-1 pt-lg-3">
    <h2 class="title-style-2">REVIEW YOUR INFO</h2>
    <h6 class="title-subtitle-1">Please take time to review your information before your submit your application.</h6>
</div>
<form>
<div class="row card-container">
    <div class="card sm-shadow">
        <div class="card-body">
            <h5 class="card-title card-subtitle-main mb-0">
                Personal Information
            </h5>
            <p class="clicky smol pt-0 mt-0">Edit Info</p>
            <div class="row mt-2">
                <div class="col-6">
                    <p class="LABEL-THICC-SMOL m-0">
                        NAME
                    </p>
                    <p class="m-0">
                        Jose Santos
                    </p>
                </div>
                <div class="col-6">
                    <p class="LABEL-THICC-SMOL m-0">
                        MOBILE NUMBER
                    </p>
                    <p class="m-0">
                        0922-222-2222
                    </p>
                </div>
            </div>
            <hr class="custom">
            <h5 class="card-title card-subtitle-main mb-0">
                Credentials
            </h5>
            <p class="clicky smol pt-0 mt-0">Edit Info</p>
            <div class="row mt-3">
                <div class="col-6">
                    <p class="LABEL-THICC-SMOL m-0">
                        SKILLS
                    </p>
                    <p class="m-0">
                        Electrical, Carpentry
                    </p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <p class="LABEL-THICC-SMOL m-0">
                        SALARY GOAL
                    </p>
                    <p class="m-0">
                        300.00 /per day
                    </p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <p class="LABEL-THICC-SMOL m-0">
                        CERTIFICATION/DIPLOMA
                    </p>
                    <p class="m-0">
                        TESDA certificate, TOR
                    </p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <p class="LABEL-THICC-SMOL m-0">
                        NBI CLEARANCE NO.
                    </p>
                    <p class="m-0">
                        20009182378
                    </p>
                </div>
                <div class="col-6">
                    <p class="LABEL-THICC-SMOL m-0">
                        EXPIRATION DATE
                    </p>
                    <p class="m-0">
                        09/12/2022
                    </p>
                </div>
            </div>

            <hr class="custom">
            <h5 class="card-title card-subtitle-main mt-4 mb-0">
                Service Hours
            </h5>
            <p class="clicky smol pt-0 mt-0">Edit Hours</p>
            <div class="card">
                <div class="card-body">
                    <?php 
                        for($x=0; $x<7; $x++ ){
                    ?>
                    <div class="row">
                        <div class="col-4">
                            <p><?php echo $daysOfTheWeek[$x];?></p>
                        </div>
                        <div class="col-8">
                            <p class="text-center">
                                <?php
                                    $dayObj = ($week == null) ? null :  $week[$x];;
                                    if($week != null){
                                        if($dayObj["isDayOff"]){
                                            echo "Day off";
                                        }else{
                                            echo $dayObj["start"]." - ".$dayObj["end"];
                                        }
                                    } else {
                                        echo "9:00 AM - 5:00 PM";
                                    }
                                ?>
                            </p>
                        </div>
                    </div>
                    <?php 
                        }
                    ?>
                    <div class="row mt-3">
                        <div class="col-6">
                            <p class="LABEL-THICC-SMOL m-0">
                                BOOKING LEAD TIME
                            </p>
                            <p class="m-0">
                                1 month/s
                            </p>
                        </div>
                        <div class="col-6">
                            <p class="LABEL-THICC-SMOL m-0">
                                NOTICE LEAD TIME
                            </p>
                            <p class="m-0">
                                3 day/s
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="custom">
            <h5 class="card-title card-subtitle-main mt-4 mb-0">
                Service Area
            </h5>
            <p class="clicky smol pt-0 mt-0">Edit Area</p>
            <div class="row mt-3">
                <div class="col-6">
                    <p class="LABEL-THICC-SMOL m-0">
                        CITIES
                    </p>
                    <p class="m-0">
                        Cebu City, Mandaue, Talisay
                    </p>
                </div>
            </div>

            <p class="mt-3 mb-0 p-0 note-bottom">* A representative will contact you within 24-48 hours to inform you of the status of your application.</p>
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