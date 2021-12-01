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

    if($output === FALSE){
        echo "cURL Error:" . curl_error($ch);
    }

    curl_close($ch);

    // $output =  json_decode(json_encode($output), true);
    $output =  json_decode($output);

    // Populate data from curl output
    if($output !== FALSE && $output !== null && $output !== "" && !empty($output)){
        if($output->success == false){
        ?>
            <p>Data could not be loaded</p>
            <!-- <div class="title-2-container alert alert-danger alert-dismissible fade show" role="alert">
                <strong>  <?php //echo $output->response->status == 500 ? "500 SERVER ERROR": "401 NOT FOUND";?></strong> 
                <?php //echo $output->response->message;?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
        <?php
        } else {
            if($output->response){
                $defaultHome = $output->response->defaultHome;
                $Addressess = $output->response->allAddress;
                $cities = $output->response->cities;
                $homeTypes = $output->response->hometype;
                $barangays = $output->response->barangays;
            }

        }
    }


?>
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="signUpModalLabel">Temporary(Enter Address)</h5>
        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" style="font-size:1.5em">&times;</span>
        </button>
    </div>
    <!-- MODAL BODY -->
    <h6>Your current session</h6>
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