<?php 

session_start();
if(!isset($_SESSION["token"])){
    header("Location: ../../");
    exit();
}

// Declare variables to be used in this page
$level ="../..";
$fistName = isset($_SESSION["first_name"]) ? $_SESSION["first_name"] : "Guest";
$initials = isset($_SESSION["initials"]) ? $_SESSION["initials"] : "GU";

// Curl request to get data to fill projects page

 // $url = "http://localhost/slim3homeheroapi/public/homeowner/get-projects"; // DEV
 $url = "https://slim3api.herokuapp.com//homeowner/get-projects"; // PROD

$headers = array(
    "Authorization: Bearer ".$_SESSION["token"],
    'Content-Type: application/json',
);

// 1. Initialize
$ch = curl_init();

// 2. set options
    // URL to submit to
    // curl_setopt($ch, CURLOPT_URL, $url);

    // Return output instead of outputting it
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // Type of request = GET
    curl_setopt($ch, CURLOPT_HTTPGET, 1);

    // Set headers for auth
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    // Execute the request and fetch the response. Check for errors
    $output = curl_exec($ch);

    // Moved inside Modal Body for better display of error messages
    $mode = "PROD"; // DEV to see verbose error messsages, PROD for production build
    $curl_error_message = null;

    // ERROR HANDLING 
    if($output === FALSE){
        $curl_error_message = curl_error($ch);
    }

    curl_close($ch);

    // $output =  json_decode(json_encode($output), true);
    $output =  json_decode($output);
    
    // Declare variables to be used in this page
    $ongoingProjects = [];
    // $cities = [];
    // $homeTypes = [];
    // $barangays = [];
    // $defaultHome = null;

    if(is_object($output) && $output->success == true){
        $ongoingProjects = $output->response->ongoingProjects;
    }



// HTML STARTS HERE
require_once dirname(__FILE__)."/$level/components/head-meta.php"; 
?>
<!-- === Link your custom CSS pages below here ===-->
<script src="https://kit.fontawesome.com/d10ff4ba99.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../../css/headers/header-homeowner.css">
<link rel="stylesheet" href="../../css/footer.css">
<link rel="stylesheet" href="../../css/pages/homeowner/projects.css">
<!-- === Link your custom CSS  pages above here ===-->
</head>
<body class="container-fluid m-0 p-0  w-100 min-body-height">  
    <!-- Add your Header NavBar here-->
    <?php 
        require_once dirname(__FILE__)."/$level/components/headers/ho-signed-in.php"; 
    ?>
    <div class="min-body-height d-flex flex-column justify-content-between <?php echo $hasHeader ?? ""; ?>">
    <!-- === Your Custom Page Content Goes Here below here === -->

    <!-- ALERT FOR ERROR HANDLING -->
    <div class="container w-100 m-0 p-0 min-body-height h-100 ml-auto mr-auto gray-font d-flex flex-column">
        <?php //--------------- PHP ZONE ------------------------
        // ERROR HANDLING - Curl Error
        if($curl_error_message !== null){
        ?><!-------------------------------------------------->
         <!-- HTML ZONE : CURL ERROR HANDLING & MESSAGE DISPLAY -->

        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <div>
                <strong>Curl Error!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <p><?php echo $curl_error_message;?></p>
        </div>

        <?php //--------------- PHP ZONE ------------------------
        } // closing bracket for if

        // ERROR HANDLING - 404 curl URL
        if(!$curl_error_message &&  !is_object($output)){
        ?><!-------------------------------------------------->
        <!-- HTML ZONE : 404 ERROR HANDLING & MESSAGE DISPLAY -->


        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <div>
                <b>SERVER ERROR!</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <p>Server issue or API link not found!</p>
        </div>
    

        <?php //--------------- PHP ZONE ------------------------
        }// closing bracket for if

        // ERROR HANDLING - SERVER ERRORS
        if(!$curl_error_message &&  is_object($output) && ($output->success == false)){
        ?><!-------------------------------------------------->
        <!-- HTML ZONE : SERVER ERROR HANDLING & MESSAGE DISPLAY -->


        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <!-- TITLE -->
            <div>
                <h5>
                    <?php
                        if ($output->response && $output->response->status == 500 ){
                            echo "SERVER ERROR 500";
                        } else if ($output->response && $output->response->status == 401 ){
                            echo "SERVER ERROR 401: NOT FOUND";
                        } else {
                            echo "SERVER ERROR";
                        }
                    ?>
                </h5>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- BODY -->
            <div>
                <?php 
                    if($output->response->status){
                        echo $output->response->message;
                    }
                ?>
                </div>
        </div>





        <?php //--------------- PHP ZONE ------------------------
        }// closing bracket for if

        //echo var_dump($output);

        ?><!-------------------------------------------------->
        <!-- HTML ZONE - MAIN CONTENT -->

        <div> <!-- FOR TESTING -->
        <p>
            <?php 
                // $test = date($output->response->ongoingProjects[0]->preferred_date_time);
                // echo var_dump($output->response->ongoingProjects[0]);
            ?>
        </p>
        </div> <!-- FOR TESTING -->




    <!-- MAIN CONTENT -->
    <div class="container w-100 m-0 p-0 min-body-height h-100 ml-auto mr-auto gray-font d-flex flex-column">
        <div class="h-100">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mx-2 mx-lg">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Ongoing</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Project Name</li>
                </ol>
            </nav>
            <div class="mt-0 mb-2 d-flex align-items-center justify-content-between">
                <div>
                    <h1 class="h3 mx-2 mx-lg-0 mt-0 mb-0">Your Project Name</h1>
                </div>
                <div class="sidelink">
                    <p class="mt-3 mr-3 mr-lg-0 text-danger">CANCEL</p>
                </div>
            </div>
        </div>
        <div class="separator yellow mt-0"></div>
        <div class="h-100">
           <h4 class="mb-4 mx-2">Project Summary</h4>
           <div class="card cardigan shadow-sm mb-3">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex flex-row justify-content-between">
                        <h5>Project Name</h5>
                        <p class="mb-0 clicky">Edit</p>
                    </li>
                    <li class="list-group-item"><b class="mr-1">Status:</b> Ongoing - Not Assigned</li>
                    <li class="list-group-item"><b class="mr-1">Schedule:</b> Thu, Dec 2021 at 8:00 AM</li>
                    <li class="list-group-item"><b class="mr-1">Address:</b> 12 Apple River Road, Apas, Cebu City city</li>
                    <li class="list-group-item"><b class="mr-1">Job Size:</b> Medium (4-8 hours)</li>
                    <li class="list-group-item"><b class="mr-1">Category:</b> Carpentry</li>
                    <li class="list-group-item"><b class="mr-1">SubCategory:</b> General Plumbing</li>
                    <li class="list-group-item"><b class="mr-1">Description:</b> My shower is not working.</li>
                    <li class="list-group-item"><b class="mr-1">Your Offer:</b> My shower is not working.</li>
                </ul>
            </div>
        </div>
        <div class="separator yellow"></div>
            <h4 class="mb-4 mt-2 mx-2">Job Order Summary</h4>
            <div class="card cardigan shadow-sm mb-3">
                <ul class="list-group list-group-flush"> 
                    <li class="list-group-item"><b>Job Order ID:</b> #0000001</li>
                    <li class="list-group-item"><b>Assigned On:</b> Thu, Dec 2021 at 8:00 AM</li>
                    <li class="list-group-item"><b>Assigned Worker:</b> Flex natividad</li>
                </ul>
            </div>
        <div class="separator yellow"></div>
            <h4 class="mb-4 mt-2 mx-2">Billing Summary</h4>
            <div class="card cardigan shadow-sm mb-3">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Bill ID:</b> #0000001</li>
                    <li class="list-group-item"><b>Payment Method:</b> Cash</li>
                    <li class="list-group-item"><b>Billed On:</b> Thu, Dec 2021 at 8:00 AM</li>
                    <li class="list-group-item"><b>Paid On:</b> Thu, Dec 2021 at 8:00 AM</li>
                </ul>
            </div>
            <div class="separator yellow"></div>
            <h4 class="mb-4 mt-2 mx-2">Your Rating & Review</h4>
            <div class="card cardigan shadow-sm mb-3">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Overall Quality:</b> 5 0 0 0 0 0 </li>
                    <li class="list-group-item"><b>Professionalism:</b> 5 0 0 0 0 0 </li>
                    <li class="list-group-item"><b>Reliability:</b> 5 0 0 0 0 0 </li>
                    <li class="list-group-item"><b>Punctuality:</b> 5 0 0 0 0 0 </li>
                    <li class="list-group-item"><b>Comment:</b> Great Job!</li>
                    <li class="list-group-item"><b>Rated On:</b> Thu, Dec 2021 at 8:00 AM</li>
                </ul>
            </div>
            <div class="separator yellow"></div>
            <h4 class="yellow mb-5">Recommended HomeHeroes</h4>
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
    <!-- <script src="../../js/pages/user-create-project.js"></script> -->
</body>
</html>