
      <div class="modal fade" id="hoLogin" tabindex="-1" role="dialog" aria-labelledby="hoLogin" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content px-3">
                         <div class="modal-header" style="border-bottom: 0;">
                        <div class="mx-auto" style="width: auto;">
                            <img src='./images/logo/HH_Logo_Light.svg'>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem -1rem -1rem 0;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>

                        <div class="modal-body">
                            <form id="WorkerNotAvail" type="POST" onSubmit="hoLogin(event)" name="hoLoginForm">
                            <h4 style="font-weight: bold; font-size: 26px; color: #707070">Welcome Back!</h4>
                                   <h5 style="font-size: 16px; color: #707070">Sign into your Homeowner account </h5>
                               
                                   <div class="form-group mb-2 mt-1">    
                                  <label for="HOLnm" class="font-weight-bold" style="color: #707070;font-size: 14px;">MOBILE NUMBER</label>
                                  <input type="mobile-number" class="form-control mt-0" id="HOLnm" name="HOLnm" placeholder="09XX-XXX-XXXX" autocomplete require maxlength="11">
                                </div>
                                <div class="form-group mb-1 mt-1">
                                  <label for="HOLpassword" class="font-weight-bold" style="color: #707070;font-size: 14px;">PASSWORD</label>
                                  <input type="password" class="form-control mt-0 mb-0" id="HOLps" name="HOLps" placeholder="at least 6 characters" autocomplete require minlength="6">
                                </div>
                                <a class="mt-0 mb-2" href="#" style="font-size:0.8em;">
                                 Forgot password?
                                 </a> 
                                <br>
                                <button type="submit" class="btn btn-warning text-white font-weight-bold w-100 mb-3 mt-2" >CONTINUE</button>
                
                                <div class="text-center" style="font-size:0.8em;">
                                    <p id="su">
                                        Dont have an account? <a href="#">Sign-up</a>
                                        <br>
                                        
                                        Registered as a worker? <a href="#">Log in</a> the Worker's Portal.
                                    </p>
                                </div>
                              </form>
                        </div>
</div>
</div>
</div>
                   