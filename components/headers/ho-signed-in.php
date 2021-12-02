<?php $hasHeader = "header";?>
<nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top w-100 p-0">
        <d class="flex flex-column w-100 pt-3 pt-lg-0">
        <div class="d-flex justify-content-between px-3 nav-container" id="header-mobile-container">
            <a class="navbar-brand custom-a" href="<?php echo $level;?>/index.php">
                    <img src="<?php echo $level;?>/images/logo/HH_Logo_Mobile.svg" class="rounded mr-2" alt="Home Hero Logo" id="header-logo-mobile">
            </a>
            <div class="d-flex">
                <button class="navbar-toggler mr-3" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="header-btn-mobile" class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex justify-content-center align-items-center brownt-text" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="circle mr-1 p-1 d-flex justify-content-center align-items-center"><span class="d-block"><?php echo $initials; ?></span></div>
                        <?php echo $fistName;?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="">Profile</a>
                    <a class="dropdown-item" href="">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a id="logout-link-mobile" class="dropdown-item" >Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between px-3 py-0 nav-container" id="header-desktop-content">
            <a class="navbar-brand" href="<?php echo $level;?>/">
                <img src="<?php echo $level;?>/images/logo/HH_Logo_Light.svg" class="rounded mr-2" alt="Home Hero Logo" id="header-logo-desktop">
            </a>
            <div id="header-menu-links">
                <div class="collapse navbar-collapse pr-3 " id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto align-items-center">
                        <li class="nav-item pr-lg-5">
                            <a class="nav-link custom-a" href="<?php echo $level;?>/pages/homeowner/home.php">BROWSE</a>
                            <!-- <a id="browse-temp" class="nav-link custom-a" >BROWSE</a> -->
                        </li>
                        <li class="nav-item pr-lg-5">
                            <a class="nav-link custom-a" href="<?php echo $level;?>/pages/homeowner/projects.php">PROJECTS</a>
                        </li>
                        <li class="nav-item pr-lg-5">
                            <a class="nav-link custom-a" href="<?php echo $level;?>/pages/homeowner/inbox.php">INBOX</a>
                        </li>
                        <li id="header-btn-desktop" class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex justify-content-center align-items-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="circle mr-3 p-2"><?php echo $initials; ?></div>
                                <?php echo $fistName;?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Profile</a>
                            <a class="dropdown-item" href="#">Settings</a>
                            <div class="dropdown-divider"></div>
                            <a id="logout-link-desktop" class="dropdown-item" >Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="w-100 m-0 ">
            <hr class="w-100 m-0 mt-lg-2 hr-yellow" />
        </div>
        </d>
    </nav>
    <script src="<?php echo $level;?>/js/components/loadModal.js"></script>
    <script src="<?php echo $level;?>/js/components/headers/user-signedin.js"></script>

