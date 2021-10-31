
<div class="d-flex">
<?php
    if(isset($rating) && $rating != null && isset($hasRatings) && $hasRatings = true){
        isset($stars) ? $stars : $stars = array("$level/images/svg/star0.svg", 
        "$level/images/svg/star1.svg", 
        "$level/images/svg/star2.svg", 
        "$level/images/svg/star3.svg", 
        "$level/images/svg/star4.svg");
            for($x = 0; $x < count($stars); $x++){?>
            <div class="div">
            <?php 
            $starvalue = 0;
            $starvalue = $rating - $x;
            if($starvalue >= 1){
            include $stars[4];
            } else if ($starvalue <= 0){
            include $stars[0];
            } else if($starvalue == 0.5){
            include $stars[2];
            } else {
            if($starvalue > 0 && $starvalue < 0.5){
            include $stars[1];
            } else {
            include $stars[3];
            }
            }
            ?>
            </div>
            <?php
            }
    } else if (isset($hasRatings) && $hasRatings == false){
        echo "<p>No Ratings</p>";
    }
    else {
        // echo "<div class='alert alert-danger alert-dismissible' role='alert'>
        //     Variable \$rating has not been declared.
        //     <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        //     <span aria-hidden='true'>&times;</span>
        //     </button>
        // </div>";
        echo "<p class='ratings-error'>Ratings Unavailable</p>";
    }
    $rating = null;
?>
</div>
<script src="<?php echo "$level/js/UX/ratingsDisplay.js";?>"></script>

