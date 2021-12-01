<?php
session_start();
$output = null;

// curl to get the needed modal information

// Make curl for the personal inforation pagge information vv
// $url = "http://localhost/slim3homeheroapi/public/populate-address-form"; // DEV
 $url = "https://slim3api.herokuapp.com/populate-address-form"; // PROD

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

?><!-------------------------------------------------->
    <!-- HTML ZONE -->

    <!-- This HTML displays the head of the modal with title and close X button -->
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="signUpModalLabel">Temporary(Enter Address)</h5>
        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" style="font-size:1.5em">&times;</span>
        </button>
    </div>


    <?php //--------------- PHP ZONE ------------------------
    // ERROR HANDLING 
    if($output === FALSE){
        $curl_error_message = curl_error($ch);
    }

    curl_close($ch);

    $output =  json_decode(json_encode($output), true);
    // $output =  json_decode($output);


    // ERROR HANDLING - Curl Error
    if($curl_error_message){
    ?><!-------------------------------------------------->
    <!-- HTML ZONE : CURL ERROR HANDLING & MESSAGE DISPLAY -->
        
        <!-- Displays an Alert containing CURL issues -->
        <div class="modal-body">
            <div class="title-2-container alert alert-danger alert-dismissible fade show" role="alert">
                <!-- TITLE -->
                <div>
                    <h5>CURL ERROR</h5>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- BODY -->
                <div>
                    <?php echo $curl_error_message ; ?>
                </div>
            </div>
        </div>

    <?php //--------------- PHP ZONE ------------------------
    }

    // ERROR HANDLING - Server Error
    if(!$curl_error_message &&  is_object($output)){
    ?><!-------------------------------------------------->
    <!-- HTML ZONE : CURL ERROR HANDLING & MESSAGE DISPLAY -->

        <!-- Displays an Alert containing Server issues -->
            <div class="modal-body">
            <div class="title-2-container alert alert-danger alert-dismissible fade show" role="alert">
                <!-- TITLE -->
                <div>
                    <h5>
                        <?php
                            if($output == null){
                                echo "OUTPUT FROM CURL IS NULL";
                            } else if ($output == "" || empty($output)){
                                echo "OUTPUT FROM CURL IS EMPTY";
                            } else if ($output->response && $output->response->status == 500 ){
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
        </div>


    <?php //--------------- PHP ZONE ------------------------
    }

    // Format our data variables for modal use
    if($curl_error_message == null && $output !== null && is_object($output) && $output->response !== null && $output->success){
        $defaultHome = $output->response->defaultHome;
        $Addressess = $output->response->allAddress;
        $cities = $output->response->cities;
        $homeTypes = $output->response->hometype;
        $barangays = $output->response->barangays;
    }

?>
    <!-- MODAL BODY DEV -->
    <?php //--------------- PHP ZONE ------------------------
        if($mode !== null && $mode == "DEV"){
    ?> <!-------------------------------------------------->
    <!-- HTML ZONE -->
        <div class="modal-body">
            <h6>Your current session variables</h6>
            <p>
                <?php
                    echo var_dump($_SESSION);
                ?>
            </p>
            <h6>Your curl output</h6>
            <p>
                <?php
                    echo var_dump($output);
                ?>
            </p>
        </div>
    <?php //--------------- PHP ZONE ------------------------
    } else {
    ?><!-------------------------------------------------->
    <!-- HTML ZONE -->
    
    <!-- ======================================================= -->
    <!-- YOUR MAIN CONTENT -->
    <!-- ======================================================= -->

    <form id="enterAddress" type="POST" name="modalForm">
        <div class="modal-body">
            <h1>TEST</h1>
        </div>
        <div class="modal-footer">
            <button id="PI-submit-btn" type="submit" value="Submit" class="w-100 btn btn-warning text-white qbtn-text-2 justify-content-center align-items-center">
                    <span id="PI-submit-btn-txt">Submit</span>
                    <div id="PI-submit-btn-load" class="d-none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="sr-only">Loading...</span>
                </div>
            </button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>


<?php //----------------------------------------------
}
?><!-------------------------------------------------->

</div>

<script>
    $("#enterAddress").validate({
    rules: {
        street_no:"required",
        street_name:"required",
        barangay_id:"required",
        home_type:"required",
        city_id:"required",
        home_type:"required"
        // password : {
        //     required: true,
        //     maxlength: 30
        // },
    },
    // messages: {
    //     phone: {
    //         required: "Please enter your mobile number"
    //     },
    //     password:{
    //         required:  "Please enter your password",
    //     }
    // },
    submitHandler: function(form, event) { 
        event.preventDefault();
        console.log("u press");
        const addressData = getFormDataAsObj(form);


        /*
        <p id="add-address-text" class="p-0 m-0 ">
            Add an address
        </p>
        <input id="home_address_field" type="hidden" name="home_id" value="">
        */
        // On Page Load, The default falback list is 6 items.

        $.ajaxSetup({cache: false})
        $.get(getDocumentLevel()+'/auth/get-register-session.php', function (data) {
                    console.log(data)
                    const parsedSession = JSON.parse(data);
                    const token = parsedSession['token'];
                    console.log(token);
                    console.log(addressData);

                                
                    // Create new form 
                    const samoka = new FormData();

                    // Append 
                    samoka.append('street_no', addressData["street_no"]);
                    samoka.append('barangay_id', addressData["barangay_id"]);
                    samoka.append('extra_address_info', addressData["extra_address_info"] == "" ? "n/a" : addressData["extra_address_info"]);
                    samoka.append('street_name', addressData["street_name"]);
                    samoka.append('home_type', addressData["home_type"]);
                    // samoka.append('token', form["preferred_cities"]);
                    // console.log("your token is")
                    // console.log(token);
                    // console.log(form);
                    // console.log(samoka);


                $.ajax({
                    type : 'POST',
                    // url : "http://localhost/slim3homeheroapi/public/add-address", // Dev
                    url : "https://slim3api.herokuapp.com/add-address",
                    data : samoka,
                        contentType: false,
                        processData: false,
                        headers: {
                            "Authorization": `Bearer ${token}`
                        },
                    success : function(response) {
                        console.log(response.response);
                        console.log(response.response.data);
                        console.log(response.response.data.home_id);
                        //$('#enterAddress')[0].reset();
                        const AddressText = document.getElementById("add-address-text");
                        const HomeFeild = document.getElementById("home_address_field");
                        const address_name_label2 = document.getElementById("address_name_label");
                        address_name_label2.value =  addressData["street_name"];

                        AddressText.innerText = addressData["street_name"];
                        HomeFeild.value = response.response.data.home_id;
                        $("#modal").modal('hide');
                    },
                    error: function (response) {
                            console.log(response);

                        }
                });

        });

        


    }



    });

    

</script>