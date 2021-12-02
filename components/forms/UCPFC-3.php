
<?php
    $level = isset($_POST["level"]) ? $_POST["level"] : "../..";
    $bci_current_page = isset($_POST["current_page"]) ? $_POST["current_page"] : 1;
    $bci_page_1 = isset($_POST["page_1"]) ? $_POST["page_1"] : null;
    $bci_page_2 = isset($_POST["page_2"]) ? $_POST["page_2"] : null;
    $bci_page_3 = isset($_POST["page_3"]) ? $_POST["page_3"] : null;

    // var_dump($_POST);
?>

<h5 id="projectTitleLabel"  class="text-center project-title-review">Plumbing repair</h5>

<hr class="custom"/>

<div class="Segeo-font d-flex flex-column justify-content-center align-items-center">
    <div class="info-width">
        <div class="d-flex flex-row justify-content-between">
            <h6 class="mt-1 project-subtitle-review">Project Info:</h6>
            <!-- <div class="d-flex flex-row">
                <div class="edit-icon">
                    <?php
                        //include dirname(__FILE__)."/".$level.'/images/svg/edit_black_white24dp.svg'; 
                    ?>
                    <div class="edit-icon-square"></div>
                </div>
                <p class="edit-icon-text mt-1 ml-1">Edit Project</p>
            </div> -->
        </div>


        <div class="d-flex flex-row">
            <div class="gray-icon">
                <?php
                    include dirname(__FILE__)."/".$level.'/images/svg/today_black_24dp.svg'; 
                ?>
            </div>
            <p id="dateLabel">Sat, Sep 5 at 2:00pm</p>
        </div>

        <div class="d-flex flex-row">
            <div class="gray-icon">
                <?php
                    include dirname(__FILE__)."/".$level.'/images/svg/location_on_black_24dp.svg'; 
                ?>
            </div>
            <p id="addressLabel">99 Caraway Street, Mabolo, Cebu City</p>
        </div>

        <div class="d-flex flex-row">
            <div class="gray-icon">
                <?php
                    include dirname(__FILE__)."/".$level.'/images/svg/straighten_black_24dp.svg'; 
                ?>
            </div>
            <p id="jobSizeLabel">Small - Est 1hr</p>
        </div>

        <div class="d-flex flex-row">
            <div class="gray-icon">
                <?php
                    include dirname(__FILE__)."/".$level.'/images/svg/description_black_24dp.svg'; 
                ?>
            </div>
            <p id="descLabel">I need help fixing a leaky sink. Please bring plumbing tools.</p>
        </div>
        <div style="color:#FFFFFF;" unselectable="on">Banana pancakes so tasty. I love my banana pancakes.</div>
        <div class="d-flex flex-row justify-content-center">
            <div class="d-flex flex-column">
                <div class="d-flex flex-row justify-content-center">
                    <div class="gray-icon">
                        <?php
                            include dirname(__FILE__)."/".$level.'/images/svg/local_offer_black_24dp.svg'; 
                        ?>
                    </div>
                    <h6>Your Est. Offer</h6>
                </div>
                <h6 class="h5 ml-3 text-center" id="rateOfferLabel">P 56.8 hr</h6>
            </div>
        </div>
        <div style="color:#FFFFFF;" unselectable="on">Banana pancakes so tasty. I love my banana pancakes.</div>
    </div>
</div>

<hr class="custom"/>

<div class="Segeo-font flex-column justify-content-center align-items-center">
    <div class="info-width mx-auto">
        <div class="d-flex flex-row justify-content-between">
            <h6 class="mt-1 project-subtitle-review">Payment Option:</h6>
            <div class="d-flex flex-row">
                <!-- <div class="edit-icon">
                    <?php
                        // include dirname(__FILE__)."/".$level.'/images/svg/edit_black_white24dp.svg'; 
                    ?>
                    <div class="edit-icon-square"></div>
                </div>
                <p class="edit-icon-text mt-1 ml-1">Select Option</p> -->
            </div>
        </div>
        <div class="d-flex flex-row">
            <!-- <div class="red-icon">
                <?php
                    //include dirname(__FILE__)."/".$level.'/images/svg/error_black_24dp.svg'; 
                ?>
            </div> -->
            <p>Cash</p>
        </div>
    </div>  
</div>

<div class="info-width mx-auto">
    <p class="text-center p-0 m-0 info-notice">* You will not be billed until the project is completed.</p>
    <button type="button" id="btn-page-3" class="thicc mt-2 btn btn-lg btn-warning text-white w-100">
        SUBMIT & POST
    </button>
</div>



<!-- <button type="button" id="btn-back-page-3" class="btn btn-outline-warning">
        Back
</button> -->


<div class="form-group">
    <!-- <label class="text-left" for="text3">Text</label>
    <input type="text" class="form-control" id="text3" name="text3" placeholder="text"
    value=<?php 
        // if($bci_page_3 != null){
        //     echo isset($bci_page_3["text3"]) ? $bci_page_3["text3"] : "";
        // }
    ?>> -->

    <!-- Hidden Feilds -->
    <input type="hidden" class="form-control" id="text1" name="text1" placeholder="text" 
    value=<?php 
        if($bci_page_1 != null){
            echo isset($bci_page_1["text1"]) ? $bci_page_1["text1"] : "";
        }
    ?>>

    <input type="hidden" class="form-control" id="text2" name="text2" placeholder="text" 
    value=<?php 
        if($bci_page_2 != null){
            echo isset($bci_page_2["text2"]) ? $bci_page_2["text2"] : "";
        }
    ?>>
</div>