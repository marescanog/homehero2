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
    <div class="jumbotron py-0 mb-auto d-flex justify-content-center flex-lg-end">
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
                        <div class="tab-content pt-1 pb-2 px-2  px-lg-3" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-hire" role="tabpanel" aria-labelledby="nav-hire-tab">
                                <h1 class="jumbotron-h1 mt-lg-3 mt-0 mt-md-3 mt-lg-0">
                                    Find a Hero to help improve your home.
                                </h1>
                                <?php include './components/forms/jumbo_card_form.php';?>
                            </div>

                            <div class="tab-pane fade" id="nav-work" role="tabpanel" aria-labelledby="nav-work-tab">
                                <h1 class="jumbotron-h1 mt-lg-3">
                                    Find clients and grow your income.
                                </h1>
                                <?php 
                                $jumb_placeholder = "What is your occupation?";
                                $jumb_button_text = "REGISTER";
                                include './components/forms/jumbo_card_form.php';?>
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
        <div class="row mx-lg-5">
            <col-12 class="col-12 col-lg-6">
                <img src="./images/pages/landing/customer-testimonial.jpg" class="img-fluid" alt="a happy hireowner using the hirehero app">
            </col-12>
            <col-12 class="col-12 col-lg-6">
                <h3>HomeHero allows me to have more time to spend with my family. I can focus on important matters.</h3>
                <p>As a busy owner, I often don't have time to clean the house or look for a carpenter. HomeHero connects me to a worker instantly.</p>
                <button class="btn btn-warning txt-white btn-testimony">
                    SIGN UP
                </button>
            </col-12>
        </div>
    </div>
    <!-- <div class="testimony-container">
        <div class=" pt-0" class="testimony-wrapper">
             <div class="testimony-body row">
                <div class="testimony-image-wrapper col-12 col-lg-6">
                    <img src="./images/pages/landing/customer-testimonial.jpg" class="img-fluid" alt="a happy hireowner using the hirehero app">
                </div>
                <div class="testimony-statement-wrapper col-12 col-lg-6">
                    <h3>HomeHero allows me to have more time to spend with my family. I can focus on important matters.</h3>
                    <p>As a busy owner, I often don't have time to clean the house or look for a carpenter. HomeHero connects me to a worker instantly.</p>
                    <button class="btn btn-warning txt-white btn-testimony">
                        SIGN UP
                    </button>
                </div>
             </div>
        </div>
    </div> -->

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