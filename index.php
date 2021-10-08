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
        var buttonDesktop = document.getElementById("header-btn-desktop");
        var buttonMobile = document.getElementById("header-btn-mobile");

        buttonDesktop.addEventListener("click", ()=>{
            Swal.fire({
                title: "Not Available",
                confirmButtonText: 'Close',
                html: "<img src='./images/svg/construction_icon.svg' style='height:100px; width:100px;'class='rounded mr-2 mb-3' alt='...'> <p>This feature is under construction. Please check back again later!</>"
            })
        });

        buttonMobile.addEventListener("click", ()=>{
            Swal.fire({
                title: "Not Available",
                confirmButtonText: 'Close',
                html: "<img src='./images/construction_icon.svg' style='height:100px; width:100px;'class='rounded mr-2 mb-3' alt='...'> <p>This feature is under construction. Please check back again later!</>"
            })
        });

    </script>
</body>
</html>