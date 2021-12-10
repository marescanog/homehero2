<?php 
session_start();
$output = null;

// curl to get the needed modal information

// CHANGELINKDEVPROD
// Make curl for the personal inforation pagge information vv
  $url = "http://localhost/slim3homeheroapi/public/homeowner/get-all-addresses"; // DEV
// $url = ""; // PROD (No Prod link)

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

    // Moved inside Modal Body for better display of error messages
    $mode = "PROD"; // DEV to see verbose error messsages, PROD for production build
    $curl_error_message = null;

    // Declare variables to be used in this modal
    $defaultHome = null;
    $Addressess = [];
    $cities = [];
    $homeTypes = [];
    $barangays = [];

    // ERROR HANDLING 
    if($output === FALSE){
        $curl_error_message = curl_error($ch);
    }

    curl_close($ch);

    // $output =  json_decode(json_encode($output), true);
    $output =  json_decode($output);

    // Declare variables to be used in this modal
    $defaultHome_id = null;
    $Addressess = [];

    // Format our data variables for modal use
    if($curl_error_message == null && $output !== null && is_object($output) && $output->response !== null && $output->success){
        // $defaultHome = $output->response->defaultHome;
        $Addressess = $output->response->allAddress;
        $defaultHome_id = $output->response->defaultHome_id;
    }

    $current_selected_home_id = isset($_POST["data"]["home_id"]) ? $_POST["data"]["home_id"] : null;

?><div class="modal-content" style="width: auto !important;">
    <?php
        if( $output != null && $output->success == false){
    ?>
        <div class="modal-header">
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <div>
                    <b>500 Error</b>
                </div>
                <p>Please close the modal & Refresh the browser.</p>
            </div>   
            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="font-size:1.5em">&times;</span>
            </button>
        </div>
    <?php
        } else if ( $curl_error_message != null || $output == null) {
    ?>    
    <div class="modal-header">
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <div>
                <b>Error loading Edit Modal!</b>
            </div>
            <p>Please close the modal & Refresh the browser.</p>
        </div>   
        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" style="font-size:1.5em">&times;</span>
        </button>
    </div>
<?php
    } else {
?>
    <div class="modal-header">
        <h5 class="modal-title" id="signUpModalLabel">YOUR SELECTED ADDRESS</h5>
        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" style="font-size:1.5em">&times;</span>
        </button>
    </div>
    <div name="modalForm">
    <form id="modal-enter-address" type="POST"  name="hoLoginForm">
        <div class="modal-body">
<!-- TEST AREA -->
    <p class="p-0 m-0"> 
        <?php 
           // echo var_dump($output);
           // echo "</br>";
           // echo var_dump($output->response);
            // echo "</br>";
              // echo var_dump($output->response->allAddress);
            // echo "</br>";
            // echo var_dump($output->response->cities);
            // echo "</br>";
           //echo var_dump($output->response->barangays);
           // echo var_dump($_POST);
           /// echo var_dump($Addressess);
           // echo "current selected home id is ".$current_selected_home_id;
        ?>
    </p>
<!-- TEST AREA -->

<!-- MAIN CONTENT -->
<?php 
         $selected_addr = "";

        // Get current selected address from addresss list
        for($z = 0; $z < count( $Addressess); $z++){
            // $test = $Addressess[$z]->home_id == $current_selected_home_id;
            // $home_id_arr = $Addressess[$z]->home_id;
            // echo "<p>Does home id: $home_id_arr = current home id:$current_selected_home_id ? ".var_dump($test)."</p>";
            if($Addressess[$z]->home_id == $current_selected_home_id){
                $selected_addr = $Addressess[$z]->complete_address;
                break;
            }
        }
?>
    <div id="add-address-display">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">You selected</h5>
                <h6 class="card-subtitle mb-2 text-muted">The home with the address located at: </h6>
                <p class="card-text pl-3 pb-0 mb-0
                <?php 
                    if($selected_addr == ""){
                        echo "text-danger";
                    }
                ?>
                "><?php 
                        echo $selected_addr == "" ? "Address not found in your saved addresses. Please click on the 'choose' button and select an address from your list." : $selected_addr;
                    ?>
                </p>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <button id="change" type="button" class="mt-2 btn btn-primary text-white btn-lg"  style="width:49%">
            <?php 
                echo $selected_addr == "" ? "CHOOSE" : "CHANGE";
            ?>
            </button>
            <button type="button" class="mt-2 btn btn-secondary text-white btn-lg"  style="width:49%" data-dismiss="modal">CLOSE</button>
        </div>
    </div>
    
    </form>
<?php 
    }
?>
</div>