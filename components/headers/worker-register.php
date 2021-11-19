<?php 
    $level = isset($_POST['level']) ? $_POST['level'] : "../..";
    $hasHeader = "header";
    // $header_title = isset($_POST['header_title']) ? $_POST['header_title'] : "Orientation";
    // $bci_current_page = isset($_POST['page']) ? $_POST['page'] : 0;
    $pageTitles = ["Orientation", "Personal Information", "Schedule", "Service Area", "Review", "Complete"];
    $bci_current_page = $bci_current_page ?? 0;
    if(!isset($header_title)){
        $header_title = $pageTitles[$bci_current_page];
    }
    $isComplete = $isComplete ?? 0;

?>
<nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top w-100 p-0 m-0">
    <div class="flex flex-column w-100 p-0 m-0">
        <div class="d-flex nav-container align-items-center">
            <a class="navbar-brand custom-a  p-2">
                <img src="<?php echo $level;?>/images/logo/worker-header-sm.jpg" class="header-img" alt="Home Hero Logo" id="header-logo-desktop">
            </a>
            <h6 class="<?php 
                 echo $isComplete == 0 ? " d-none " : "";
            ?> mt-lg-2 d-lg-inline header-label"><?php echo $header_title;?></h6>
            <div class="adjust-breadcrumb">
                <?php 
                    $hasTitle = false;
                    $isHeader = true;
                    if(!$isComplete){
                        include dirname(__FILE__)."/$level/components/UX/breadcrumb-indicator.php"; 
                    }
                ?>
            </div>
        </div>
        <div class="w-100 m-0 ">
            <hr class="w-100 m-0 hr-yellow" />
        </div>
    </div>
</nav>

<script src="<?php echo $level;?>/js/components/loadModal.js"></script>


