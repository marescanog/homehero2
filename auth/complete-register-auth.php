<?php
    session_start(); 

    $retVal = "";
    $status = 400;
    $data = []; 

    $hasRegistered = isset($_POST['hasRegistered']) ? $_POST['hasRegistered'] : null;

    if($token != null){
        $_SESSION['registration_token'] = $token;
        $_SESSION['hasRegistered'] = true ;
        // $_SESSION['initials'] = $initials;
        $retVal = "updated Registration token";
        $status = 200;
    } else {
        $retVal = "Invalid Token";
    }

    $myObj = array(
        'status' => $status,
        'message' => $retVal,
        'data' => $_SESSION['registration_token']  
    );
    
    $myJSON = json_encode($myObj, JSON_FORCE_OBJECT);
    echo $myJSON;
?>