<?php 

session_start();
if(!isset($_SESSION["token"])){
    header("Location: ../../");
    exit();
}

$level ="../../";

require_once dirname(__FILE__)."/$level/components/head-meta.php"; 

?>
<!-- === Link your custom CSS pages below here ===-->
<link rel="stylesheet" href="../../css/headers/header-homeowner.css">
<link rel="stylesheet" href="../../css/homeowner-home.css">
<link rel="stylesheet" href="../../css/footer.css">
<!-- === Link your custom CSS  pages above here ===-->
</head>
 <body class="container-fluid m-0 p-0 main-container">  
    <!-- Add your Header NavBar here-->
    <?php 
        require_once dirname(__FILE__)."/$level/components/headers/ho-signed-in.php"; 
    ?>
    <div class="<?php echo $hasHeader ?? ""; ?>">
    <!-- === Your Custom Page Content Goes Here below here === -->

<div class="container-fluid m-0 p-0 vh-100 bgc-lightgray">
    <div class="container h-100 d-flex">
        <div class="my-auto mx-auto">
            <h2 class="mb-3">Welcome Back, UserName</h2>
            <h2 class="mb-3"><span class="text-warning">Find a Hero</span> to help improve your home</h2>
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Create a new project</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Choose a category that best describes your project</h6>
                    <?php 
                        $jumb_id = "home";
                        $jumb_button_text = "GET STARTED";
                        include "$level/components/forms/jumbo_card_form.php";?>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Popular Posting -->
<?php   require_once dirname(__FILE__)."/$level/components/sections/popular-posting.php"; ?>

<!-- Testimony -->
<?php   require_once dirname(__FILE__)."/$level/components/sections/featured-heroes.php"; ?>















    




<?php 
    require_once dirname(__FILE__)."/$level/components/footer.php"; 
?>

    <!-- === Your Custom Page Content Goes Here above here === -->
    </div>
<?php require_once dirname(__FILE__)."/$level/components/foot-meta.php"; ?>
<!-- Custom JS Scripts Below -->
    <script src="<?php echo $level;?>/js/components/loadModal.js"></script>
    <script src="../../js/pages/user-home.js"></script>
    <script>

   

    </script>
</body>
</html>