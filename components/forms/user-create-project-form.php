<!-- breadcrumb -->
<?php 
    $level = isset($_POST["level"]) ? $_POST["level"] : "../..";
    $bci_current_page = isset($_POST["current_page"]) ? $_POST["current_page"] : 1;
    include "$level/components/UX/breadcrumb-indicator.php";
?>
<!-- Form Title -->
<div class="form-title-container mt-4">
    <h3 class="pt-3 h4 text-center">Choose the best time for you</h3>
    <p class="text-center">We'll match you with a HomeHero who can be scheduled at your time preference.</p>
</div>
<!-- Form Contents -->
<div class="">
    <div class="card shadow-sm mb-4">
        <div class="card-body form-card-height">
            <form id="form-submission-create-project">
                <!-- First Page -->
                <div class="form-hide
                    <?php
                        if($bci_current_page == 1){
                            echo " form-show";
                        }
                    ?>
                ">
                    <?php
                        include dirname(__FILE__)."\UCPFC-1.php";
                    ?>
                </div>
                <!-- Second Page -->
                <div class="form-hide
                    <?php
                        if($bci_current_page == 2){
                            echo " form-show";
                        }
                    ?>
                ">
                    <?php
                        include dirname(__FILE__)."\UCPFC-2.php";
                    ?>
                </div>
                <!-- Third Page -->
                <div class="form-hide
                    <?php
                        if($bci_current_page == 3){
                            echo " form-show";
                        }
                    ?>
                ">
                    <?php
                        include dirname(__FILE__)."\UCPFC-3.php";
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>