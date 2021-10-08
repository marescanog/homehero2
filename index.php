<?php 
$level =".";

require_once dirname(__FILE__).'/components/head-meta.php'; 

?>
<!-- Add your custom CSS below -->
<link rel="stylesheet" href="./css/landing.css">
<!-- Add your custom CSS above -->
</head>
 <body>  
    <!-- Add your Header NavBar here-->
    <?php 
        require_once dirname(__FILE__).'/components/header.php'; 
    ?>
    <div style="<?php echo $hasHeader ?? ""; ?>">
    <!-- === Your Custom Page Content Goes Here below here === -->

    <div class="jumbotron py-0 mb-auto d-flex flex-end">
        <div class="d-lg-flex flex-lg-row-reverse justify-content-center" style="width:100%;margin: auto; height:100%;">
            <div class="d-flex">
                <div class="mx-auto m-lg-0 d-flex flex-end justify-content-center">
                    <img src="./images/pages/landing/Jumbotron_Image.jpg" alt="" class="img-fluid" style="max-height: 90%;  width: auto; margin-top:auto">
                </div>
            </div>

            <div class="jumbotron-card d-lg-flex" > 
                <div class="card w-lg-75 ml-lg-auto mt-lg-auto mr-lg-3 mb-lg-5 jumbotron-card-body">
                    <div class="card-body shadow-sm">
                        <div class="d-flex ">
                            <div>
                                <h5 class="card-title">Hire a Hero</h5>
                            </div>
                            <div>
                                <h5 class="card-title">Find Work</h5>
                            </div>
                        </div>

                        <h1 class="jumbotron-h1">
                            Find a Hero to help improve your home
                        </h1>
                        <a href="#" class="btn btn-warning text-light"><b>GET STARTED</b></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- <h1 class="display-4">Hello, world!</h1>
        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
        </p> -->
    </div>

    <div style="min-height:540px; background-color:#E4E4E4; z-index:200">
        <div class="container pt-5">
             <h6>Popular Postings in your area</h6>
        </div>
    </div>


    <!-- === Your Custom Page Content Goes Here above here === -->
    </div>
<?php require_once dirname(__FILE__).'/components/foot-meta.php'; ?>
<!-- Custom JS Scripts Below -->
    <script>

    </script>
</body>
</html>