<h1>First page</h1>

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
</div>