<?php 
$level =".";

require_once dirname(__FILE__).'/components/head-meta.php'; 

?>
<!-- Add your custom CSS below -->
<link rel="stylesheet" href="./css/landing.css">
<link rel="stylesheet" href="./css/footer.css">
<!-- Add your custom CSS above -->
</head>
 <body class="container-fluid m-0 p-0 main-container">  
    <!-- Add your Header NavBar here-->
    <?php 
        require_once dirname(__FILE__).'/components/header.php'; 
    ?>
    <div class="<?php echo $hasHeader ?? ''; ?>">
    <!-- === Your Custom Page Content Goes Here below here === -->

    <!-- =============================================== -->
    <!-- JUMBOTRON -->
    <!-- =============================================== -->
    <div class="jumbotron py-0 mb-auto d-flex flex-end">
        <div class="d-lg-flex flex-lg-row-reverse justify-content-center jumbotron-container">
            <div class="d-flex jumbotron-img-container">
                <div class="mx-auto m-lg-0 d-flex justify-content-center">
                    <img src="./images/pages/landing/Jumbotron_Image.jpg" alt="" class="img-fluid jumbotron-img" >
                </div>
            </div>

            <div class="jumbotron-card" > 
                <div class="card w-lg-75 ml-lg-auto mr-lg-3 mb-lg-5 jumbotron-card-body">
                    <div  id="tabs" class="card-body">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <p class="nav-item nav-link active " id="nav-hire-tab" data-toggle="tab" href="#nav-hire" role="tab" aria-controls="nav-hire" aria-selected="true">Hire a Hero</p>
                                <p class="nav-item nav-link" id="nav-work-tab" data-toggle="tab" href="#nav-work" role="tab" aria-controls="nav-work" aria-selected="false">Find Work</p>
                            </div>
                        </nav>
                        <div class="tab-content pt-1 pb-2 py-lg-3 px-3 px-sm-0" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-hire" role="tabpanel" aria-labelledby="nav-hire-tab">
        
                                <h1 class="jumbotron-h1 mt-lg-3">
                                    Find a Hero to help improve your home.
                                </h1>

                                <form class="jum-form rounded d-flex flex-sm-row flex-column mt-sm-5 mt-0">
                                    <div class="jumb-form-input-container">
                                        <input type="text" class="form-control-plaintext flex-1" id="staticEmail" placeholder="What do you need help with?">
                                    </div>
                                    <div class="cust-select-container">
                                        <div class="d-flex align-items-center">
                                            <div class="vert-line"></div>
                                            <svg class="city-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#F2AE00"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zM7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 2.88-2.88 7.19-5 9.88C9.92 16.21 7 11.85 7 9z"/><circle cx="12" cy="9" r="2.5"/></svg>
                                        </div>
                                        <select class="custom-select">
                                            <option value="" disabled selected>City</option>
                                            <option value="1">Bantayan</option>
                                            <option value="2">Carcar</option>
                                            <option value="3">Metro Cebu</option>
                                            <option value="4">Daanbantayan</option>
                                            <option value="5">Danao</option>
                                            <option value="6">Lapu-lapu</option>
                                            <option value="7">Liloan</option>
                                            <option value="8">Mandaue</option>
                                            <option value="9">Minglanilla</option>
                                            <option value="10">Naga</option>
                                            <option value="11">Talisay</option>
                                            <option value="12">Toledo</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-warning text-white m-0 h-100 jmb-form-btn">
                                        SEARCH
                                    </button>
                                </form>
                            
                            </div>

                            <div class="tab-pane fade" id="nav-work" role="tabpanel" aria-labelledby="nav-work-tab">
                                <h1 class="jumbotron-h1">
                                    Find clients and grow your income.
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- =============================================== -->
    <!-- POPULAR POSTINGS IN YOUR AREA -->
    <!-- =============================================== -->
    <div class="pop-post_container">
        <div class="container pop-post_content-wrapper">

            <div>
                <h4 class="txt-semi">Popular Postings in your area</h4>

                <div class="row pop-post-desktop">
                    <?php
                        require_once dirname(__FILE__).'/mock-data/pop_post.php'; 
                        foreach ($popularPosts as &$post) {
                    ?>
                    <div class="col col-lg-4">
                    <?php
                    include dirname(__FILE__).'/components/cards/pop-post-card.php'; 
                    ?>
                    </div>
                    <?php
                        }
                    ?>
                </div>

                <div class="pop-post-mobile">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                                $echoActive = false;
                                require_once dirname(__FILE__).'/mock-data/pop_post.php'; 
                                foreach ($popularPosts as &$post) {
                            ?>
                                <div class="carousel-item <?php echo !$echoActive ? " active" : "";?>">
                            <?php
                            include dirname(__FILE__).'/components/cards/pop-post-card.php'; 
                            ?>
                            </div>
                            <?php
                                $echoActive = true;
                                }
                            ?>
                        </div>
        
                    </div>
                    <!-- </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>   -->
                </div>

            </div>

        </div>
    </div>


    <!-- =============================================== -->
    <!-- HOW IT WORKS -->
    <!-- =============================================== -->
    <div class="feature-point-container">
        <div class="container featured-point_content-wrapper">
            <div class="container pt-5">
                <h2 class="gray-font feature-point-headline text-center">How it works</h2>
                <div class="row d-flex justify-content-around mt-5 mb-5 mb-lg-0">


                    <!-- Feature 1 -->
                    <div class="col col-lg-3 d-flex flex-column align-items-center pb-5">
                        <div>
                            <?php
                                include dirname(__FILE__).'/images/pages/landing/post_tasks.svg'; 
                            ?>
                        </div>
                        <div>
                            <h4 class="gray-font text-center">Post Tasks</h4>
                            <p>Delegate projects that need to be done by posting your needs</p>
                        </div>
                    </div>

                    
                    <!-- Feature 1 -->
                    <div class="col col-lg-3 d-flex flex-column align-items-center">
                        <div>
                            <?php
                                include dirname(__FILE__).'/images/pages/landing/review_offers.svg'; 
                            ?>
                        </div>
                        <div>
                            <h4 class="gray-font text-center">Review Offers</h4>
                            <p>Check offers and hire the right hero for your tasks</p>
                        </div>
                    </div>

                    
                    <!-- Feature 1 -->
                    <div class="col col-lg-3 d-flex flex-column align-items-center">
                        <div >
                            <img src="./images/pages/landing/taxi-surfing.png" alt="" class="img-fluid feature-max-img">
                        </div>
                        <div>
                            <h4 class="gray-font text-center">Task Done!</h4>
                            <p>Sit back and relax as your hirehero gets the task done for you!</p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <!-- =============================================== -->
    <!-- TESTIMONY -->
    <!-- =============================================== -->
    <div class="testimony-container">
        <div class="container-fluid pt-0" class="testimony-wrapper">
             <div class="testimony-body">
                <div class="testimony-image-wrapper">
                    <!-- <img src="./images/pages/landing/customer-testimonial.jpg" class="img-fluid" alt="a happy hireowner using the hirehero app"> -->
                    <!-- a -->
                </div>
                <div class="testimony-statement-wrapper">
                    
                </div>
             </div>
        </div>
    </div>

    <!-- =============================================== -->
    <!-- FEATURED HEROES-->
    <!-- =============================================== -->
    <div style="min-height:540px; background-color:#FFFFFF; z-index:200">
        <div class="container pt-5">
             <h6>Featured Heroes</h6>
        </div>
    </div>

    <!-- =============================================== -->
    <!-- CTA BOTTOM  -->
    <!-- =============================================== -->
    <div style="min-height:540px; background-color:#E4E4E4; z-index:200">
        <div class="container pt-5">
             <h6>ready to get your needs solved?</h6>
        </div>
    </div>

<?php 
    require_once dirname(__FILE__).'/./components/footer.php'; 
?>



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