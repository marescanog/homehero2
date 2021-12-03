<?php 

session_start();
if(!isset($_SESSION["token"])){
    header("Location: ../../");
    exit();
}

// Declare variables to be used in this page
$level ="../..";
$fistName = isset($_SESSION["first_name"]) ? $_SESSION["first_name"] : "Guest"; // used by header
$initials = isset($_SESSION["initials"]) ? $_SESSION["initials"] : "GU"; // used by header
$project_id = isset($_GET["id"]) ? $_GET["id"] : null;

// redirect back to projects when no project ID is given
if($project_id == null){
    header("Location: ../homeowner/projects.php");
}

// Curl request to get data to fill projects page

 $url = "http://localhost/slim3homeheroapi/public/homeowner/get-single-project-complete-info/".$project_id; // DEV
// $url = "https://slim3api.herokuapp.com//homeowner/get-projects"; // PROD

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
    
    // Declare & initialize variables to be used in this page
    $singleJobPost = false;
    $singleJobOrder = false;
    $singleBill = false;
    $singleReview = false;

    $project_name = null;
    $status = null;
    $schedule = null;
    $address = null;
    $job_size = null;
    $category = null;
    $subcategory = null;
    $description = null;
    $rate_offer = null;
    $rate_type = null;
    $your_offer = null;
    $date_time_closed = null;
    $cancellation_reason = null;

    $job_order_id =  null;
    $assigned_on =  null;
    $assigned_worker =  null;
    $date_time_start =  null;
    $date_time_closed =  null;

    $bill_id =  null;
    $bill_status =  null;
    $bill_pay_complete_date =  null;
    $bill_on =  null;
    $bill_payment_method =  null;
    $bill_total_price_billed =  null;

    if(is_object($output) && $output->success == true){
        $singleJobPost = $output->response->singleJobPost;
        $singleJobOrder = $output->response->singleJobOrder;
        $singleBill = $output->response->singleBill;
        $singleReview = $output->response->singleReview;

        $project_name = $singleJobPost->job_post_name;
        $status = $singleJobPost->job_post_status_id;
        $schedule = $singleJobPost->preferred_date_time;
        $address = $singleJobPost->complete_address;
        $job_size = $singleJobPost->job_order_size;
        $category = $singleJobPost->expertise;
        $subcategory = $singleJobPost->project_type;
        $description = $singleJobPost->job_description;
        $rate_offer = $singleJobPost->rate_offer;
        $rate_type = $singleJobPost->rate_type;
        $your_offer = $rate_offer." /".$rate_type;
        $date_time_closed = $singleJobPost->date_time_closed;
        $cancellation_reason = $singleJobPost->cancellation_reason;

        if( $singleJobOrder !== false){
            $job_order_id =  $singleJobOrder->id;
            $assigned_on =  $singleJobOrder->assigned_on;
            $assigned_worker =  $singleJobOrder->assigned_worker;
            $date_time_start =  $singleJobOrder->date_time_start;
            $date_time_closed =  $singleJobOrder->date_time_closed;
        }

        if($singleBill != false){
            $bill_id = $singleBill->id;
            $bill_status = $singleBill->status;
            $bill_pay_complete_date = $singleBill->date_time_completion_paid;
            $bill_on = $singleBill->billed_on;
            $bill_payment_method = $singleBill->payment_method;
            $bill_total_price_billed = $singleBill->total_price_billed;
        }

        if($singleReview != false){
            $overall = $singleReview->overall_quality;
            $professionalism = $singleReview->professionalism;
            $reliability = $singleReview->reliability;
            $punctuality = $singleReview->punctuality;
            $comment = $singleReview->comment;
            $created_on = $singleReview->created_on;
            $computedRating = ($overall + $professionalism + $reliability +  $punctuality ) / 4;
        }
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
                        } else if ($output->response && $output->response->status == 404 ){
                            echo "ERROR 404: NOT FOUND";
                        } else if ($output->response && $output->response->status == 401){
                            echo "ERROR 401: NOT AUTHORIZED";
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

        // echo var_dump($singleReview);


        
        //date_time_closed
        ?><!-------------------------------------------------->
        <!-- HTML ZONE - MAIN CONTENT -->

        <div> <!-- FOR TESTING -->
        <p>
            <?php 
                // $test = date($output->response->ongoingProjects[0]->preferred_date_time);
                // echo var_dump($output->response->ongoingProjects[0]);
                // echo var_dump($project_id);
            ?>
        </p>
        </div> <!-- FOR TESTING -->




    <!-- MAIN CONTENT -->
<div class="container w-100 m-0 p-0 min-body-height h-100 ml-auto mr-auto gray-font d-flex flex-column">
    <div class="h-100">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mx-2 mx-lg">
                    <li class="breadcrumb-item">
                        <a href="<?php echo $level;?>/pages/homeowner/projects.php">
                            Projects
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?php echo $level;?>/pages/homeowner/projects.php">
                            Ongoing
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?php echo $project_name == null ? "Project Name" : htmlentities($project_name);?>
                    </li>
                </ol>
            </nav>
            <div class="mt-0 mb-2 d-flex align-items-center justify-content-between">
                <div>
                    <h1 class="h3 mx-2 mx-lg-0 mt-0 mb-0">
                        Your Project: <?php echo $project_name == null ? "Project Name" : htmlentities($project_name);?>
                    </h1>
                </div>
                <div class="sidelink">
                    <p class="mt-3 mr-3 mr-lg-0 text-danger">CANCEL</p>
                </div>
            </div>
        </div>
        <div class="separator yellow mt-0"></div>
        <div class="h-100">
        <!-- ================= -->
        <!-- 404 JOB NOT FOUND -->
        <!-- ================= -->
        <?php
            if ($singleJobPost == false && $output->response && $output->response->status == 404 ){
                echo "<h1>404 NOT FOUND</h1>";
            }
        ?>
        <!-- ================= -->
        <!-- 401 JOB NOT FOUND -->
        <!-- ================= -->
        <?php
            if ($singleJobPost == false && $output->response && $output->response->status == 401 ){
                echo "<h1>401 UNAUTHORIZED ACCESS</h1>";
            }
        ?>

        <!-- ================= -->
        <!-- JOB POST SUMMARY -->
        <!-- ================= -->
        <?php
            if( $singleJobPost !== false){
        ?>
           <h4 class="mb-4 mx-2">Project Summary</h4>
           <div class="card cardigan shadow-sm mb-3">
                <ul class="list-group list-group-flush">
                    <!-- DYNAMIC BACKGROUND COLOR CHANGE BASED ON STATUS-->
                    <li class="list-group-item d-flex flex-row justify-content-between"
                        style="background-color:<?php 
                            if ($status != null){
                                switch($status){
                                    case 1: // Active
                                        echo "#FCEBBF";
                                        break;
                                    case 2: // Filled
                                        echo $date_time_closed == null ? "#d9f2d9" : "rgba(0,0,0,.04)";
                                        break;
                                    case 3: // Expired
                                        echo "#e0e0eb";
                                        break;
                                    case 4: // Cancelled
                                        echo "#ffe6e6";
                                        break;
                                    default: 
                                        echo "rgba(0,0,0,.04)";
                                }
                            } else {
                                echo "rgba(0,0,0,.04)";
                            }
                        ?>;"
                    >
                        <h5>
                            Job Post Details
                        </h5>
                        <!-- If the job post has not been filled, cancelled yet, we can edit. If expired we can re-post -->
                        <?php 
                            if ($status != null){
                                switch($status){
                                    case 1: // Active
                                        echo "<p class='mb-0 clicky'><b>EDIT</b></p>";
                                        break;
                                    case 2: // Filled
                                        break;
                                    case 3: // Expired
                                        echo "<p class='mb-0 clicky'><b>RE-POST</b></p>";
                                        break;
                                    case 4: // Cancelled
                                        echo "<p class='mb-0 clicky'><b>DISPUTE</b></p>";
                                        break;
                                    default: 
                                        echo "rgba(0,0,0,.04)";
                                }
                            }
                        ?>                        
                    </li>

                    <!-- STATUS -->
                    <li class="list-group-item"><b class="mr-1">Status: </b>
                    <span class="<?php  
                        switch($status){
                            case 2: // Filled
                                echo "text-success font-weight-bold";
                                break;
                            case 3: // Expired
                                echo "text-danger font-weight-bold";
                                break;
                            case 4: // Cancelled
                                echo "text-danger font-weight-bold";
                                break;
                        }
                    ?>">
                        <?php 
                            if ($status != null){
                                switch($status){
                                    case 1: // Active
                                        echo "Ongoing - No worker assigned";
                                        break;
                                    case 2: // Filled
                                        echo "Assigned to Homehero ".htmlentities($assigned_worker);
                                        break;
                                    case 3: // Expired
                                        echo "EXPIRED";
                                        break;
                                    case 4: // Cancelled
                                        echo "CANCELLED";
                                        break;
                                }
                            }
                        ?>
                    </span>
                    </li>
                    <li class="list-group-item"><b class="mr-1">Schedule: </b>
                    <?php echo $schedule == null ? "" : htmlentities($schedule);?>
                    </li>
                    <li class="list-group-item"><b class="mr-1">Address: </b>
                        <?php echo $address == null ? "" : htmlentities($address);?>
                    </li>
                    <li class="list-group-item"><b class="mr-1">Job Size: </b>
                        <?php echo $job_size == null ? "Project Name" : htmlentities($job_size);?>
                    </li>
                    <li class="list-group-item"><b class="mr-1">Category: </b>
                        <?php echo $category  == null ? "" : htmlentities($category );?>
                    </li>
                    <li class="list-group-item"><b class="mr-1">SubCategory: </b>
                        <?php echo $subcategory == null ? "" : htmlentities($subcategory);?>
                    </li>
                    <li class="list-group-item"><b class="mr-1">Description: </b>
                        <?php echo $description == null ? "" : htmlentities($description);?>
                    </li>
                    <li class="list-group-item"><b class="mr-1">Your Offer: </b>
                    <?php echo $your_offer == null ? "" : htmlentities($your_offer);?>
                    </li>

                    <!-- If the status is active, there is no need to display this list item -->
                    <?php
                        if( $singleJobOrder !== false){
                    ?>
                        <li class="list-group-item"><b class="mr-1">Date Booked: </b>
                            <?php echo $assigned_on == null ? "" : htmlentities($assigned_on);?>
                        </li>
                    <?php 
                        } else if ($status == 4){
                    ?>
                        <li class="list-group-item"><b class="mr-1">Date Cancelled: </b>
                            <?php echo $date_time_closed == null ? "" : htmlentities($date_time_closed);?>
                        </li>
                        
                    <?php
                        }
                    ?>
                    
                    <!-- If the status is not cancelled, there is no need to display this list item -->
                    <?php 
                        if($status == 4){
                    ?>
                        <li class="list-group-item"><b class="mr-1">Cancellation reason: </b>
                            <?php echo $cancellation_reason == null ? "" : htmlentities($cancellation_reason);?>
                        </li>
                    <?php
                        }
                    ?>

                </ul>
            </div>
        </div>
        <?php
            }
        ?>

        <!-- ================= -->
        <!-- JOB ORDER SUMMARY -->
        <!-- ================= -->
        <!-- No need to display when there is no job order assigned to this post -->
        <?php 
            if( $singleJobOrder !== false){
        ?>
            <div class="separator yellow"></div>
            <h4 class="mb-4 mt-2 mx-2">Job Order Summary</h4>
            <div class="card cardigan shadow-sm mb-3">
                <ul class="list-group list-group-flush"> 
                    <li class="list-group-item"><b>Job Order ID:</b> #<?php
                        echo $job_order_id == null ? "" : sprintf("%08d", $job_order_id);
                    ?></li>
                    <li class="list-group-item"><b>Assigned On:</b>
                        <?php echo $assigned_on == null ? "" : htmlentities($assigned_on);?>
                    </li>
                    <li class="list-group-item"><b>Assigned Worker:</b>
                         <?php echo $assigned_worker == null ? "" : htmlentities($assigned_worker);?>
                    </li>
                    <?php
                        if($date_time_start !== null){
                    ?>
                        <li class="list-group-item"><b>Date & Time Started:</b>
                            <?php echo $date_time_start == null ? "" : htmlentities($date_time_start);?>
                        </li>
                    <?php
                        }
                    ?>
                                        <?php
                        if($date_time_closed !== null){
                    ?>
                        <li class="list-group-item"><b>Date & Time Completed:</b>
                            <?php echo $date_time_closed == null ? "" : htmlentities($date_time_closed);?>
                        </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        <?php 
           }
        ?>

        <!-- ================= -->
        <!-- BILLING SUMMARY -->
        <!-- ================= -->
        <!-- No need to display when there is no bill assigned to this post -->
        <?php 
            if( $singleBill !== false){
        ?>
            <div class="separator yellow"></div>
            <h4 class="mb-4 mt-2 mx-2">Billing Summary</h4>
            <div class="card cardigan shadow-sm mb-3">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Bill ID:</b> #<?php
                        echo $job_order_id == null ? "" : sprintf("%08d", $bill_id);
                    ?></li>
                    <li class="list-group-item"><b>Payment Method:</b>
                        <?php echo $bill_payment_method == null ? "" : htmlentities($bill_payment_method);?>
                    </li>
                    <li class="list-group-item"><b>Bill Status:</b>
                        <?php echo $bill_status == null ? "" : htmlentities($bill_status);?>
                    </li>
                    <li class="list-group-item"><b>Billed On:</b>
                        <?php echo $bill_on == null ? "" : htmlentities($bill_on);?>
                    </li>
                    <li class="list-group-item"><b>Paid On:</b> 
                        <?php echo $bill_pay_complete_date == null ? "" : htmlentities($bill_pay_complete_date);?>
                    </li>
                    <li class="list-group-item"><b>Total Price Billed:</b>
                        <?php echo  $bill_total_price_billed == null ? "" : htmlentities( $bill_total_price_billed);?>
                    </li>
                </ul>
            </div>
        <?php 
           }
        ?>


        <!-- ================= -->
        <!-- REVIEW SUMMARY -->
        <!-- ================= -->
        <!-- No need to display when there is no review assigned to this post -->
        <?php 
            if( $singleReview !== false){
        ?>
            <div class="separator yellow"></div>
            <h4 class="mb-4 mt-2 mx-2">Your Rating & Review</h4>
            <div class="card cardigan shadow-sm mb-3">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Overall Rating</b>
                        <?php echo $computedRating == null ? "" : htmlentities($computedRating);?>
                    </li>
                    <li class="list-group-item"><b>Overall Quality:</b>
                        <?php echo $overall == null ? "" : htmlentities($overall);?>
                    </li>
                    <li class="list-group-item"><b>Professionalism:</b>
                        <?php echo $professionalism == null ? "" : htmlentities($professionalism);?>
                    </li>
                    <li class="list-group-item"><b>Reliability:</b> 
                        <?php echo $reliability == null ? "" : htmlentities($reliability);?>
                    </li>
                    <li class="list-group-item"><b>Punctuality:</b>
                        <?php echo $punctuality == null ? "" : htmlentities($punctuality);?> 
                    </li>
                    <li class="list-group-item"><b>Comment:</b>
                        <?php echo $comment == null ? "" : htmlentities($comment);?>
                    </li>
                    <li class="list-group-item"><b>Rated On:</b> 
                        <?php echo $created_on == null ? "" : htmlentities($created_on);?>
                    </li>
                </ul>
            </div>
        <?php 
           }
        ?>


        <!-- ================= -->
        <!-- RECOMMENDED HEROES -->
        <!-- ================= -->
        <!-- No need for recommendation when job has been cancelled, expired or filled -->
        <?php 
            if( $output->response){ 
                if($singleJobOrder == false && $status !== null && $status !== 3 && $status !== 4){
        ?>
            <div class="separator yellow"></div>
            <h4 class="yellow mb-5">Recommended HomeHeroes</h4>
        <?php 
           } else {
        ?>
            <div class="mb-5"></div>
        <?php
           }}
        ?>


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