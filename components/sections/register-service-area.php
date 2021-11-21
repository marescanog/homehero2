<?php
    $cities = ["Bantayan", "Carcar", "Cebu City", "Daanbantayan", "Danao", "Lapu-lapu", "Liloan", "Mandaue", "Minglanilla", "Naga", "Talisay", "Toledo"];
?>
<div class="row d-flex flex-column title-2-container pt-1 pt-lg-3">
    <h2 class="title-style-2">Set your preferred service areas</h2>
    <h6 class="title-subtitle-1">Customers will be able to find you based on where you choose to work.</h6>
</div>
<form>
<div class="row card-container">
    <div class="card sm-shadow">
        <div class="card-body min-card-cities">
            <h6>Preferred cities</h6>
            <p class="m-0">Select the cities you would like to serve</p>
            <p class="clicky smol p-0 m-0">Clear All</p>
            <div class="row">
                <div class="col-6">
                    <?php 
                        for($x=0; $x<6; $x++){
                    ?>
                    <div class="pt-0 pt-lg-2">
                        <div class="custom-control custom-checkbox pt-3">
                            <input type="checkbox" class="custom-control-input" id="chk-<?php echo htmlentities($cities[$x]);?>" name="chk-<?php echo $daysOfTheWeek[$x];?>">
                            <label class="custom-control-label check-label" for="chk-<?php echo htmlentities($cities[$x]);?>">
                                <?php echo htmlentities($cities[$x]);?>
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
                            <input type="checkbox" class="custom-control-input" id="chk-<?php echo htmlentities($cities[$x]);?>" name="chk-<?php echo $daysOfTheWeek[$x];?>">
                            <label class="custom-control-label check-label" for="chk-<?php echo htmlentities($cities[$x]);?>">
                                <?php echo htmlentities($cities[$x]);?>
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
    <div class="col-6">
        <button id="next" type="button" class=" w-100 btn btn-warning text-white btn-text-2">NEXT</button>
    </div>
</div>
</form>


<!-- Map Data -->
<script src="../../js/helper/city_delimeters.js"></script>
<!-- Map Code -->
<script src="../../js/helper/map.js"></script>
<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
<script
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo isset($_ENV['MAPS']) ? $_ENV['MAPS'] : "YOUR-KEY";?>&callback=initMap&libraries=&v=weekly"
    async
></script>