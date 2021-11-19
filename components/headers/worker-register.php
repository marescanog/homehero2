<?php $hasHeader = "header";
    $headerLink_Selected = $headerLink_Selected ?? 0;
?>
<nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top w-100 p-0 m-0">
    <div class="flex flex-column w-100 p-0 m-0">
        <div class="d-flex nav-container align-items-center">
            <a class="navbar-brand custom-a  p-2" href="<?php echo $level;?>/index.php">
                <img src="<?php echo $level;?>/images/logo/worker-header-sm.jpg" class="header-img" alt="Home Hero Logo" id="header-logo-desktop">
            </a>
            <h6 class="d-none mt-lg-2 d-lg-inline header-label">Personal Information</h6>
            <div class="adjust-breadcrumb">
                <?php 
                    $hasTitle = false;
                    $isHeader = true;
                    include dirname(__FILE__)."/$level/components/UX/breadcrumb-indicator.php"; 
                ?>
            </div>
        </div>
        <div class="w-100 m-0 ">
            <hr class="w-100 m-0 hr-yellow" />
        </div>
    </div>
</nav>
<script src="<?php echo $level;?>/js/components/loadModal.js"></script>
<!-- <script src="<?php //echo $level;?>/js/components/headers/user-signedin.js"></script> -->

