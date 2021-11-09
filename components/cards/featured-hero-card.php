<div class="feature-card rounded ">
    <div class="card-body">
        <div class="d-flex" style="background-color:'#FF0000'">
            <div>
                <img src="<?php echo $level;?>/images/pages/landing/<?php echo $feature_picture;?>" alt="profile picture" class="rounded">
            </div>
            <div class="ml-3">
                <h5><?php echo isset($feature_name) ? $feature_name : "Worker Name";?></h5>
                <?php 
                    include "$level/components/UX/ratingsDisplay.php";
                ?>
                <p>
                <?php 
                    include "$level/images/svg/verified.svg";
                ?>    
                <?php echo isset($feature_projects_completed) ? $feature_projects_completed : "?";?> projects completed</p>
            </div>
        </div>
        <hr class="m-0 mt-1 mb-2 card-hr"/>
        <div>
            <h6>Skills</h6>
            <ul>
                <?php for($indx_r = 0; $indx_r < count($feature_skill_list); $indx_r++){?>
                    <li>
                        <span><?php echo $data_featured[$ndx_person_ndx]["skills"][$indx_r]["name"];?></span>
                        <span>
                            <?php 

                            echo ($data_featured[$ndx_person_ndx]["skills"][$indx_r]["rate_type"] == "message") 
                            ?
                            "message for price quote"
                            :
                            "P".$data_featured[$ndx_person_ndx]["skills"][$indx_r]["price"]."/". $data_featured[$ndx_person_ndx]["skills"][$indx_r]["rate_type"];

                            ?>
                            
                        </span>
                    </li>
                <?php }?>
            </ul>
        </div>
        <hr class="m-0 mt-1 mb-2 card-hr"/>
        <div>
            <h6>About Me</h6>
            <div>
                <p><?php echo isset($feature_description) ? substr($feature_description, 0, 125) : "Description";?> ... <a href="">Read More</a></p>
            </div>
        </div>
    </div>
</div>