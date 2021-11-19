<?php
    // var_dump($_POST);
    $level = isset($_POST["level"]) ? $_POST["level"] : "../.."; 
    $images = [
        "/images/pages/registration/step-1.jpg",
        "/images/pages/registration/step-2.jpg",
        "/images/pages/registration/step-3.jpg"
    ];
    $subtitles = [
        "Complete the online HomeHero worker application process.",
        "Wait for an agent to call you for updates on your application.",
        "Login with your credentials and start earning money!"
    ];
    $infoHTML = [
        "<h6 class='mt-3 italic-text'>Requirements</h6>
        <ul>
            <li>N.B.I. Clearance</li>
            <li>Mobile Number</li>
            <li>T.O.R, TESDA or any Credentials certifying your skills.</li>
        </ul>
        <p class='card-text italic-text smol'>
            * Our agents will review your info to verify your submission. We'll never share your info with anyone else.
        </p>",
        "<p class='card-text'>The agent will let you know your application status and if any additional information is needed. </p>
        <p class='card-text'>You can login using your mobile number once your application is accepted.</p>",
        "<p class='card-text'>Login with your mobile number. An SMS confirmation will be sent and you can verify your account.</p>
        <p class='card-text'>Set-up your worker profile, set your schedule and accept job posts!</p>"
    ]
?>

<div class="row d-flex flex-column pt-0 pt-lg-3">
<img src='<?php echo $level;?>/images/logo/HH_Logo_Light.svg'>
    <h1 class="title-style-1 mt-3">Application Guide & Orientation</h1>
</div>
<div class="row mt-2 mt-lg-3">
    <?php 
        for($x=0; $x<3;$x++){
    ?>
    <div class="col-12 col-lg-4">
        <div class="card mb-3 mb-lg-0">
            <div class="card-body card-orientation">
                <!-- Image and number -->
                <div class="d-flex justify-content-center align-items-center">
                    <div class="d-flex flex-row align-items-center">
                        <h2 class="card-title d-block step-number">
                            <?php echo $x+1;?>
                        </h2>
                        <img class="orientation-img" src='<?php echo $level.$images[$x];?>'>
                    </div>
                </div>
                <!-- Text content -->
                <div class="orientation-txt-container mt-3">
                    <h6 class="card-subtitle mb-2 text-muted">
                        <?php echo $subtitles[$x]; ?>
                    </h6>
                    <?php 
                        echo  $infoHTML[$x];
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
</div>
<div class="orntn-btn-container mb-3 my-lg-3">
    <button id="next" class="btn btn-lg btn-warning text-white w-100 btn-text-1">NEXT</button>
</div>
