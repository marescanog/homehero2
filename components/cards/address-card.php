<?php 
 $complete_addr =  isset( $complete_addr) ?  $complete_addr : "";
 $home_type =  isset( $home_type) ?  $home_type : "";
 $home_id =  isset($home_id) ?  $home_id : null;
 $extra_info = isset( $extra_info) ?  $extra_info : "";
 $city = isset( $city) ?  $city : "";
?>
<div class="mt-3 card card-width-profile shadow-sm">
    <div class="card-header d-flex flex-row align-items-center justify-content-between" style="background-color: #FFF9E6">
        <div>
            <h5><b><?php echo htmlentities($complete_addr);?></b></h5>
            <p onclick="profile_editAddress(<?php echo $home_id;?>)" id="edit-addr-<?php echo $home_id;?>" class="clicky p-0 m-0" data-toggle="modal" data-target="#modal">
                <b>Edit</b>
            </p>
        </div>
        <div>
            <button onclick="profile_deleteAddress(<?php echo $home_id;?>)" id="delete-addr-<?php echo $home_id;?>" type="button" class="button btn btn-sm btn-danger">
                DELETE
            </button>
        </div>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <b>City:</b>
            <?php echo $city;?>
        </li>
        <li class="list-group-item">
            <b>Home Type:</b>
            <?php echo $home_type;?>
        </li>
        <li class="list-group-item">
            <b>Extra Address Info:</b>
            <?php
                if($extra_info == "n/a" || trim($extra_info ) == ""){
            ?>
                <i>No extra info provided</i>
            <?php
                } else {
            ?>
                <?php echo $extra_info;?>
            <?php
                }
            ?>
        </li>
        
    </ul>
</div>