<?php
session_start();
$output = null;

// curl to get the needed modal information
// Make curl for the personal inforation pagge information vv
// $url = "http://localhost/slim3homeheroapi/public/search-proj"; // DEV

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
    $mode = "DEV"; // DEV to see verbose error messsages, PROD for production build
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
        if($mode !== null || $mode = "DEV"){
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
            <div><p>
                <?php
                    if(count($Addressess) == 0){
                        echo "You have no addresses saved. Save a new Address: ";
                    } else {
                ?></p>
                    <div class="form-group">
                    <label for="as">Addressess:</label>
                    <select id="saved-add-select" class="custom-select c">
                        <option  selected value="">Choose an address</option>
                            <?php for($x = 0; $x < count($Addressess); $x++) {?>
                                <option 
                                    value="<?php echo $Addressess[$x]->home_id;?>"
                                >
                                    <?php echo $Addressess[$x]->street_no." ".$Addressess[$x]->street_name;?>
                                </option>
                            <?php 
                                }
                            ?>
                    </select>
                    <button id="saved-add" class="btn btn-primary" type="button">Use Saved Address</button>
                    <script>
                        const saved_add_This = document.getElementById("saved-add");
                        const AddressText2 = document.getElementById("add-address-text");
                        const HomeFeild2 = document.getElementById("home_address_field");
                        const saved_add_select = document.getElementById("saved-add-select");
                        const address_name_label = document.getElementById("address_name_label");
                        saved_add_This.addEventListener("click", ()=>{
                            AddressText2.innerText = saved_add_select.options[saved_add_select.selectedIndex].text;
                            HomeFeild2.value = saved_add_select.value;
                            address_name_label.value =  saved_add_select.options[saved_add_select.selectedIndex].text;
                            $("#modal").modal('hide');
                        });


                    </script>
                </div>
                <?php }?>
            </div>
            <div class="form-group">
                <label for="as">Street No.</label>
                <input type="text" class="form-control" id="as" placeholder="ex. 5" name="street_no">
            </div>
                        
                <?php// echo var_dump($_SESSION)?>
                <?php // echo var_dump($output->response->defaultHome)?>
                <?php // echo var_dump($output->response->allAddress)?>
                <?php // echo var_dump($output->response->cities)?>
                <?php // echo var_dump($output->response->hometype)?>
                <?php  // echo var_dump($output->response->barangays)?>
  
            <div class="form-group">
                <label for="as">Street Name:</label>
                <input type="text" class="form-control" id="as" placeholder="ex. Green road" name="street_name">
            </div>
            <?php 
                if($output == null){
            ?>
                <div class="text-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                </div>
            <?php
                }else {
            ?>
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
            <?php
                }
            ?>
            <div class="form-group">
                <label for="extra_address_info">Example textarea</label>
                <textarea class="form-control" id="extra_address_info" name="extra_address_info" rows="3"></textarea>
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