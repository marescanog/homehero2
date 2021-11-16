<?php
    $level = isset($_POST["level"]) ? $_POST["level"] : "../..";
    $bci_current_page = isset($_POST["current_page"]) ? $_POST["current_page"] : 1;
    $bci_page_1 = isset($_POST["page_1"]) ? $_POST["page_1"] : null;
    $bci_page_2 = isset($_POST["page_2"]) ? $_POST["page_2"] : null;
    $bci_page_3 = isset($_POST["page_3"]) ? $_POST["page_3"] : null;

    // var_dump($_POST);
?>

<div class="w-100">
    <a href="" id="link_back_general"><< General Date</a>
    <h5 class="text-center">Specific Date</h5>
    <div class="d-flex flex-column-reverse flex-lg-row w-100">
        <div class="w-100 ">
            <!-- bg primary -->
            <div class="justify-content-center d-flex flex-column-reverse">
                <input id="inline-calendar" type="text" readonly="readonly"> 
            </div>
        </div>
        <div class="w-100">
            <!-- bg-success -->
            Visible schedule
        </div>
    </div>
</div>