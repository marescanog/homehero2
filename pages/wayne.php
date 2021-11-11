<?php 

$level ="..";
require_once dirname(__FILE__)."/$level/components/head-meta.php"; 

?>
<!-- === Link your custom CSS pages below here ===-->
<link rel="stylesheet" href="../css/headers/user.css">

<!-- === Link your custom CSS  pages above here ===-->
</head>
 <body class="container-fluid m-0 p-0 main-container">  
    <!-- Add your Header NavBar here-->
    <?php 
        require_once dirname(__FILE__)."/$level/components/headers/user.php"; 
    ?>
    <div class="<?php echo $hasHeader ?? ""; ?>">
    <!-- === Your Custom Page Content Goes Here below here === -->


    <h1>Wayne</h1>
        <ul>
            <li class="mt-3">
                <button id="check-avail-est-date" class="btn btn-primary" data-toggle="modal" data-target="#modal">
                    Check availability - estimated date modal
                </button>
            </li>
            <li class="mt-3">
                <button id="check-avail-exact-date" class="btn btn-primary" data-toggle="modal" data-target="#modal">
                    Check availability - exact date modal
                </button>
            </li>
            <li class="mt-3">
                <button id="sms-verification" class="btn btn-primary" data-toggle="modal" data-target="#modal">
                    SMS Verification
                </button>
            </li>
        </ul>

    <!-- =============================================== -->
    <!--                    MODAL                        -->
    <!-- =============================================== -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div id="modal-contents" class="modal-dialog modal-dialog-centered" role="document">
            <?php

            ?>
        </div>
    </div>



    <!-- === Your Custom Page Content Goes Here above here === -->
    </div>
<?php require_once dirname(__FILE__).'/../components/foot-meta.php'; ?>
<!-- Custom JS Scripts Below -->
    <script>
    var checkAvailEstDate = document.getElementById("check-avail-est-date");
    var checkAvailExactDate = document.getElementById("check-avail-exact-date");
    var SMS = document.getElementById("sms-verification");

    checkAvailEstDate.addEventListener("click", ()=>{
        loadModal("check-avail-est-date");
    });

    checkAvailExactDate.addEventListener("click", ()=>{
        loadModal("check-avail-exact-date");
    });

    SMS.addEventListener("click", ()=>{
        loadModal("sms-verification");
    });

    const loadModal = (modalType) => {
    const modalTypes = {
        "signup" : "../components/modals/homeowner-register.php",
        "error" : "../components/modals/error.php" ,
        "check-avail-est-date" : "../components/modals/check-avail-est-date.php" ,
        "check-avail-exact-date" : "../components/modals/check-avail-exact-date.php", 
        "sms-verification" : "../components/modals/sms-verification.php"
    }

    if(modalTypes.hasOwnProperty(modalType)){
        $("#modal-contents").load(modalTypes[modalType]);
    } else {
        $("#modal-contents").load(modalTypes["error"]);
    }
}
    </script>
</body>
</html>