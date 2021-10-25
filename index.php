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
        <div class="d-lg-flex flex-lg-row-reverse justify-content-center jumbotron-container">
            <div class="d-flex">
                <div class="mx-auto m-lg-0 d-flex flex-end justify-content-center">
                    <img src="./images/pages/landing/Jumbotron_Image.jpg" alt="" class="img-fluid jumbotron-img" >
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

    <div class="pop-post_container">
        <div class="container pop-post_content-wrapper">
            <h4 class="txt-semi">Popular Postings in your area</h4>

            <div id="carouselExampleControls" class="carousel slide"  data-interval="false" data-ride="carousel" data-pause="hover">
            <div class="carousel-inner">
                <div class="carousel-item d-flex active">
                    <div class="card">
                        <div class="card-body">
                            This is some text within a card body.
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            This is some text within a card body.
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            This is some text within a card body.
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div style="background-color:#0000FF; width: 100%; height: 100%">
                            d
                    </div>
                </div>
                <div class="carousel-item">
                    <div style="background-color:#0000FF; width: 100%; height: 100%">
                            d
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            </div>
        </div>

    </div>

    <div style="min-height:540px; background-color:#FFFFFF; z-index:200">
        <div class="container pt-5">
             <h6>How it works</h6>
        </div>
    </div>

    <div style="min-height:540px; background-color:#E4E4E4; z-index:200">
        <div class="container pt-5">
             <h6>Testimony</h6>
        </div>
    </div>

    <div style="min-height:540px; background-color:#FFFFFF; z-index:200">
        <div class="container pt-5">
             <h6>Featured Heroes</h6>
        </div>
    </div>

    <div style="min-height:540px; background-color:#E4E4E4; z-index:200">
        <div class="container pt-5">
             <h6>ready to get your needs solved?</h6>
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