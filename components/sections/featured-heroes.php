<!-- =============================================== -->
<!-- FEATURED HEROES-->
<!-- =============================================== -->
    <div class="featured-heroes">
        <div class="feature-wrap pt-5 pb-2 mb-5">
             <h2 class="featured-header gray-font pb-3">Featured Heroes</h2>
              <!-- <div class="row feature-row"> -->

            <div class="row w-cap">


                <?php 
                    include "$level/mock-data/featured_heroes.php";
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