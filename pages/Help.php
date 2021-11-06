<?php 

$level ="..";
require_once dirname(__FILE__).'/../components/head-meta.php'; 

?>
<!-- === Link your custom CSS pages below here ===-->

<!-- === Link your custom CSS  pages above here ===-->
</head>
 <body>  
    <!-- Add your Header NavBar here-->
    <?php 
        require_once dirname(__FILE__).'/../components/header.php'; 
    ?>
    <div style="<?php echo $hasHeader ?? ""; ?>">
    <!-- === Your Custom Page Content Goes Here below here === -->

    <div class="container">
        <h1>
            Help Page
        </h1>
        <p>Information Availbale here.</p>
        
        <h3 class="mt-5">The Developers</h3>
        <ul class="d-flex flex-column">
            <a href="wayne.php" class="mt-2">Wayne Dayata</a>
            <a href="./marvie.php" class="mt-2">Marvie Gasataya</a>
            <a href="./Ixia.php" class="mt-2">Ixia Tan</a>
            <a href="./Ivana.php" class="mt-2">Ivana Leonado</a>
        </ul>
    </div>

    






    <!-- === Your Custom Page Content Goes Here above here === -->
    </div>
<?php require_once dirname(__FILE__).'/../components/foot-meta.php'; ?>
<!-- Custom JS Scripts Below -->
    <script>

    </script>
</body>
</html>