<h1>Second page</h1>

<div class="form-group">
    <label class="text-left" for="text2">Text</label>
    <input type="text" class="form-control" id="text2" name="text2" placeholder="text" 
    value=<?php 
        if($bci_page_2 != null){
            echo isset($bci_page_2["text2"]) ? $bci_page_2["text2"] : "";
        }
    ?>>

    <button type="button" id="btn-back-page-2" class="btn btn-outline-warning">
        Back
    </button>

    <button type="button" id="btn-page-2" class="btn btn-warning text-white">
        Next
    </button>
</div>