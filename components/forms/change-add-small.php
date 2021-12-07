<?php
    $add_arr = isset($_POST['addr_arr']) ? $_POST['addr_arr'] : null;
    $home_address = isset($_POST['home_address']) ? $_POST['home_address'] : null;
    $home_id = isset($_POST['home_id']) ? $_POST['home_id'] : null;
?>
<div class="change_address" >
    <!-- If user only has one address, they cannot change address -->
    <?php 
        if($add_arr == null || count($add_arr) == 1){
    ?>
        <input type="hidden" value="<?php echo $home_id;?>" name="home_id">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="card-subtitle mb-2 text-muted">Address: </h6>
        </div>
        <p class="card-text">
            <?php echo $home_address;?>
        </p>
        <p class="text-danger small-warn">* You only have one address in your address book. Please add another address to change your project's address.</p>
 
    <?php 
        } else {
    ?>
    <!-- If user has multiple addresses echo out a select box -->
        <label for="change_address">Your addresses</label>
        <select class="custom-select" style="width:100%;" id="change_address" name="home_id">
            <?php 
                for($adnx = 0; $adnx < count($add_arr); $adnx++){
            ?>
                <option 
                    value="<?php echo $add_arr[$adnx]['home_id'];?>"
                    <?php
                        if($add_arr[$adnx]['home_id'] == $home_id){
                            echo 'selected';
                        }
                    ?>
                >
                    <?php echo $add_arr[$adnx]['street_no'].' '.$add_arr[$adnx]['street_name'];?>
                </option>
            <?php 
                }
            ?>
            <!-- <option value="1" selected>address 1</option>
            <option value="2">address 2</option>
            <option value="3">address 3</option> -->
        </select>
    <?php 
        }
    ?>
</div> 