<?php
    session_start(); 

    $retVal = "";
    $status = 400;
    $data = []; 
    $isValid = true;

    // Check if token is generated
    $newProfile = isset($_POST['new_profile']) ? $_POST['new_profile'] : null;
   

    // Check if the user has a registration token set
    if($newProfile == null){
        $isValid = false;
        $status = 401;
        $retVal = "No profile pic found. Please login again.";
    }

    if($isValid){
    // =======================================================================
        $_SESSION['profile_pic_location'] = $newProfile;

        $retVal = "Profile picture successfully reset!";
        $status = 200;
    }
    
    $myObj = array(
        'status' => $status,
        'message' => $retVal,
        'data' => $_SESSION['profile_pic_location'] , 
        //'curlResult' =>  $curlResult
    );

    $myJSON = json_encode($myObj, JSON_FORCE_OBJECT);
    echo $myJSON;
?>