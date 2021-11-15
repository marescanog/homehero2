<h1>Third page</h1>

<div class="form-group">
    <label class="text-left" for="text3">Text</label>
    <input type="text" class="form-control" id="text3" name="text3" placeholder="text"
    value=<?php 
        if($bci_page_3 != null){
            echo isset($bci_page_3["text3"]) ? $bci_page_3["text3"] : "";
        }
    ?>>

    <button type="button" id="btn-page-3" class="btn btn-warning text-white">
        Submit
    </button>
</div>