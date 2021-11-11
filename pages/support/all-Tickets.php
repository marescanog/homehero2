<?php 

$level ="../../";
require_once dirname(__FILE__)."/$level/components/head-meta.php"; 

?>
<!-- === Link your custom CSS pages below here ===-->
<link rel="stylesheet" href="../../css/headers/support.css">
<link rel="stylesheet" href="../../css/headers/support-side-nav.css">
<link rel="stylesheet" href="../../css/support-table.css">
<script src="https://kit.fontawesome.com/d10ff4ba99.js" crossorigin="anonymous"></script>
<!-- === Link your custom CSS  pages above here ===-->
</head>
 <body class="container-fluid m-0 p-0">  
    <!-- Add your Header NavBar here-->
    <?php 
        require_once dirname(__FILE__)."/$level/components/headers/support.php"; 
    ?>
    <div class="<?php echo $hasHeader ?? ""; ?>">
    <!-- === Your Custom Page Content Goes Here below here === -->

    <?php
        $current_side_tab = "All Tickets";
        require_once dirname(__FILE__)."/$level/components/headers/support-side-nav.php"; 
    ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">All Tickets</h1>
    </div>

    <!-- Tab Header -->
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-ongoing-tab" data-toggle="tab" href="#nav-ongoing" role="tab" aria-controls="nav-ongoing" aria-selected="true">Ongoing</a>

            <a class="nav-item nav-link" id="nav-completed-tab" data-toggle="tab" href="#nav-completed" role="tab" aria-controls="nav-completed" aria-selected="false">Completed</a>
            
            <a class="nav-item nav-link" id="nav-escalations-tab" data-toggle="tab" href="#nav-escalations" role="tab" aria-controls="nav-escalations" aria-selected="false">Escalations</a>

            <a class="nav-item nav-link" id="nav-transferred-tab" data-toggle="tab" href="#nav-transferred" role="tab" aria-controls="nav-transferred" aria-selected="false">Transferred</a>

            <a class="nav-item nav-link" id="nav-stale-tab" data-toggle="tab" href="#nav-stale" role="tab" aria-controls="nav-stale" aria-selected="false">Stale</a>
        </div>
    </nav>


    <!-- Tab Header -->
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-ongoing" role="tabpanel" aria-labelledby="nav-ongoing-tab">
            <?php 
                include "$level/components/UX/support-table.php";
            ?>
        </div>

        <div class="tab-pane fade" id="nav-completed" role="tabpanel" aria-labelledby="nav-completed-tab">Completed...</div>

        <div class="tab-pane fade" id="nav-escalations" role="tabpanel" aria-labelledby="nav-escalations-tab">Escalations...</div>

        <div class="tab-pane fade" id="nav-transferred" role="tabpanel" aria-labelledby="nav-transferred-tab">Transferred...</div>

        <div class="tab-pane fade" id="nav-stale" role="tabpanel" aria-labelledby="nav-stale-tab">Stale...</div>
    </div>

</main>






    <!-- === Your Custom Page Content Goes Here above here === -->
    </div>
<?php require_once dirname(__FILE__)."/$level/components/foot-meta.php"; ?>
<!-- Custom JS Scripts Below -->
    <script>

    </script>
</body>
</html>