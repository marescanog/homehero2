<?php 

session_start();
if(!isset($_SESSION["registration_token"])){
    header("Location: ./");
    exit();
}

$level ="../..";
// $fistName = isset($_SESSION["first_name"]) ? $_SESSION["first_name"] : "Guest";
// $initials = isset($_SESSION["initials"]) ? $_SESSION["initials"] : "GU";


require_once dirname(__FILE__)."/$level/components/head-meta.php"; 

?>
<!-- === Link your custom CSS pages below here ===-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../../css/headers/register.css">
<link rel="stylesheet" href="../../css/pages/worker/register-content.css">
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
        // For pages with edit option, get if is on edit mode
        $edit = isset($_GET["edit"]) ? $_GET["edit"] == "true" : false;
        if(gettype($edit) !== "boolean"){
            $edit = false;
        }
        
        // $isComplete = true;
        // $header_title = "Complete";
        require_once dirname(__FILE__)."/$level/components/headers/worker-register.php"; 
    ?>
    <div class="header">
    <!-- === Your Custom Page Content Goes Here below here === -->

<div class="container w-100 min-height">
    <input id="page" type="hidden" value="<?php
        echo htmlentities($bci_current_page);
    ?>">
    <input id="edit" type="hidden" value="<?php
        echo htmlentities($edit);
    ?>">
    <div id="body">
        <div class="d-flex flex-column justify-content-center align-items-center pb-5 vh-100">
            <div class="d-flex flex-column justify-content-center align-items-center pb-5" style=
            "height:50%;">
                <div class="spinner-grow text-warning text-center" role="status"  style="height:50px; width:50px">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="mt-3 ml-2 text-center" style="font-size: 0.85rem;">
                    Loading...
                </div>
            </div>
        </div>
    </div>
    <?php 
        // echo var_dump($edit);
    ?>
</div>


    <!-- === Your Custom Page Content Goes Here above here === -->
    </div>
<?php require_once dirname(__FILE__)."/$level/components/foot-meta.php"; ?>
<!-- Custom JS Scripts Below -->
    <script src="../../js/pages/worker-register.js"></script>
</body>
</html>