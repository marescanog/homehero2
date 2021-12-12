
<div class="card shadow-sm rounded mt-4">
  <div class="card-body">
    <div class="row">
        <div class="p-0 m-0 col-3 col-lg-2">
            <div class="avatar d-flex justify-content-center align-items-center">
                <h2>CS</h2>
            </div>
        </div>
        <div class="p-0 m-0 col-6 col-lg-5">
            <div class="d-flex flex-column pt-lg-3">
                <h2>Name</h2>
                <div class="d-flex align-items-center">
                    <?php 
                        $hasRatings = true;
                        $rating = 3;
                        include "$level/components/UX/ratingsDisplay.php";
                    ?>
                    <h6 class="pt-1 ml-2">(6 ratings)</h6>
                </div>
                <div class="d-flex align-items-center pt-1">
                    <i class="far fa-check-circle mr-1"></i>
                    <h6 class="p-0 m-0">6 Projects Completed</h6>
                </div>
            </div>
        </div>
        <div class="p-0 m-0 col-2 col-lg-5 d-flex justify-content-end align-items-center">
           <button class="btn btn-primary mr-lg-5">
               Notify
           </button>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-2 justify-content-center align-items-center">
            <!-- EMPTY FOR SPACE -->
        </div>
        <div class="col-3 justify-content-center align-items-center">
            <div class="d-flex align-items-center">
                <i class="fas fa-map-marker-alt mr-2"></i>
                <p class="p-0 m-0">Talisay, Mandaue</p>
            </div>
        </div>
        <div class="col-3 justify-content-center align-items-center">
            <div class="d-flex align-items-center">
                <i class="fas fa-tag mr-2"></i>
                <p class="p-0 m-0">50/hr</p>
            </div>
        </div>
        <div class="col-3 justify-content-center align-items-center">
            <div class="d-flex align-items-center">
                <i class="fas fa-newspaper mr-2"></i>
                <p class="p-0 m-0">
                    Plumbing, Carpentry, Gardening
                </p>
            </div>
        </div>
    </div>
  </div>
</div>