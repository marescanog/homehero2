<div class="modal fade" id="WorkerNotAvail" tabindex="-1" role="dialog" aria-labelledby="WorkerNotAvail" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
        
            <div class="card mx-auto align-middle" style="background-color:#FBF9EC;">
                <div class="card-body">
                <div class="row" style="border:none;">
		    <div class="col-3">
            <img src="<?php echo $data['homehero.jpg']; ?>" style="height:65px; width:65px border-radius: 5px;" alt="Homehero Unavailable">
			
		    </div>
		    <div class="col">  
			<h4 style="font-weight: bold; font-size: 18px; color: #8C6551; "><?php echo $data['homehero name']; ?></h3>
			<p style="font-size: 16px; color: #8C6551; ">Looks like this HomeHero is not available</p>
		</div>
</div>
</div>
</div>
        

<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem -1rem -1rem 0;">
            <span aria-hidden="true">&times;</span>

        </div>

        <div class="modal-body px-5">
        <h5 class="font-weight-bold" style="color: #707070;">Looks like you are not logged in!</h5>
        <p style="font-size: 16px; color: #707070; ">Before you can contact this HomeHero, you will need to verify your identity.</p>
        <form id="WorkerNotAvail" type="POST" onSubmit="WorkerNotAvail(event)" name="ReloginForm">
        <div class="form-group mt-0 mb-0">
                   
                   <label for="HOemail" class="font-weight-bold" style="color: #707070;font-size: 12px;">EMAIL</label>
                   <input type="email" class="form-control mt-1" id="HOemail" name="HOemail" placeholder="example@mail.com">
                 </div>
                 <div class="form-group mt-1">
                   <label for="HOLps" class="font-weight-bold" style="color: #707070; font-size: 12px;">PASSWORD</label>
                   <input type="password" class="form-control mb-0" id="HOLps" name="HOLps" placeholder="at least 6 characters" autocomplete require minlength="6">
                 </div>
                 <a href="#" style="font-size:0.8em;">
                    Forgot password?
                </a> 
                <br>
                <div class="text-center mt-2" style="font-size:0.8em;">
                <p> Or simply<a href="#"> create a new account</a> if you dont have one yet.</p>
                <button type="submit" class="btn btn-warning text-white font-weight-bold w-100 mb-3 mt-2" >LOG-IN</button>
</div>
</div>
</div>
</div>