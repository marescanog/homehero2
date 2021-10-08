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

    <h1>
        Registration
    </h1>

    <h2>The Developers</h2>
    <ul>
        <a href="">Marvie Gasataya</a>
        <a href="">Wayne Dayata</a>
        <a href="">Ixia Tan</a>
        <a href="">Ivana Leonado</a>
    </ul>
     
    






    <!-- === Your Custom Page Content Goes Here above here === -->
    </div>
<?php require_once dirname(__FILE__).'/../components/foot-meta.php'; ?>
<!-- Custom JS Scripts Below -->
    <script>

    </script>
</body>
</html>