<?php

?>
<div class="card mt-3 mb-4 shadow ">
    <div class="card-header" style="background-color:#FCEBBF;">
        <h5 class="card-title titulo-proj">Project Name</h5>
        <h6 class="mb-0 mt-0">Status: Not Assigned</h6>
    </div>
    <div class="card-body">
        <div class="d-flex flex-row align-items-center">
            <div class="gray-icon">
                <?php
                    include dirname(__FILE__)."/".$level.'/images/svg/local_offer_black_24dp.svg';  
                ?>
            </div>
            <h6 class="card-subtitle mb-2 text-muted mt-1">Your offer: 50 /hr</h6>
        </div>
        
        <div class="d-flex flex-row">
            <div class="gray-icon">
                <?php
                    include dirname(__FILE__)."/".$level.'/images/svg/today_black_24dp.svg'; 
                ?>
            </div>
            <p id="dateLabel" class="">Schedule: Sat, Sep 5 at 2:00pm</p>
        </div>

        <div class="d-flex flex-row">
            <div class="gray-icon">
                <?php
                    include dirname(__FILE__)."/".$level.'/images/svg/location_on_black_24dp.svg'; 
                ?>
            </div>
            <p id="addressLabel"> Address: 99 Caraway Street, Mabolo, Cebu City</p>
        </div>

        <div class="d-flex flex-row">
            <div class="gray-icon">
                <?php
                    include dirname(__FILE__)."/".$level.'/images/svg/straighten_black_24dp.svg'; 
                ?>
            </div>
            <p id="jobSizeLabel">Small - Est 1hr</p>
        </div>
        <div class="d-flex flex-row">
            <div class="gray-icon">
                <?php
                    include dirname(__FILE__)."/".$level.'/images/svg/description_black_24dp.svg'; 
                ?>
            </div>
            <p id="descLabel">I need help fixing a leaky sink. Please bring plumbing tools.</p>
        </div>
    </div>
    <div class="card-footer text-muted">
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                <button class="btn btn-warning text-white">
                    <b>VIEW</b>
                </button>
                <button class="btn btn btn-outline-warning ml-2">
                    EDIT
                </button>
            </div>
            <button class="btn btn-danger">
                    CANCEL
            </button>
        </div>
    </div>
</div>