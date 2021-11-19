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
<link rel="stylesheet" href="../../css/headers/register.css">
<link rel="stylesheet" href="../../css/headers/worker-side-nav.css">
<link rel="stylesheet" href="../../css/UX/breadcrumb-indicator.css">
<script src="https://kit.fontawesome.com/d10ff4ba99.js" crossorigin="anonymous"></script>
<!-- <link rel="stylesheet" href="../../css/pages/homeowner/homeowner-create-project.css"> -->
<!-- === Link your custom CSS  pages above here ===-->
</head>
 <body class="container-fluid m-0 p-0  w-100 bg-light">  
    <!-- Add your Header NavBar here-->
    <?php 
        // Get the current page number based on query string
        $bci_current_page = isset($_GET["page"]) ? $_GET["page"] : 0;
        $bci_current_page = (int) $bci_current_page;
        if($bci_current_page < 0 || $bci_current_page > 4){
            $bci_current_page = 0;
        }
        // $isComplete = true;
        // $header_title = "Complete";
        require_once dirname(__FILE__)."/$level/components/headers/worker-register.php"; 
    ?>
    <div id="header"></div>
    <div class="header">
    <!-- === Your Custom Page Content Goes Here below here === -->

<div class="container w-100 min-height bg-success">
    <div id="body"></div>
</div>


    <!-- === Your Custom Page Content Goes Here above here === -->
    </div>
<?php require_once dirname(__FILE__)."/$level/components/foot-meta.php"; ?>
<!-- Custom JS Scripts Below -->
    <script src="../../js/pages/worker-register.js"></script>
</body>
</html>