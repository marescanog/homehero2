<!-- breadcrumb -->
<?php 
    $level = isset($_POST["level"]) ? $_POST["level"] : "../..";
    $bci_current_page = isset($_POST["current_page"]) ? $_POST["current_page"] : 1;
    $bci_page_1 = isset($_POST["page_1"]) ? $_POST["page_1"] : null;
    $bci_page_2 = isset($_POST["page_2"]) ? $_POST["page_2"] : null;
    $bci_page_3 = isset($_POST["page_3"]) ? $_POST["page_3"] : null;

    $pageTitles = [
        "Choose the best time for you",
        "Tell us more about the task",
        "Review your info"
    ];
    $pageSubTitles =  [
        "We'll match you with a HomeHero who can be scheduled at your time preference.",
        "The HomeHero will be able to better understand you the more details you provide.",
        "You'll be matched with HomeHeroes once you sibmit your project details."
    ];

    // var_dump($_POST);
    include "$level/components/UX/breadcrumb-indicator.php";
?>
<!-- Form Title -->
<div class="form-title-container mt-4">
    <h3 class="pt-3 h4 text-center">
        <?php
            echo isset($bci_current_page) ?  $pageTitles[$bci_current_page-1] : $pageTitles[0];
        ?>
    </h3>
    <p class="text-center">
        <?php
            echo isset($bci_current_page) ?  $pageSubTitles[$bci_current_page-1] : $pageSubTitles[0];
        ?>
    </p>
</div>
<!-- Form Contents -->
<div class="">
    <div class="card shadow-sm mb-4">
        <div class="card-body form-card-height">
            <form id="form-submission-create-project">
                <div class="mx-0 mx-lg-5">
                    <div id="form-content-display"></div>
                </div>
            </form>
        </div>
    </div>
</div>