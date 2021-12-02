<?php 

session_start();
if(!isset($_SESSION["token"])){
    header("Location: ../../");
    exit();
}

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
<link rel="stylesheet" href="../../css/forms/user-create-project-form.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<!-- <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/confetti.css"> -->
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
                    <?php 
                    
                        $project_type= isset($_POST["project_type"]) ? $_POST["project_type"] : "General project";
                        $project_id = isset($_POST["project_id"]) ? $_POST["project_id"] : null ;
                        $project_category = isset($_POST["project_category"]) ?  $_POST["project_category"] : null ;
                        $home_id = isset($_POST["home_id"]) ? $_POST["home_id"] : null ;
                        $addr = isset($_POST["address_name_label"]) ? $_POST["address_name_label"] : null ;
                        // echo  $project_id;
                        // echo  $project_category;
                        // echo  $home_id;
                    ?>
                    <p>
                    <?php //echo var_dump($_POST);?>
                    </p>

                    <div>
                        <input type="hidden" name="home_id" id="home_id"  value="<?php echo htmlentities($home_id);?>">
                        <input type="hidden" name="job_size_id" id="job_size_id">
                        <input type="hidden" name="required_expertise_id" id="required_expertise_id"  value="<?php echo htmlentities($project_id);?>">
                        <input type="hidden" name="job_post_status_id" id="job_post_status_id">
                        <input type="hidden" name="job_description" id="job_description">
                        <input type="hidden" name="rate_offer" id="rate_offer">
                        <input type="hidden" name="rate_type_id" id="rate_type_id">
                        <input type="hidden" name="is_exact_schedule" id="is_exact_schedule" value="false">
                        <input type="hidden" name="preferred_date_time" id="preferred_date_time">
                        <input type="hidden" name="days_offset" id="days_offset">
                        <input type="hidden" name="project_name" id="project_name">
                        <input type="hidden" name="address_name_label" id="address_name_label" value="<?php echo htmlentities($addr);?>">
                    </div>


                    <h3 class="info-header" >Create a project for <span id="project-labelly"><?php echo htmlentities($project_type);?></span></h3>

                    <div class="img-container">
                        <img src="<?php echo $level;?>/images/illustrations/plumbing.jpg" class="img-fluid" alt="Responsive image">
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
            <div class="form-wrapper d-flex justify-content-center min-height col-12 col-lg-9">
                <div class="w-100 flex-1 mt-4 form-container">
                    <?php 
                        if($home_id == null ||  $project_id == null){
                            // echo "you have not selected an address and a project category";
                           ?>
                           <script>
                            //  Swal.fire({
                            //     title: 'Project creation timed-out. You will be redirected to the home page.',
                            //     icon: 'info',
                            //     text: 'Click on the calendar to select a date, Click on the gray input box below box below the calendar to set a time.'
                            //  }).then((result) => {
                            //     window.location = getDocumentLevel()+'/pages/homeowner/home.php';
                            // });
                             window.alert("Project creation timed-out. You will be redirected to the home page.");
                             window.location ='../../pages/homeowner/home.php';
                           </script>
                           <?php
                        }
                        // else if($project_id == null){
                        //     // echo "you have not selected project category";
                        //     echo '<script>alert("Project creation timed-out. You will be redirected to the dashboard.")</script>';
                  
                        // }
                        // else if($home_id == null){
                        //    // echo "you have not selected an address";
                        //    echo '<script>alert("Project creation timed-out. You will be redirected to the dashboard.")</script>';
                        // }
                    ?>
                    <?php //include "../../components/forms/user-create-project-form.php";?>
                    <div id="user-create-project-form">

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
    <script src="../../js/pages/user-create-project.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</body>
</html>