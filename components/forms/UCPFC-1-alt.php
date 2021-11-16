<?php
    $level = isset($_POST["level"]) ? $_POST["level"] : "../..";
    $bci_current_page = isset($_POST["current_page"]) ? $_POST["current_page"] : 1;
    $bci_page_1 = isset($_POST["page_1"]) ? $_POST["page_1"] : null;
    $bci_page_2 = isset($_POST["page_2"]) ? $_POST["page_2"] : null;
    $bci_page_3 = isset($_POST["page_3"]) ? $_POST["page_3"] : null;

    // var_dump($_POST);
?>
<h1>First page Alt</h1>
<div class="form-group">
    <label class="text-left" for="text1">Text</label>

    <input type="text" class="form-control" id="text1" name="text1" placeholder="text" 
    value=<?php 
        if($bci_page_1 != null){
            echo isset($bci_page_1["text1"]) ? $bci_page_1["text1"] : "";
        }
    ?>>

    <button type="button" id="btn-page-1" class="btn btn-warning text-white">
        Next
    </button>

    <!-- Hidden Feilds -->
    <input type="hidden" class="form-control" id="text2" name="text2" placeholder="text" 
    value=<?php 
        if($bci_page_2 != null){
            echo isset($bci_page_2["text2"]) ? $bci_page_2["text2"] : "";
        }
    ?>>

    <input type="hidden" class="form-control" id="text3" name="text3" placeholder="text"
    value=<?php 
        if($bci_page_3 != null){
            echo isset($bci_page_3["text3"]) ? $bci_page_3["text3"] : "";
        }
    ?>>
</div>