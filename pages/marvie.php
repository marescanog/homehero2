<?php 

$level ="..";
require_once dirname(__FILE__)."/$level/components/head-meta.php"; 

?>
<!-- === Link your custom CSS pages below here ===-->


<!-- === Link your custom CSS  pages above here ===-->
</head>
 <body class="container-fluid m-0 p-0 main-container">  
    <!-- Add your Header NavBar here-->
    <?php 
        require_once dirname(__FILE__).'/../components/header.php'; 
    ?>
    <div class="<?php echo $hasHeader ?? ""; ?>">
    <!-- === Your Custom Page Content Goes Here below here === -->


    <h1>marvie</h1>
    <div class="container">
        <h3>testing get request</h3>
        <div class="container">
            <div id="users">

            </div>
            <button class="btn btn-primary mt-3" id="buttn">
                Click to load data
            </button>
        </div>
    </div>

    <!-- === Your Custom Page Content Goes Here above here === -->
    </div>
<?php require_once dirname(__FILE__).'/../components/foot-meta.php'; ?>
<!-- Custom JS Scripts Below -->
    <script>
        $(document).ready(()=>{
            $("#users").load("../components/cards/users-sample.php",{
                name: "name"
            });

            $("#buttn").click(()=>{
                // Send Post Request to API

    $.ajax({
        type : 'GET',
         url : 'http://localhost/SLIM3API/public/create-guest',
        //  url : 'https://slim3api.herokuapp.com/create-guest',
        success : function(response) {
            var res = JSON.parse(response);
            console.log(response);

            // // Enable and hide loading
            // RUSignupSubmitButton.removeAttribute("disabled");
            // RUSignupSubmitTxt.innerHTML = "Register"
            // RUSignupSubmitLoad.removeAttribute("class");
            // RUSignupSubmitLoad.setAttribute("class", "d-none");
            // myForm.style.opacity = "1";

            // var elements = myForm.elements;
            // for (var i = 0, len = elements.length; i < len; ++i) {
            //     elements[i].readOnly = false;
            // }

            // Swal.fire({
            //     title: res["success"] ? 'Success!': 'Error!',
            //     text: res["success"].message,
            //     icon: res["success"] ? 'success': 'error',
            //     confirmButtonText: 'Close'
            // }).then(result => {
            //     if(res["success"]){
            //         //  Reset Form, Close Modal
            //         myForm.reset();
            //         $('#modal').modal('hide');
            //     }
            // })
        },
        error: function (response) {
            console.log(response.responseJSON)
            Swal.fire({
                title:'Error!',
                text: 'Fields must not be empty',
                icon: 'error',
                confirmButtonText: 'Close'
            })
        },
    });
            })
        })

        
    </script>
</body>
</html>