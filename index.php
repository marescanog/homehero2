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
                                $echoActive = null;
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
        <div class="row mx-lg-5 testim-wrap" >
            <col-12 class="col-12 col-lg-6 flex-1 justify-content-center align-items-center">
                <img src="./images/pages/landing/customer-testimonial.jpg" class="img-fluid" alt="a happy homeowner using the homehero app" >
            </col-12>
            <col-12 class="col-12 col-lg-6 testimony-statement-container">
                <div class="m-3 m-lg-0 d-flex flex-column">
                    <h3 class="testimony-header">HomeHero allows me to have more time to spend with my family. I can focus on important matters.</h3>
                    <p class="testimony-text mt-1 mt-lg-3">As a busy owner, I often don't have time to clean the house or look for a carpenter. HomeHero connects me to a worker instantly.</p>
                    <div class="mt-1 mt-lg-3">
                        <button class="btn btn-warning text-white btn-testimony btn-lg">
                            SIGN UP
                        </button>
                    </div>
                </div>
            </col-12>
        </div>
    </div>

    <!-- =============================================== -->
    <!-- FEATURED HEROES-->
    <!-- =============================================== -->
    <div class="featured-heroes">
        <div class="feature-wrap pt-5 pb-2 mb-5">
             <h2 class="featured-header gray-font pb-3">Featured Heroes</h2>
             <div class="row feature-row">
                <?php 
                    include "./mock-data/featured_heroes.php";
                    $feature_name = "";
                    if(isset($data_featured) && count($data_featured)> 0){
                        for($ndx_f = 0; $ndx_f < 3; $ndx_f++){
                            $feature_name = $data_featured[$ndx_f]["name"];
                            $feature_picture = $data_featured[$ndx_f]["profile_picture"];
                            $feature_projects_completed = $data_featured[$ndx_f]["projects_completed"];
                            $rating = $data_featured[$ndx_f]["rating"];
                            $hasRatings = $data_featured[$ndx_f]["hasRatings"];
                            $feature_skill_list = $data_featured[$ndx_f]["skills"];
                            $feature_description = $data_featured[$ndx_f]["Description"];
                            $ndx_person_ndx = $ndx_f;
                ?>
                        <div class="col-12 col-lg-4">
                            <?php
                                include "./components/cards/featured-hero-card.php";
                            ?>
                        </div>
                    <?php } } else {
                        echo "<p>No data available</p>";
                    }
                        $feature_name = null;
                        $feature_picture = null;
                        $feature_projects_completed = null;
                        $rating = null;
                        $hasRatings = null;
                        $feature_skill_list = null;
                        $feature_description = null;
                    ?>
            </div>
        </div>
    </div>

    <!-- =============================================== -->
    <!-- CTA BOTTOM  -->
    <!-- =============================================== -->
    <div class="CTA-container pb-5 pb-lg-0">
        <div class="container CTA-wrapper pt-5 ">
             <h2 class="text-center gray-font my-4">Ready to get your needs solved?</h2>
             <div class="container CTA-box-container">
                 <div class="row">
                     <div class="col-12 col-lg-6 CTA-box CTA-box-white ">
                         <div class="CTA-box-content-container mb-lg-3 mt-lg-3">
                            <div>
                                <img class="img-fluid" src="./images/pages/landing/CTABottomHomeowner.jpg" alt="Homeowner using the Homehero app">
                            </div>
                            <div class="CTA-button-container">
                                <button class="btn btn-warning btn-lg text-white w-100">
                                    Sign Up
                                </button>
                                <p>Get your FREE online account and start looking for a Hero to help with your home.</p>
                            </div>
                         </div>
                     </div>
                     <div class="col-12 col-lg-6 CTA-box CTA-box-offwhite">
                        <div class="CTA-box-content-container mb-lg-3 mt-lg-3">
                            <div>
                                <img class="img-fluid" src="./images/pages/landing/CTABottomWorker.jpg" alt="Worker using the Homehero app">
                            </div>
                            <div class="CTA-button-container">
                                <button class="btn btn-warning btn-lg text-white w-100">
                                    Become a HomeHero
                                </button>
                                <p>Register as a HomeHero and easily be able to find and connect to clients.</p>
                            </div>
                        </div>
                    </div>
                 </div>
             </div>
        </div>
    </div>

    <!-- =============================================== -->
    <!--                    MODAL                        -->
    <!-- =============================================== -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div id="modal-contents" class="modal-dialog modal-dialog-centered" role="document">
            <?php

            ?>
        </div>
      </div>

<?php 
    require_once dirname(__FILE__).'/./components/footer.php'; 
?>



    <!-- === Your Custom Page Content Goes Here above here === -->
    </div>
<?php require_once dirname(__FILE__).'/components/foot-meta.php'; ?>
<!-- Custom JS Scripts Below -->
    <script src="./js/pages/landing.js"></script>
</body>
</html>