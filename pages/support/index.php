<?php 

$level ="../../";
require_once dirname(__FILE__)."/$level/components/head-meta.php"; 

?>
<!-- === Link your custom CSS pages below here ===-->
<link rel="stylesheet" href="../../css/pages/support/login.css">

<!-- === Link your custom CSS  pages above here ===-->
</head>
 <body class=" container-fluid m-0 p-0 main-container bg-warning d-flex justify-content-center align-items-center vh-100">  

    <div class="card" >
    <div class="card-body d-flex flex-column">
         <div class="mx-auto" style="width: auto;">
              <img src='<?php echo $level;?>/images/logo/HH_Logo_Light.svg'>
          </div>

        <form id="modal-login-form" type="POST" onSubmit="hoLogin(event)" name="hoLoginForm">
              <h4 class="mt-3"style="font-weight: bold; font-size: 26px; color: #707070">Welcome Back!</h4>
                      <h5 style="font-size: 16px; color: #707070">Sign into your Admin or support account </h5>
                  
                      <div class="form-group mb-2 mt-1">    
                    <label for="HOLnm" class="font-weight-bold" style="color: #707070;font-size: 14px;">MOBILE NUMBER</label>
                    <input type="mobile-number" class="form-control mt-0" id="HOLnm" name="phone_number" placeholder="09XX-XXX-XXXX" autocomplete require maxlength="11">
                  </div>
                  <div class="form-group mb-1 mt-1">
                    <label for="HOLpassword" class="font-weight-bold" style="color: #707070;font-size: 14px;">PASSWORD</label>
                    <input type="password" class="form-control mt-0 mb-0" id="HOLps" name="password" placeholder="at least 6 characters" autocomplete require minlength="6">
                  </div>
                  <a class="mt-0 mb-2" href="#" style="font-size:0.8em;">
                    Forgot password?
                    </a> 
                  <br>
                  <button id="LU-submit-btn" type="button" class="btn btn-warning text-white font-weight-bold w-100 mb-3 mt-2" >
                  <span id="LU-submit-btn-txt">CONTINUE</span>
                  <div id="LU-submit-btn-load" class="d-none">
                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      <span class="sr-only">Loading...</span>
                    </button>
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






    <!-- === Your Custom Page Content Goes Here above here === -->
    </div>
<?php require_once dirname(__FILE__)."/$level/components/foot-meta.php"; ?>
<!-- Custom JS Scripts Below -->
    <script>

    </script>
</body>
</html>