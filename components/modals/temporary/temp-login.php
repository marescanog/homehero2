<!-- <script>
    const signinSubmit = (e) => {
        e.preventDefault();
        console.log('submit?')
    }
</script> -->
<?php
    session_start();    
?>
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="signUpModalLabel">Login</h5>
        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" style="font-size:1.5em">&times;</span>
        </button>
    </div>
    <form id="modal-login-form" name="modalForm">
        <div class="modal-body">
            <h3>Please enter your login details</h3>
            <div class="form-group">
                <label for="exampleInputEmail1">Phone Number</label>
                <input type="text" class="form-control" id="login-mobile-number" name="phone_number" placeholder="+639XX-XXX-XXX">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="login-password" name="password" placeholder="Password">
            </div>
        <div class="modal-footer">
            <button id="LU-submit-btn" type="button" class="btn btn-secondary">
                <span id="LU-submit-btn-txt">LOGIN</span>
                <div id="LU-submit-btn-load" class="d-none">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Loading...</span>
                </div>
            </button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
    <!-- <form id="signinForm" method="POST" onsubmit="signinSubmit(event)" action="./auth/user-auth.php">
        <input id="test" type="text" name="token">
    </form> -->
</div>
