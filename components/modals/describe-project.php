 <div class="modal fade" id="ProjectDescription" tabindex="-1" role="dialog" aria-labelledby="ProjectDescription" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
                        <div class="modal-header">
                        <div class="mx-auto text-center">
                            <h4 class="mt-2 font-weight-bold" style="color:#707070">Describe your Project</h4>
                            <p class="mt-0 mb-0" style="color:#707070; font-size: 14px;" >Tell us more about the task</p>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem -1rem -1rem 0;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>

    <div class="modal-body px-5">
    <form id="DescribeProject" type="POST" onSubmit="DescribeProject(event)" name="DescribeProject">
                
                 <div class="form-group mt-0 mb-1">
                   <label for="ProjectDes" class="font-weight-bold" style="color: #707070;font-size: 14px;"> Description </label>
                   <textarea class="form-control"  cols="10" rows="3" id="ProjectDes" name="ProjectDes" placeholder="Feel free to give a short description or elaborate on specific details. For example: 'I need help assembling a cabinet. Please bring an electric drill.'"></textarea>
                </div>
                
                <div class="form-group mt-2 mb-1" style="padding-left:0;"> 
                      <h5 class="font-weight-bold" style="color:#707070; font-size: 14px;">How big is your project?</h5>
           
                <select name="est-time" class="form-select w-100" aria-label="Default select example" style="border-color: #D3D3D3; height:35px;" placeholder="Small-Est. 1-4 hours" >
                    <option value="1" > Small-Est. 1-4 hours</option>
                    <option value="4">Medium-Est. 4-6 hours</option>
                    <option value="8">Large-Est. 6-8 hours</option>
                    <option value="12">Large-Est. 8-12 hours</option>
                </select>
                </div>

                <div class="form-group mt-2"> 
                <h5 class="font-weight-bold" style="color:#707070; font-size: 14px; ">Set an estimated offer</h5>
                <div class="row" style="border:none;">
		    
                <div class="col">
           
            <h5 style="color:#707070; font-size: 13px">PRICE</h5>
            
            <div class="input-group" >
         <div class="input-group-prepend">
         <span class="input-group-text">P</span>
        </div>
         <input type="number" class="form-control">
         <div class="input-group-append">
          <span class="input-group-text">.00</span>
         </div>
            </div>
		    
            </div>
		   
            <div class="col">  
		
            <h5 style="color:#707070; font-size: 13px;">RATE TYPE</h5>
            <select name="est-time" class="form-select mx-auto " aria-label="Default select example" style="border-color: #D3D3D3; height:35px; width:200px">
                    <option value="hours">per hour</option>
                    <option value="day">per day</option>
                    <option value="project">per project</option>
                   
                </select>
	        </div>
            </div>

         <div class="text-center mt-4" style="font-size:0.8em;">
                <p class="mb-0"> Go back to <a href="#"> address information</a></p>
                <button type="submit" class="btn btn-warning text-white font-weight-bold w-100" >ENTER & CONTINUE </button>
            </div>
        

</div>
</div>
</div>
