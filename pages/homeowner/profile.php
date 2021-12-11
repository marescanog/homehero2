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
<link rel="stylesheet" href="../../css/pages/homeowner/projects.css">
<link rel="stylesheet" href="../../css/pages/homeowner/profile.css">
<!-- === Link your custom CSS  pages above here ===-->
</head>
<body class="container-fluid m-0 p-0  w-100 min-body-height">  
    <!-- Add your Header NavBar here-->
    <?php 
        require_once dirname(__FILE__)."/$level/components/headers/ho-signed-in.php"; 
    ?>
    <div class="min-body-height d-flex flex-column justify-content-between <?php echo $hasHeader ?? ""; ?>">
    <!-- === Your Custom Page Content Goes Here below here === -->

    <!-- Main Content -->
    <div class="container w-100 m-0 p-0 min-body-height h-100 ml-auto mr-auto gray-font d-flex flex-column">
        <div class="h-100">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mx-2 mx-lg">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="#">Profile</a></li>
                    <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
                </ol>
            </nav>
            <div class="mt-0 mb-2 d-flex align-items-center justify-content-between">
                <div>
                    <h1 class="h3 mx-2 mx-lg-0 mt-0 mb-2">Your Profile</h1>
                </div>
                <div class="sidelink">
                    <!-- <p class="mt-3 mr-3 mr-lg-0 text-danger">CANCEL</p> -->
                </div>
            </div>
        </div>
        <div class="h-100">
        <div  id="tabs" class="card-body mb-5">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <p class="nav-item nav-link active " id="nav-hire-tab" data-toggle="tab" href="#nav-hire" role="tab" aria-controls="nav-hire" aria-selected="true">Account Information</p>
                        <p class="nav-item nav-link" id="nav-work-tab" data-toggle="tab" href="#nav-work" role="tab" aria-controls="nav-work" aria-selected="false">My Addresses</p>
                        <!-- <p class="nav-item nav-link" id="nav-archived-tab" data-toggle="tab" href="#nav-archived" role="tab" aria-controls="nav-archived" aria-selected="false">Activity Summary</p> -->
                    </div>
                </nav>
                <div class="tab-content pt-1 pb-2 px-2  px-lg-3" id="nav-tabContent">
<!-- =================== -->
<!-- ACCOUNT INFORMATION -->
                    <div class="tab-pane fade show active" id="nav-hire" role="tabpanel" aria-labelledby="nav-hire-tab">
                        <div class="container">
                            <div class="row mt-3">
                                <div class="col-4 col-lg-2">
                                    <div class="avatar-size d-flex justify-content-center align-items-center">
                                        <h1 class="avatar-font">MD</h1>
                                    </div>
                                </div>
                                <div class="col-8 col-lg-10 d-flex align-items-center">
                                    <div class="h-100 d-flex flex-column pt-3">
                                        <h2 class="name-font">FirstName LastName</h2>
                                        <h5 class="number-font">09XXXXXXXXX</h5>
                                        <p class="clicky p-0 m-0"><b>Edit Info</b></p>
                                        <p class="clicky p-0 m-0"><b>Add Profile Picture</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="separator"></div>
                        <div class="container">
                            <div class="card card-width-profile">
                                <div class="card-header" style="background-color: #FFF9E6">
                                    <b>Activity Summary</b>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <b>Joined On:</b>
                                        Mon-Day-Year
                                    </li>
                                    <li class="list-group-item">
                                        <b>Total Job Posts Made:</b>
                                        0
                                    </li>
                                    <li class="list-group-item">
                                        <b>Total Completed Projects:</b>
                                        0
                                    </li>
                                    <li class="list-group-item">
                                        <b>Most posted category:</b>
                                        Plumbing
                                    </li>
                                    <li class="list-group-item">
                                        <b>Total Cancelled Projects:</b>
                                        0
                                    </li>
                                </ul>
                            </div>
                            
                        </div>
                    </div>


<!-- =================== -->
<!-- ADRESS INFORMATION -->
                    <div class="tab-pane fade" id="nav-work" role="tabpanel" aria-labelledby="nav-work-tab">
                        <div class="container mt-3">
                            <h4>Address List:</h4>
                            <?php
                                include dirname(__FILE__)."/".$level.'/components/cards/address-card.php'; 
                                include dirname(__FILE__)."/".$level.'/components/cards/address-card.php';
                                include dirname(__FILE__)."/".$level.'/components/cards/address-card.php';
                                include dirname(__FILE__)."/".$level.'/components/cards/address-card.php';
                            ?>
                        </div>
                    </div>



                    <!-- <div class="tab-pane fade" id="nav-archived" role="tabpanel" aria-labelledby="nav-archived-tab">
                        <h6 class="jumbotron-h1 mt-lg-3">
                            You have no summary at this time.
                        </h6>
                    </div> -->

                </div>
            </div>






        </div>
        <!-- <div class="separator"></div>
        <div class="mx-2 mx-lg">
            <h4>Recommended Matches</h4>
        </div> -->
    </div>
    <!-- Footer Links -->
    <?php 
        require_once dirname(__FILE__)."/$level/components/footer.php"; 
    ?>
    <!-- === Your Custom Page Content Goes Here above here === -->
    </div>
<?php require_once dirname(__FILE__)."/$level/components/foot-meta.php"; ?>
<!-- Custom JS Scripts Below -->
    <!-- <script src="../../js/pages/user-create-project.js"></script> -->
</body>
</html>