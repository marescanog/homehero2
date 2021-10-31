let ratingsError = document.getElementsByClassName("ratings-error");
if(ratingsError.length != 0){
    console.error("ratingsDisplay.php has been included but no $ratings or $hasRatings variable has been set. Please declare $ratings and $hasRatings before including the PHP file.");
}