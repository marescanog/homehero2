<?php
    session_start();
    
    // Make curl for the general schedule info
    // $url = "http://localhost/slim3homeheroapi/public/registration/preferred-cities"; // DEV
     $url = "https://slim3api.herokuapp.com/registration/preferred-cities"; // PROD
    
    $headers = array(
        "Authorization: Bearer ".$_SESSION["registration_token"],
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
    
        if($output === FALSE){
            echo "cURL Error:" . curl_error($ch);
        }
    
        curl_close($ch);
    
        // $output =  json_decode(json_encode($output), true);
        $output =  json_decode($output);
    
        $preferred_cities = null;
    
        // Populate data from curl output
        if($output !== FALSE && $output !== null && $output !== "" && !empty($output)){
            if($output->success == false){
            ?>
                <div class="title-2-container alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>  <?php echo $output->response->status == 500 ? "500 SERVER ERROR": "401 NOT FOUND";?></strong> 
                    <?php echo $output->response->message;?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
            } else {
                // Populate Data from DB
                $preferred_cities = $output->response;
            }
        }
    
        // =================================
        // =================================
    
        // Data for rendering
        $cities = ["Bantayan", "Carcar", "Cebu City", "Daanbantayan", "Danao", "Lapu-lapu", "Liloan", "Mandaue", "Minglanilla", "Naga", "Talisay", "Toledo"];
        // Better Data mimics DB data
        $citiesDBFormat = [
            ["id"=>"1","city_name"=>"Bantayan" ],
            ["id"=>"2","city_name"=>"Carcar" ],
            ["id"=>"3","city_name"=>"Cebu City" ],
            ["id"=>"4","city_name"=>"Daanbantayan" ],
            ["id"=>"5","city_name"=>"Danao" ],
            ["id"=>"6","city_name"=>"Lapu-lapu" ],
            ["id"=>"7","city_name"=>"Liloan" ],
            ["id"=>"8","city_name"=>"Mandaue" ],
            ["id"=>"9","city_name"=>"Minglanilla" ],
            ["id"=>"10","city_name"=>"Naga" ],
            ["id"=>"11","city_name"=>"Talisay" ],
            ["id"=>"12","city_name"=>"Toledo" ],
        ];

        // =================================
        // =================================
        // Data from User, format & clean if necessary
?>
<?php   // echo var_dump($output);?>
<?php  // echo var_dump($output->response);?>
<?php   // echo var_dump($_SESSION["registration_token"]);?>
<?php   //  echo var_dump($preferred_cities);?>
<?php   // echo var_dump($citiesDBFormat[0]["city_name"]);?>

<div class="row d-flex flex-column title-2-container pt-1 pt-lg-3">
    <h2 class="title-style-2">Set your preferred service areas</h2>
    <h6 class="title-subtitle-1">Customers will be able to find you based on where you choose to work.</h6>
</div>
<form id="city-preference">
<div class="row card-container">
    <div class="card sm-shadow">
        <div class="card-body min-card-cities">
            <h6>Preferred cities</h6>
            <p class="m-0">Select the cities you would like to serve</p>
            <p class="clicky smol p-0 m-0" style="transform: translateY(10px);">Clear All</p>
            <div class="row pb-4">
                <div class="col-12 pl-3 mb-0 pb-0 mt-0 pt-0" >
                    <input  style="height:1px; overflow: hidden;" type="checkbox" name="chk_cities" disabled>
                </div>
                <div class="col-6" class="margin-top: -100px;">
                    <?php 
                        for($x=0; $x<6; $x++){
                    ?>
                    <div class="pt-0 pt-lg-0">
                        <div class="custom-control custom-checkbox pt-3">
                            <input type="checkbox" class="custom-control-input" 
                                id="chk-<?php echo htmlentities($citiesDBFormat[$x]["city_name"]);?>" 
                                value="<?php echo htmlentities($citiesDBFormat[$x]["id"]);?>"
                                name="chk_cities"
                                <?php
                                    if($preferred_cities != null && $preferred_cities != "" && !empty($preferred_cities)
                                         && in_array($citiesDBFormat[$x]["id"],$preferred_cities)){
                                            echo "checked";
                                    }
                                ?>
                            >
                            <label class="custom-control-label check-label" 
                                for="chk-<?php echo htmlentities($citiesDBFormat[$x]["city_name"]);?>">
                                <!-- Echoes Name into Label -->
                                <?php echo htmlentities($citiesDBFormat[$x]["city_name"]);?>
                            </label>
                        </div>
                    </div>
                    <?php 
                        }
                    ?>
                </div>

                <div class="col-6">
                    <?php 
                        for($x=6; $x<12; $x++){
                    ?>
                    <div class="col-lg-2 pt-0 pt-lg-2">
                        <div class="custom-control custom-checkbox pt-3">
                            <input type="checkbox" class="custom-control-input" 
                                id="chk-<?php echo htmlentities($citiesDBFormat[$x]["city_name"]);?>" 
                                value="<?php echo htmlentities($citiesDBFormat[$x]["id"]);?>"
                                name="chk_cities"
                                <?php
                                    if($preferred_cities != null && $preferred_cities != "" && !empty($preferred_cities)
                                         && in_array($citiesDBFormat[$x]["id"],$preferred_cities)){
                                            echo "checked";
                                    }
                                ?>
                            >
                            <label class="custom-control-label check-label" 
                                for="chk-<?php echo htmlentities($citiesDBFormat[$x]["city_name"]);?>">
                                <!-- Echoes Name into Label -->
                                <?php echo htmlentities($citiesDBFormat[$x]["city_name"]);?>
                            </label>
                        </div>
                    </div>
                    <?php 
                        }
                    ?>
                </div>
            </div>
            <hr>
            <div>
                <div id="map"></div>
            </div>
            <p class="mt-3 mb-0 p-0 note-bottom smol">* You'll still be able to modify your preferences through your online account settings.</p>
        </div>
    </div>
</div>
<div class="row card-container my-3">
    <div class="col-6">
        <button id="back" type="button" class=" w-100 btn btn-outline-warning btn-text-outline">BACK</button>
    </div>
    <!-- <div class="col-6">
        <button id="next" type="button" class=" w-100 btn btn-warning text-white btn-text-2">NEXT</button>
    </div> -->
    <div class="col-6">
        <button id="PI-submit-btn" type="type" value="Submit" class="w-100 btn btn-warning text-white btn-text-2 justify-content-center align-items-center">
                <span id="PI-submit-btn-txt">SAVE & NEXT</span>
                <div id="PI-submit-btn-load" class="d-none">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Loading...</span>
               </div>
        </button>
    </div>
</div>
</form>


<!-- Map Data -->
<!-- <script src="../../js/helper/city_delimeters.js"></script> -->
<!-- Map Code -->
<script src="../../js/helper/map.js"></script>
<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
<script
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo isset($_ENV['MAPS']) ? $_ENV['MAPS'] : "YOUR-KEY";?>&callback=initMap&libraries=&v=weekly"
    async
></script>