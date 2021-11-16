
<?php
    $level = isset($_POST["level"]) ? $_POST["level"] : "../..";
    $bci_current_page = isset($_POST["current_page"]) ? $_POST["current_page"] : 1;
    $bci_page_1 = isset($_POST["page_1"]) ? $_POST["page_1"] : null;
    $bci_page_2 = isset($_POST["page_2"]) ? $_POST["page_2"] : null;
    $bci_page_3 = isset($_POST["page_3"]) ? $_POST["page_3"] : null;

    // var_dump($_POST);
?>

<h5 class="text-center">Plumbing repair</h5>

<hr class="custom"/>

<div>
    <div>
        <h6>Project Info:</h6>
        <div>
            <p>Icon</p>
            <p>Edit Project</p>
        </div>
        <div>
            <p>Icon</p>
            <p>Sat, Sep 5 at 2:00pm</p>
        </div>
        <div>
            <p>Icon</p>
            <p>Small - Est 1hr</p>
        </div>
        <div>
            <p>Icon</p>
            <p>I need help fixing a leaky sink. Please bring plumbing tools.</p>
        </div>
        <div>
            <div>
                <p>Icon</p>
                <h6>Your Est. Offer</h6>
            </div>
            <div>
                <h6>P 56.8 hr</h6>
            </div>
        </div>
    </div>
</div>

<hr class="custom"/>

<div>
    <div>
        <h6>Payment Option:</h6>
        <div>
            <p>icon</p>
            <p>Select Option</p>
        </div>
    </div>
    <div>
        <p>Icon</p>
        <p>Payment Method</p>
    </div>
</div>

<div>
    <p class="text-center">* You will not be billed until the project is completed.</p>
    <button type="button" id="btn-page-3" class="btn btn-warning text-white w-100">
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