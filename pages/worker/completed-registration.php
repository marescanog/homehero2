<?php 

session_start();
if(!isset($_SESSION["registration_token"])){
    header("Location: ./");
    exit();
}

if(!isset($_SESSION["hasRegistered"])){
    header("Location: ./");
    exit();
}

if($_SESSION["hasRegistered"] == false){
    header("Location: ./");
    exit(); 
}

$level ="../..";
// $fistName = isset($_SESSION["first_name"]) ? $_SESSION["first_name"] : "Guest";
// $initials = isset($_SESSION["initials"]) ? $_SESSION["initials"] : "GU";


require_once dirname(__FILE__)."/$level/components/head-meta.php"; 

?>
<!-- === Link your custom CSS pages below here ===-->
<link rel="stylesheet" href="../../css/headers/register.css">
<link rel="stylesheet" href="../../css/headers/worker-side-nav.css">
<link rel="stylesheet" href="../../css/UX/breadcrumb-indicator.css">
<link rel="stylesheet" href="../../css/pages/worker/register-complete.css">
<!-- === Link your custom CSS  pages above here ===-->
</head>
 <body class="container-fluid m-0 p-0  w-100 bg-light">  
    <!-- Add your Header NavBar here-->
    <?php 
        // Get the current page number based on query string
        $isComplete = true;
        $header_title = "Complete";
        require_once dirname(__FILE__)."/$level/components/headers/worker-register.php"; 
    ?>
    <div class="header">
    <!-- === Your Custom Page Content Goes Here below here === -->

<div class="container w-100 min-height title-2-container">
    <input id="page" type="hidden" value="<?php
        echo htmlentities($bci_current_page);
    ?>">
    <div class="row d-flex flex-column pt-0 pt-lg-3">
        <img src='<?php echo $level;?>/images/logo/HH_Logo_Light.svg'>
        <h1 class="title-style-1 mt-3">Application sucessfully submitted!</h1>
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center align-items-center">
            <div class="img-container">
                <img src="<?php echo $level;?>/images/pages/registration/complete.jpg" class="img-fluid" alt="Responsive image">
            </div>
        </div>
        <div class="col-12 d-flex flex-column justify-content-center">
            <p class="text-left p-text">A representative will review your information and <b>contact you within 24-48 hours.</b></p>
            <p class="text-left p-text">In the meantime, feel free to explore the HomeHero <b>dashboard while waiting for your account to be activated.</b></p>
        </div>
    </div>
    <div class="orntn-btn-container mb-3 mb-lg-3">
    <button id="next" class="btn btn-lg btn-outline-warning btn-text-outline w-100 btn-text-1">GO TO DASHBOARD</button>
</div>
</div>


    <!-- === Your Custom Page Content Goes Here above here === -->
    </div>
<?php require_once dirname(__FILE__)."/$level/components/foot-meta.php"; ?>
<!-- Custom JS Scripts Below -->
    <script src="../../js/pages/worker-complete.js"></script>
</body>
</html>