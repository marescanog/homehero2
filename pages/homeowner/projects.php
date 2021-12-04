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

$currentTab = isset($_GET['tab']) ? $_GET['tab'] : "open"; // used to direct to closed tab

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
    
    // Declare variables to be used in this page
    $ongoingJobPosts = [];
    $ongoingProjects = [];
    $closedProjects = [];

    if(is_object($output) && $output->success == true){
        $ongoingJobPosts = $output->response->ongoingJobPosts;
        $ongoingProjects = $output->response->ongoingProjects;
        $closedProjects = $output->response->closedProjects;
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

    <!-- Main Content -->
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
                 // echo var_dump($output->response->closedProjects);
            ?>
        </p>
        </div> <!-- FOR TESTING -->




        <!-- MAIN CONTENT -->
        <div class="h-100">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mx-2 mx-lg">
                    <li class="breadcrumb-item" aria-current="page"><a href="#">All projects</a></li>
                </ol>
            </nav>
            <div class="mt-0 mb-2 d-flex align-items-center justify-content-between">
                <div>
                    <h1 class="h3 mx-2 mx-lg-0 mt-0 mb-2">Your Projects</h1>
                </div>
                <!-- <div class="sidelink">
                    <p class="mt-3 mr-3 mr-lg-0 text-danger">CANCEL</p>
                </div> -->
            </div>
        </div>
        <div class="h-100">
            <div  id="tabs" class="card-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <!-- ============= -->
                        <!-- Job Posts Tab -->
                        <!-- ============= -->
                        <p class="nav-item nav-link 
                        <?php 
                            if($currentTab != null){
                                switch($currentTab){
                                    case "closed":
                                    break;
                                    case "orders":
                                    break;
                                    default:
                                        echo "active";
                                }
                            } else {
                                echo "active";
                            }
                        ?>" 
                            id="nav-hire-tab" data-toggle="tab" href="#nav-hire" role="tab" aria-controls="nav-hire" 
                            aria-selected="<?php 
                            if($currentTab != null){
                                switch($currentTab){
                                    case "closed":
                                    break;
                                    case "orders":
                                    break;
                                    default:
                                        echo "true";
                                }
                            } else {
                                echo "true";
                            }
                            ?>">
                            Job Posts
                        </p>
                        <!-- ============= -->
                        <!-- Job Orders Tab -->
                        <!-- ============= -->
                        <p class="nav-item nav-link 
                            <?php 
                                if($currentTab != null){
                                    if($currentTab == "orders"){
                                        echo "active";
                                    }
                                }
                            ?>" 
                            id="nav-work-tab" data-toggle="tab" href="#nav-orders" role="tab" aria-controls="nav-orders" aria-selected="
                            <?php 
                                if($currentTab != null){
                                    if($currentTab == "orders"){
                                        echo "true";
                                    }
                                }
                            ?>">
                            Ongoing Projects
                        </p>
                        <!-- ==================== -->
                        <!-- Closed Projects Tab -->
                        <!-- ==================== -->
                        <p class="nav-item nav-link 
                            <?php 
                                if($currentTab != null){
                                    if($currentTab == "closed"){
                                        echo "active";
                                    }
                                }
                            ?>" 
                            id="nav-work-tab" data-toggle="tab" href="#nav-work" role="tab" aria-controls="nav-work" aria-selected="
                            <?php 
                                if($currentTab != null){
                                    if($currentTab == "closed"){
                                        echo "true";
                                    }
                                }
                            ?>">
                            Closed Projects
                        </p>
                    </div>
                </nav>
                <div class="tab-content pt-1 pb-2 px-2  px-lg-3" id="nav-tabContent">
<!-- ==================== -->
<!-- Job Posts DISPLAY -->
<!-- ==================== -->
                    <div class="tab-pane fade 
                        <?php 
                            if($currentTab != null){
                                switch($currentTab){
                                    case "closed":
                                    break;
                                    case "orders":
                                    break;
                                    default:
                                        echo " show active";
                                }
                            } else {
                                echo " show active";
                            }
                        ?>" 
                        id="nav-hire" role="tabpanel" aria-labelledby="nav-hire-tab">
                        <?php //--------------- PHP ZONE ------------------------
                        // JOB POSTS DISPLAY - ONGOING
                        if(count($ongoingJobPosts) == 0 || $ongoingJobPosts == null){
                        ?><!-------------------------------------------------->
                        <!-- HTML ZONE: PROJECT DISPLAY - ONGOING -->

                            <h5 class="jumbotron-h1 mt-lg-3 mt-0 mt-md-3 mt-lg-0">
                                You have no job posts.
                            </h5>

                        <?php //--------------- PHP ZONE ------------------------
                            } else {
                                // Loop through current data
                                for($p = 0 ; $p < count($ongoingJobPosts); $p++){
                                    
                                    // Grab address value
                                    $address = $ongoingJobPosts[$p]->complete_address;
                                    
                                    // Grab Schedule value
                                    $pref_sched = $ongoingJobPosts[$p]->preferred_date_time;
                                        // Instantiate a DateTime with microseconds.
                                        $d = new DateTime($pref_sched);
                                        // Custom date time formatting
                                        $d_parsed = $d->format(DateTimeInterface::RFC7231);
                                        $d_array = explode(" ", $d_parsed);
                                        $t = $d_array[4];
                                        $hours = substr($t, 0, 2);
                                        $minutes = substr($t, 3, 2);
                                        $end =  $hours >= 12 ? 'PM' : 'AM';
                                        $hours_formatted =  $hours > 12 ? $hours - 12 : (int) $hours;
                                        $t_formatted =  $hours_formatted.':'.$minutes.' '.$end;
                                        $d_formatted = $d_array[0].' '.$d_array[2].' '.$d_array[1].' at '.$t_formatted;

                                    // Grab job order size
                                    $job_order_size = $ongoingJobPosts[$p]->job_order_size;
                                    // Grab job description
                                    $job_desc = $ongoingJobPosts[$p]->job_description;
                                    // Grab job title
                                    $job_title = $ongoingJobPosts[$p]->job_post_name;
                                    // Grab job status
                                    $job_status = $ongoingJobPosts[$p]->job_post_status_id;
                                    // Grab job id
                                    $job_id = $ongoingJobPosts[$p]->id;
                                    // Grab home_id
                                    $home_id = $ongoingJobPosts[$p]->home_id;
                                    // Grab rate_type_id
                                    $rate_type_id = $ongoingJobPosts[$p]->rate_type_id;
                                    // Grab job_size_id
                                    $job_size_id = $ongoingJobPosts[$p]->job_order_size;
                                        
                                    $is_rated = null;
                                    $job_order_id = null;
                                    $cancellation_reason = null;

                                    include dirname(__FILE__)."/".$level.'/components/cards/project-homeowner.php';
                                }
                                // Clear values;
                                $address = null;
                                $d = null;
                                $d_parsed = null;
                                $d_array = null;
                                $t = null;
                                $hours = null;
                                $minutes = null;
                                $end = null;
                                $hours_formatted = null;
                                $t_formatted = null;
                                $d_formatted = null;
                                $pref_sched = null;
                                $job_order_size = null;
                                $job_desc = null;
                                $job_title = null;
                                $job_status = null;
                                $job_id = null;
                                $home_id = null;
                                $rate_type_id = null;
                                $job_size_id = null;

                                if( count($ongoingProjects) > 3){
                                ?><!-------------------------------------------------->
                                <!-- HTML ZONE: SHOW MORE PROJECTS -->
                                    <div id="show-more"></div>
                                    <div  class="d-flex mt-4 justify-content-center text-align-center">
                                        <button class="btn btn-lg text-white btn-warning">
                                            SHOW MORE
                                        </button>
                                    </div>
                                <?php //--------------- PHP ZONE ------------------------
                                }
                            }
                        ?>
                    </div>


<!-- =================== -->
<!-- Job orders display -->
<!-- =================== -->
                    <div class="tab-pane fade 
                    <?php 
                        if($currentTab != null){
                            if($currentTab == "orders"){
                                echo " show active";
                            }
                        }
                    ?>" 
                    id="nav-orders" role="tabpanel" aria-labelledby="nav-orders-tab">
                        <?php //--------------- PHP ZONE ------------------------
                        // PROJECT DISPLAY - CLOSED
                        if(count( $ongoingProjects) == 0 ||  $ongoingProjects == null){
                        ?><!-------------------------------------------------->
                        <!-- HTML ZONE: PROJECT DISPLAY - ONGOING -->

                            <h5 class="jumbotron-h1 mt-lg-3 mt-0 mt-md-3 mt-lg-0">
                                You have no closed/cancelled projects.
                            </h5>

                        <?php //--------------- PHP ZONE ------------------------
                            } else {
                                // Loop through current data
                                for($p = 0 ; $p < count( $ongoingProjects); $p++){
                                    
                                    // Grab address value
                                    $address =  $ongoingProjects[$p]->complete_address;
                                    
                                    // Grab Schedule value
                                    $pref_sched =  $ongoingProjects[$p]->preferred_date_time;
                                        // Instantiate a DateTime with microseconds.
                                        $d = new DateTime($pref_sched);
                                        // Custom date time formatting
                                        $d_parsed = $d->format(DateTimeInterface::RFC7231);
                                        $d_array = explode(" ", $d_parsed);
                                        $t = $d_array[4];
                                        $hours = substr($t, 0, 2);
                                        $minutes = substr($t, 3, 2);
                                        $end =  $hours >= 12 ? 'PM' : 'AM';
                                        $hours_formatted =  $hours > 12 ? $hours - 12 : (int) $hours;
                                        $t_formatted =  $hours_formatted.':'.$minutes.' '.$end;
                                        $d_formatted = $d_array[0].' '.$d_array[2].' '.$d_array[1].' at '.$t_formatted;

                                    // Grab job order size
                                    $job_order_size =  $ongoingProjects[$p]->job_order_size;
                                    // Grab job description
                                    $job_desc =  $ongoingProjects[$p]->job_description;
                                    // Grab job title
                                    $job_title =  $ongoingProjects[$p]->job_post_name;
                                    // Grab job status
                                    $job_status =  $ongoingProjects[$p]->job_post_status_id;
                                    // Grab job id
                                    $job_id =  $ongoingProjects[$p]->id;
                                    // Grab home_id
                                    $home_id = $ongoingProjects[$p]->home_id;
                                    // Grab rate_type_id
                                    $rate_type_id =  $ongoingProjects[$p]->rate_type_id;
                                    // Grab job_size_id
                                    $job_size_id = $ongoingProjects[$p]->job_order_size;

                                    // Grab job_orderid
                                    $job_order_id = $closedProjects[$p]->job_order_id;

                                    // Grab job order status
                                    $job_order_status_id =  $ongoingProjects[$p]->job_order_status_id;
                                     // Grab assigned to
                                     $assigned_to =  $ongoingProjects[$p]->assigned_to;



                                    // Check if the date is beyond today's date. Otherwise mark it as expired.
                                    // echo ($job_status);

                                    // if($job_status != 2){
                                    //     echo "Not fulfilled";
                                    // }
                        
                                    

                                    include dirname(__FILE__)."/".$level.'/components/cards/project-homeowner.php';
                                }
                                // Clear values;
                                $address = null;
                                $d = null;
                                $d_parsed = null;
                                $d_array = null;
                                $t = null;
                                $hours = null;
                                $minutes = null;
                                $end = null;
                                $hours_formatted = null;
                                $t_formatted = null;
                                $d_formatted = null;
                                $pref_sched = null;
                                $job_order_size = null;
                                $job_desc = null;
                                $job_title = null;
                                $job_status = null;
                                $job_id = null;
                                $home_id = null;
                                $rate_type_id = null;
                                $job_size_id = null;
                                $is_rated = null;
                                $job_order_id = null;

                                if( count($closedProjects) > 3){
                                ?><!-------------------------------------------------->
                                <!-- HTML ZONE: SHOW MORE PROJECTS -->
                                    <div id="show-more"></div>
                                    <div  class="d-flex mt-4 justify-content-center text-align-center">
                                        <button class="btn btn-lg text-white btn-warning">
                                            SHOW MORE
                                        </button>
                                    </div>
                                <?php //--------------- PHP ZONE ------------------------
                                }
                            }
                        ?>
                    </div>



                        <!-- ========================== -->
                        <!-- Closed/ Cancelled display -->
                        <!-- ========================== -->
                    <div class="tab-pane fade 
                    <?php 
                        if($currentTab != null){
                            if($currentTab == "closed"){
                                echo " show active";
                            }
                        }
                    ?>" 
                    id="nav-work" role="tabpanel" aria-labelledby="nav-work-tab">
                    <?php //--------------- PHP ZONE ------------------------
                        // PROJECT DISPLAY - CLOSED
                        if(count($closedProjects) == 0 || $closedProjects == null){
                        ?><!-------------------------------------------------->
                        <!-- HTML ZONE: PROJECT DISPLAY - ONGOING -->

                            <h5 class="jumbotron-h1 mt-lg-3 mt-0 mt-md-3 mt-lg-0">
                                You have no closed/cancelled projects.
                            </h5>

                        <?php //--------------- PHP ZONE ------------------------
                            } else {
                                // Loop through current data
                                for($p = 0 ; $p < count($closedProjects); $p++){
                                    
                                    // Grab address value
                                    $address = $closedProjects[$p]->complete_address;
                                    
                                    // Grab Schedule value
                                    $pref_sched = $closedProjects[$p]->preferred_date_time;
                                        // Instantiate a DateTime with microseconds.
                                        $d = new DateTime($pref_sched);
                                        // Custom date time formatting
                                        $d_parsed = $d->format(DateTimeInterface::RFC7231);
                                        $d_array = explode(" ", $d_parsed);
                                        $t = $d_array[4];
                                        $hours = substr($t, 0, 2);
                                        $minutes = substr($t, 3, 2);
                                        $end =  $hours >= 12 ? 'PM' : 'AM';
                                        $hours_formatted =  $hours > 12 ? $hours - 12 : (int) $hours;
                                        $t_formatted =  $hours_formatted.':'.$minutes.' '.$end;
                                        $d_formatted = $d_array[0].' '.$d_array[2].' '.$d_array[1].' at '.$t_formatted;

                                    // Grab job order size
                                    $job_order_size = $closedProjects[$p]->job_order_size;
                                    // Grab job description
                                    $job_desc = $closedProjects[$p]->job_description;
                                    // Grab job title
                                    $job_title = $closedProjects[$p]->job_post_name;
                                    // Grab job status
                                    $job_status = $closedProjects[$p]->job_post_status_id;
                                    // Grab job id
                                    $job_id = $closedProjects[$p]->id;
                                    // Grab home_id
                                    $home_id = $closedProjects[$p]->home_id;
                                    // Grab rate_type_id
                                    $rate_type_id = $closedProjects[$p]->rate_type_id;
                                    // Grab job_size_id
                                    $job_size_id = $closedProjects[$p]->job_order_size;


                                    // Grab is_rated
                                    $isRated = $closedProjects[$p]->isRated;
                                    // Grab job_orderid
                                    $job_order_id = $closedProjects[$p]->job_order_id;
                                    // Grab cancellation reason
                                    $cancellation_reason =  $closedProjects[$p]->cancellation_reason;
                                    // Grab job order status
                                    $job_order_status_id = $closedProjects[$p]->job_order_status_id;
                                     // Grab assigned to
                                     $assigned_to = $closedProjects[$p]->assigned_to;
                                     // Grab bill status
                                     $bill_status_id = $closedProjects[$p]->bill_status_id;


                                    // Check if the date is beyond today's date. Otherwise mark it as expired.
                                    // echo ($job_status);

                                    // if($job_status != 2){
                                    //     echo "Not fulfilled";
                                    // }
                        
                                    

                                    include dirname(__FILE__)."/".$level.'/components/cards/project-homeowner.php';
                                }
                                // Clear values;
                                $address = null;
                                $d = null;
                                $d_parsed = null;
                                $d_array = null;
                                $t = null;
                                $hours = null;
                                $minutes = null;
                                $end = null;
                                $hours_formatted = null;
                                $t_formatted = null;
                                $d_formatted = null;
                                $pref_sched = null;
                                $job_order_size = null;
                                $job_desc = null;
                                $job_title = null;
                                $job_status = null;
                                $job_id = null;
                                $home_id = null;
                                $rate_type_id = null;
                                $job_size_id = null;
                                $is_rated = null;
                                $job_order_id = null;

                                if( count($closedProjects) > 3){
                                ?><!-------------------------------------------------->
                                <!-- HTML ZONE: SHOW MORE PROJECTS -->
                                    <div id="show-more"></div>
                                    <div  class="d-flex mt-4 justify-content-center text-align-center">
                                        <button class="btn btn-lg text-white btn-warning">
                                            SHOW MORE
                                        </button>
                                    </div>
                                <?php //--------------- PHP ZONE ------------------------
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">

        </div>
        <!-- <div class="separator"></div>
        <div class="mx-2 mx-lg">
            <h4>Recommended HomeHeroes</h4>
            <p>You have no current projects. Add a project to get recommendations!</p>
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
    <!-- <script src="../../js/pages/user-projects.js"></script> -->
</body>
</html>