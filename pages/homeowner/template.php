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
<link rel="stylesheet" href="../../css/headers/header-homeowner.css">
<link rel="stylesheet" href="../../css/footer.css">
<link rel="stylesheet" href="../../css/pages/homeowner/homeowner-create-project.css">
<!-- === Link your custom CSS  pages above here ===-->
</head>
 <body class="container-fluid m-0 p-0  w-100">  
    <!-- Add your Header NavBar here-->
    <?php 
        require_once dirname(__FILE__)."/$level/components/headers/ho-signed-in.php"; 
    ?>
    <div class="<?php echo $hasHeader ?? ""; ?>">
    <!-- === Your Custom Page Content Goes Here below here === -->

<div class="container container-full  w-100 m-lg-0 p-0 min-height">
    <div class="min-height content-container row flex-lg-row flex-column-reverse ">
        <!-- Info Block -->
        <div class="info col-12 col-lg-3  min-height">
            <div>
                <h3>Create a project for Plumbing Repair</h3>

                <div class="img-container">
                    <img src="../../images/illustrations/plumbing.jpg" class="img-fluid" alt="Responsive image">
                </div>
                
                <p>Specify your project details to match up with the right HomeHero</p>

                <h4>We match HomeHeroes by:</h4>
                <ul>
                    <li>Location</li>
                    <li>Services offered</li>
                    <li>Schedule</li>
                </ul>

                <h4>Looking for a different service?</h4>
                <a href="">Select another project category</a>
            </div>
        </div>
        <!-- Form Block -->
        <div class="min-height col-12 col-lg-9 form">
            <h2>Choose the best time for you</h2>
        </div>
        
    </div>
</div>
    
















    




<?php 
    require_once dirname(__FILE__)."/$level/components/footer.php"; 
?>

    <!-- === Your Custom Page Content Goes Here above here === -->
    </div>
<?php require_once dirname(__FILE__)."/$level/components/foot-meta.php"; ?>
<!-- Custom JS Scripts Below -->
    <!-- <script src="../../js/pages/user-home.js"></script> -->
    <script>

   

    </script>
</body>
</html>