<?php 
session_start();
$output = null;

// curl to get the needed modal information

// CHANGELINKDEVPROD
// Make curl for the personal inforation pagge information vv
  $url = "http://localhost/slim3homeheroapi/public/populate-address-form"; // DEV
// $url = "https://slim3api.herokuapp.com/populate-address-form"; // PROD

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
    $defaultHome = null;
    $Addressess = [];
    $cities = [];
    $homeTypes = [];
    $barangays = [];

    // Format our data variables for modal use
    if($curl_error_message == null && $output !== null && is_object($output) && $output->response !== null && $output->success){
        $defaultHome = $output->response->defaultHome;
        $Addressess = $output->response->allAddress;
        $cities = $output->response->cities;
        $homeTypes = $output->response->hometype;
        $barangays = $output->response->barangays;
    }

    $current_selected_home_id = isset($_POST["home_id"]) ? $_POST["home_id"] : null;
     $current_selected_home_id = 16;
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
        <h5 class="modal-title" id="signUpModalLabel">SELECT YOUR ADDRESS</h5>
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
            //echo var_dump($output);
           // echo "</br>";
           // echo var_dump($output->response);
            // echo "</br>";
             // echo var_dump($output->response->allAddress);
            // echo "</br>";
            // echo var_dump($output->response->cities);
            // echo "</br>";
           //echo var_dump($output->response->barangays);
           // echo var_dump($_POST);
        ?>
    </p>
<!-- TEST AREA -->

<!-- MAIN CONTENT -->
<div class="form-group">
                <label for="as">Street No.</label>
                <input type="text" class="form-control" id="as" placeholder="ex. 5" name="street_no">
            </div>

            <div class="form-group">
                <label for="as">Street Name:</label>
                <input type="text" class="form-control" id="as" placeholder="ex. Green road" name="street_name">
            </div>

            <div class="form-group">
                    <label for="as">City:</label>
                    <select id="category" 
                        class="custom-select c" 
                        onchange="makeSubmenu(this.value)"                                     
                        data-prev="0"
                        name="city_id"
                        >
                        <option value="" selected>Select Your City</option>
                            <?php for($x = 0; $x < count($cities); $x++) {?>
                                <option 
                                    value="<?php echo $cities[$x]->id;?>"
                                >
                                    <?php echo $cities[$x]->city_name;?>
                                </option>
                            <?php 
                                }
                            ?>
                    </select>
            </div>

            <div class="form-group" onload="resetSelection()">
                    <label for="as">Barangay:</label>
                    <select id="categorySelect" class="custom-select c" disabled name="barangay_id">
                        <option value="" selected>Select Your Barangay</option>
                            <?php for($x = 0; $x < count($barangays); $x++) {?>
                                <option 
                                    value="<?php echo $barangays[$x]->id;?>"
                                    class="A BG-<?php echo $barangays[$x]->city_id;?> d-none"
                                >
                                    <?php echo $barangays[$x]->barangay_name;?>
                                </option>
                            <?php 
                                }
                            ?>
                    </select>
                </div>
                <script>
                        function resetSelection() {
                            document.getElementById("category").selectedIndex = 0;
                            document.getElementById("categorySelect").selectedIndex = 0;
                        }

                        function makeSubmenu(value) {
                            console.log(value)
                            let cat = document.getElementById("category")
                            let subcat = document.getElementById("categorySelect");
                            subcat.removeAttribute("disabled");
                            subcat.selectedIndex = 0;
                            // reset to d-none for all
                            // $('.A').each((index, element)=>{
                            //     console.log(element)
                            // });

                            // A BG-1
                            if( cat.getAttribute("data-prev") == "0"){
                                //console.log("it is 0");
                                let className = ".A.BG-"+value
                                $(className).each((index, element)=>{
                                    // console.log(element)
                                    element.classList.remove("d-none");
                                });
                            } else {
                                //console.log( cat.getAttribute("data-prev"));
                                // disable previous
                                let previous = ".A.BG-"+cat.getAttribute("data-prev");
                                $(previous).each((index, element)=>{
                                    // console.log(element)
                                    element.classList.add("d-none");
                                });

                                let current = ".A.BG-"+value
                                // enable current
                                $(current).each((index, element)=>{
                                        // console.log(element)
                                    element.classList.remove("d-none");
                                });
                            }
        
                            cat.setAttribute("data-prev", value);

                 
                        }
                </script>

                <div class="form-group">
                    <label for="as">Home Type:</label>
                    <select class="custom-select c" name="home_type">
                        <option value="" selected>Select Home Type</option>
                        <!-- <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option> -->
                        <option value="" selected>Select your home type</option>
                            <?php for($x = 0; $x < count($homeTypes); $x++) {?>
                                <option 
                                    value="<?php echo $homeTypes[$x]->id;?>"
                                >
                                    <?php echo $homeTypes[$x]->home_type_name;?>
                                </option>
                            <?php 
                                }
                            ?>
                            
                    </select>
                </div>

                <div class="form-group">
                    <label for="extra_address_info">Additional Address information</label>
                    <textarea class="form-control" id="extra_address_info" name="extra_address_info" rows="3"></textarea>
                </div>


                <p class="text-white" unselectable="on" class="unselectable">sadsad a asda da saasdadsad adasd a ad as a adadad ad a da da</p>
                
        <!-- Modal body End -->
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
<?php 
    }
?>
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

        const button = document.getElementById("PI-submit-btn");
        const buttonTxt = document.getElementById("PI-submit-btn-txt");
        const buttonLoadSpinner = document.getElementById("PI-submit-btn-load");
        const formData = getFormDataAsObj(form);
        disableForm_displayLoadingButton(button, buttonTxt, buttonLoadSpinner, form);

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
                     url : "http://localhost/slim3homeheroapi/public/add-address", // Dev
                    // url : "https://slim3api.herokuapp.com/add-address",
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

