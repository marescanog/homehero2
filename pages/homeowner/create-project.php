<?php 

// session_start();
// if(!isset($_SESSION["token"])){
//     header("Location: ../../");
//     exit();
// }

$level ="../..";
$fistName = isset($_SESSION["first_name"]) ? $_SESSION["first_name"] : "Guest";
$initials = isset($_SESSION["initials"]) ? $_SESSION["initials"] : "GU";


require_once dirname(__FILE__)."/$level/components/head-meta.php"; 

?>
<!-- === Link your custom CSS pages below here ===-->
<script src="https://kit.fontawesome.com/d10ff4ba99.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../../css/headers/header-homeowner.css">
<link rel="stylesheet" href="../../css/footer.css">
<link rel="stylesheet" href="../../css/pages/homeowner/homeowner-create-project.css">
<link rel="stylesheet" href="../../css/UX/breadcrumb-indicator.css">
<!-- === Link your custom CSS  pages above here ===-->
</head>
<body class="container-fluid m-0 p-0  w-100 min-body-height">  
    <!-- Add your Header NavBar here-->
    <?php 
        require_once dirname(__FILE__)."/$level/components/headers/ho-signed-in.php"; 
    ?>
    <div class="min-body-height d-flex flex-column justify-content-between <?php echo $hasHeader ?? ""; ?>">
    <!-- === Your Custom Page Content Goes Here below here === -->

    <!-- IPad Pro spacing adjustment -->
    <div class="container container-full d-flex w-100 m-0 p-0 h-100 ipad">
        <div class="content-container  d-flex row flex-lg-row flex-column-reverse mx-auto ipad">
            <div class="info-container col-12 col-lg-3"></div>
            <div class="col-12 col-lg-9"></div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container container-full  w-100 m-0 p-0 min-height h-100">
        <div class="min-height content-container row flex-lg-row flex-column-reverse  m-auto gray-font">
            <!-- Info Block -->
            <div class="info-container col-12 col-lg-3 min-height">
                <div class="info-wrapper flex-1 gray-font">
                    <h3 class="info-header" >Create a project for Plumbing Repair</h3>

                    <div class="img-container">
                        <img src="../../images/illustrations/plumbing.jpg" class="img-fluid" alt="Responsive image">
                    </div>
                    
                    <h6 class="mt-4"><i><b>Specify your project details to match up with the right HomeHero</b></i></h6>

                    <h6 class="mt-4"><i><b>We match HomeHeroes by:</b></i></h6>
                    <ul>
                        <li>Location</li>
                        <li>Services offered</li>
                        <li>Schedule</li>
                    </ul>

                    <h6 class="mt-4"><b>Looking for a different service?</b></h6>
                    <a href="">Select another project category</a>
                </div>
            </div>
            <!-- Form Block -->
            <div class="form-wrapper d-flex justify-content-center min-height col-12 col-lg-9 text-center">
                <div class="w-100 flex-1 mt-4 form-container">
                    <!-- breadcrumb -->
                    <?php 
                        include '../../components/UX/breadcrumb-indicator.php';
                    ?>
                    <!-- Form Title -->
                    <div class="form-title-container mt-4">
                        <h3 class="pt-3 h4">Choose the best time for you</h3>
                        <p>We'll match you with a HomeHero who can be scheduled at your time preference.</p>
                    </div>
                    <!-- Form Contents -->
                    <div class="form-container">
                        <div class="card shadow-sm mb-4">
                            <div class="card-body form-height">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Form Block End -->
        </div>
    </div>

    <!-- IPad Pro spacing adjustment -->
    <div class="container container-full d-flex w-100 m-0 p-0 h-100 ipad">
        <div class="content-container  d-flex row flex-lg-row flex-column-reverse mx-auto ipad">
            <div class="info-container col-12 col-lg-3"></div>
            <div class="col-12 col-lg-9"></div>
        </div>
    </div>

    <!-- Footer Links -->
    <?php 
        require_once dirname(__FILE__)."/$level/components/footer.php"; 
    ?>
    <!-- === Your Custom Page Content Goes Here above here === -->
    </div>
<?php require_once dirname(__FILE__)."/$level/components/foot-meta.php"; ?>
<!-- Custom JS Scripts Below -->
    <!-- <script src="../../js/pages/user-home.js"></script> -->
</body>
</html>