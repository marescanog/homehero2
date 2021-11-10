<?php 

$level ="../../";
require_once dirname(__FILE__)."/$level/components/head-meta.php"; 

?>
<!-- === Link your custom CSS pages below here ===-->
<link rel="stylesheet" href="../../css/headers/header-homeowner.css">
<link rel="stylesheet" href="../../css/homeowner-home.css">
<link rel="stylesheet" href="../../css/footer.css">
<!-- === Link your custom CSS  pages above here ===-->
</head>
 <body class="container-fluid m-0 p-0 main-container">  
    <!-- Add your Header NavBar here-->
    <?php 
        require_once dirname(__FILE__)."/$level/components/headers/user.php"; 
    ?>
    <div class="<?php echo $hasHeader ?? ""; ?>">
    <!-- === Your Custom Page Content Goes Here below here === -->

<div class="container-fluid m-0 p-0 vh-100 bgc-lightgray">
    <div class="container h-100 d-flex">
        <div class="my-auto mx-auto">
            <h2 class="mb-3">Welcome Back, UserName</h2>
            <h2 class="mb-3"><span class="text-warning">Find a Hero</span> to help improve your home</h2>
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Create a new project</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Choose a category that best describes your project</h6>
                    <?php 
                        $jumb_id = "home";
                        $jumb_button_text = "GET STARTED";
                        include "$level/components/forms/jumbo_card_form.php";?>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- REFACTOR CODE LATER, PUT POP POOST AND FEATURED HEROES INTO THEIR OWN SECTION -->
<!-- =============================================== -->
<!-- POPULAR POSTINGS IN YOUR AREA -->
<!-- =============================================== -->
<div class="pop-post_container">
    <div class="container pop-post_content-wrapper">

        <div>
            <h4 class="txt-semi">Popular Postings in your area</h4>

            <div class="row pop-post-desktop">
                <?php
                    require_once dirname(__FILE__)."/$level/mock-data/pop_post.php"; 
                    foreach ($popularPosts as &$post) {
                ?>
                <div class="col col-lg-4">
                <?php
                include dirname(__FILE__)."/$level/components/cards/pop-post-card.php"; 
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
                            require_once dirname(__FILE__)."/$level/mock-data/pop_post.php"; 
                            foreach ($popularPosts as &$post) {
                        ?>
                            <div class="carousel-item <?php echo !$echoActive ? " active" : "";?>">
                        <?php
                        include dirname(__FILE__)."/$level/components/cards/pop-post-card.php"; 
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
    <!-- FEATURED HEROES-->
    <!-- =============================================== -->
    <div class="featured-heroes">
        <div class="feature-wrap pt-5 pb-2 mb-5">
             <h2 class="featured-header gray-font pb-3">Featured Heroes</h2>
              <!-- <div class="row feature-row"> -->

            <div class="row w-cap">


                <?php 
                    include "$level"."mock-data/featured_heroes.php";
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
                        <div class="col-12 col-lg-4 my-2">
                            <?php
                                include "$level/components/cards/featured-hero-card.php";
                            ?>
                        </div>
                    <?php 
                    } } else {
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
            <!-- </div> -->
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
    require_once dirname(__FILE__)."/$level/components/footer.php"; 
?>

    <!-- === Your Custom Page Content Goes Here above here === -->
    </div>
<?php require_once dirname(__FILE__)."/$level/components/foot-meta.php"; ?>
<!-- Custom JS Scripts Below -->
    <script src="../../js/components/loadModal.js"></script>
    <script>

    $(document).ready(()=>{
        var form = document.getElementById("form-home");
        var button = document.getElementById("button-home");

        // console.log(form);
        // console.log(button);

        form.setAttribute("onSubmit", "submitForm(event)");

        button.addEventListener("click", ()=>{
            console.log("button has been clicked");  
            const modalTypes = {
            "login" : "../../components/modals/temp-enter-address.php",
            "error" : "../../components/modals/error.php" 
            }
            loadModal("login", modalTypes);
        });
    })

    const submitForm = (e)=>{
        e.preventDefault();


        
    }

    </script>
</body>
</html>