<?php 

session_start();
if(!isset($_SESSION["token"])){
    header("Location: ../../");
    exit();
}

$level ="../..";
$fistName = isset($_SESSION["first_name"]) ? $_SESSION["first_name"] : "Guest";
$initials = isset($_SESSION["initials"]) ? $_SESSION["initials"] : "GU";

$currentTab = isset($_GET['tab']) ? $_GET['tab'] : "accInfo"; // used to direct to closed tab

// Do a cURL request to get the necessary info
// NODEPLOYEDPRODLINK
$url = "http://localhost/slim3homeheroapi/public/homeowner/get-account-summary"; // DEV
// $url = ""; // PROD (No Deployed Prod Link)

$headers = array(
    "Authorization: Bearer ".$_SESSION["token"],
    'Content-Type: application/json',
);

// 1. Initialize
$ch = curl_init();

// 2. set options
    // URL to submit to
    curl_setopt($ch, CURLOPT_URL, $url);

    // Return output instead of outputting it
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // Type of request = POST
    // curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPGET, 1);

    // Set headers for auth
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Execute the request and fetch the response. Check for errors
    $output = curl_exec($ch);

    $curl_error = null;

    if($output === FALSE){
        $curl_error = "cURL Error:" . curl_error($ch);
    }

    curl_close($ch);

    // $output =  json_decode(json_encode($output), true);
    $output =  json_decode($output);

    $profilePic = false;
    $accInfo = null;
    $total_job_posts = null;
    $total_completed_projects = null;
    $most_posted_category = null;
    $total_cancelled_projects = null;
    $all_addr = [];
    if($output != null && $output->response != null){
        $accInfo = $output->response->accInfo;
        $profilePic = $output->response->profilePic;
        $total_job_posts = $output->response->total_job_posts;
        $total_completed_projects = $output->response->total_completed_projects;
        $most_posted_category = $output->response->most_posted_category;
        $total_cancelled_projects = $output->response->total_cancelled_projects;
        $all_addr = $output->response->all_addresses;
    }




// HTML PAGE STARTS HERE BELOW
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

<!-- Main Content Container Start -->
    <div class="container w-100 m-0 p-0 min-body-height h-100 ml-auto mr-auto gray-font d-flex flex-column">
<!-- TEST AREA -->
<?php 
    // echo var_dump($output);
?>
<!-- TEST AREA -->
<!-- ERROR HANDLING -->
<?php 
    if($output!= null && ($curl_error != null || gettype($output) == "string" || $output->success == false)){
?>
<div class="title-2-container alert alert-danger alert-dismissible fade show" role="alert">
    <div>
        <h6>
            <strong>
                <?php 
                    if(gettype($output) == "string"){
                        echo "500: Server Error";
                    }else if($curl_error != null){
                        echo "Curl Error!";
                    } else if ($output->success == false && $output->response != null && $output->response->status == 401){
                        echo "Token Expired or Wrong Token";
                    } else {
                        echo "500: Server Error";
                    }
                ?>
            </strong>
        </h6>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div>
        <p>                
            <?php 
                if(gettype($output) == "string"){
                    echo $output;
                }else if ($output->success == false && $output->response != null && $output->response->status == 401){
                    echo $output->response->message;
                } else  {
                    echo "Something went wrong";
                }
            ?>
        </p>
    </div>
</div>
<?php 
    } else if ($output == null){
?>
    <div class="title-2-container alert alert-danger alert-dismissible fade show" role="alert">
        <div>
            <h6>500 Error</h6>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div>
            <p>Something went wrong</p>
        </div>
    </div>
<?php 
    }
?>

<!-- ERROR HANDLING -->
<!-- Main Content START -->
        <div class="h-100">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mx-2 mx-lg">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">Profile</li>
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
                        <!-- ============= -->
                        <!-- Acc info Tab -->
                        <!-- ============= -->
                        <p class="nav-item nav-link 
                        <?php 
                            if($currentTab != null){
                                switch($currentTab){
                                    case "address":
                                    break;
                                    // case "orders":
                                    // break;
                                    default:
                                        echo "active";
                                }
                            } else {
                                echo "active";
                            }
                        ?>" 
                            id="nav-hire-tab" data-toggle="tab" 
                            href="#nav-hire" role="tab" aria-controls="nav-hire" 
                            aria-selected="<?php 
                            if($currentTab != null){
                                switch($currentTab){
                                    case "address":
                                    break;
                                    // case "orders":
                                    // break;
                                    default:
                                        echo "true";
                                }
                            } else {
                                echo "true";
                            }
                            ?>">
                            Account Information
                        </p>
                        <!-- ============= -->
                        <!-- My Addr Tab -->
                        <!-- ============= -->
                        <p class="nav-item nav-link
                             <?php 
                                if($currentTab != null){
                                    if($currentTab == "address"){
                                        echo "active";
                                    }
                                }
                            ?>" 
                            id="nav-work-tab" data-toggle="tab" 
                            href="#nav-work" role="tab" aria-controls="nav-work" aria-selected="
                            <?php 
                                if($currentTab != null){
                                    if($currentTab == "address"){
                                        echo "true";
                                    } else {
                                        echo "false";
                                    }
                                }
                            ?>">
                            My Addresses
                        </p>
                        <!-- <p class="nav-item nav-link" id="nav-archived-tab" data-toggle="tab" href="#nav-archived" role="tab" aria-controls="nav-archived" aria-selected="false">Activity Summary</p> -->
                    </div>
                </nav>
                <div class="tab-content pt-1 pb-2 px-2  px-lg-3" id="nav-tabContent">
<!-- =================== -->
<!-- ACCOUNT INFORMATION -->
                    <div class="tab-pane fade                         
                        <?php 
                            if($currentTab != null){
                                switch($currentTab){
                                    case "address":
                                    break;
                                    // case "orders":
                                    // break;
                                    default:
                                        echo " show active";
                                }
                            } else {
                                echo " show active";
                            }
                        ?>"
                        id="nav-hire" role="tabpanel"
                        aria-labelledby="nav-hire-tab">
                        <div class="container">
                            <div class="row mt-3">
                                <div class="col-4 col-lg-2">
                    <!-- Profile Picture -->
                                    <?php 
                                        if($profilePic != false){
                                    ?>
                                        <div class="avatar-size d-flex justify-content-center align-items-center">
                                            <img src="<?php echo $profilePic->file_path?>" class="img-fluid avatar-size" alt="Avatar">
                                        </div>
                                    <?php 
                                        } else {
                                    ?>
                                        <div class="avatar-size d-flex justify-content-center align-items-center">
                                            <h1 class="avatar-font"><?php echo $initials;?></h1>
                                        </div>
                                    <?php 
                                        }
                                    ?>
                                </div>
                                <div class="col-8 col-lg-10 d-flex align-items-center">
                                    <div class="h-100 d-flex flex-column pt-3">
                                        <h2 class="name-font">
                                            <?php 
                                                echo $accInfo == null ? "" : htmlentities($accInfo->first_name).' '.htmlentities($accInfo->last_name);
                                            ?>
                                        </h2>
                                        <h5 class="number-font">
                                            <?php 
                                                echo $accInfo == null ? "" : $accInfo->phone_no;
                                            ?>
                                        </h5>
                                        <p id="hook-edit-name" class="clicky p-0 m-0" data-toggle="modal" data-target="#modal">
                                            <b>Edit Name</b>
                                        </p>
                                        <p id="hook-add-pic" class="clicky p-0 m-0" data-toggle="modal" data-target="#modal">
                                            <b>Add Profile Picture</b>
                                        </p>
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
                                        <?php 
                                            $date_join=date_create($accInfo->created_on);
                                            echo date_format($date_join,"M d, Y");
                                        ?>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Total Job Posts Made:</b>
                                        <?php 
                                            echo $total_job_posts;
                                        ?>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Total Completed Projects:</b>
                                        <?php 
                                            echo $total_completed_projects;
                                        ?>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Most posted project category:</b>
                                        <?php 
                                            echo $most_posted_category;
                                        ?>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Total Cancelled Projects:</b>
                                        <?php 
                                            echo $total_cancelled_projects;
                                        ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="separator"></div>
                            <div class="container mt-2">
                                <h6 class="mb-3">Account Security</h6>
                                <p class="clicky">Change Password</p>
                                <p class="clicky">Change Phone Number</p>
                            </div>
                        </div>
                    </div>


<!-- =================== -->
<!-- ADRESS INFORMATION -->
                    <div class="tab-pane fade                    
                    <?php 
                        if($currentTab != null){
                            if($currentTab == "address"){
                                echo " show active";
                            }
                        }
                    ?>"  id="nav-work" role="tabpanel" aria-labelledby="nav-work-tab">
                        <div class="container mt-3">
                            <h4>Address List:</h4>
                            <?php
                                for($x = 0; $x < count($all_addr); $x++){
                                    $complete_w_city = $all_addr[$x]->complete_address;
                                    $complete_w_city = explode(",",  $complete_w_city);
                                    $city = $complete_w_city[2];
                                    $complete_addr =  $complete_w_city[0].", ".$complete_w_city[1];
                                    $home_type =  $all_addr[$x]->home_type;
                                    $home_id =  $all_addr[$x]->home_id;
                                    $extra_info = $all_addr[$x]->extra_address_info;
                                    include dirname(__FILE__)."/".$level.'/components/cards/address-card.php';
                                }
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
    <script src="../../js/pages/user-profile.js"></script>
</body>
</html>