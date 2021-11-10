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