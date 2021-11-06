<?php

    // Declare variables
    $arr = array();
    $x = 0;

    // While there is still post data, push it into the empty array
    // The key of the post data is a number hence starts at x = 0
    while(isset($_POST[$x])){
      array_push($arr, $_POST[$x]);
      $x++;
    }

    // If the array is not empty, we post the formatted data
    if(count($arr) > 0){

    for($x = 0; $x < count($arr); $x++){
?>

<div class="card mt-4" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title"><?php echo $arr[$x]['fname']." ".$arr[$x]['lname'] ;?></h5>
    <h6 class="card-subtitle mb-2 text-muted"><?php echo $arr[$x]['type'] == 1 ? "User" : "Admin";?></h6>
  </div>
</div>

<?php 
    // Otherwise if the data is empty, we let the user know there is no data
    }} else {
?>
  <h4 class="text-secondary">There are no users</h4>
<?php
    }
?>